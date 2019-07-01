<?php

add_action('init', function(){

    /**
     * Array de paginas especificas o especiales
     * Key: slug de la pagina especial
     * Value: array primer valor nombre segundo padre slug
     *
     */

    $special_pages = array(
        'home'  => array( 'Home', "" ) ,
        'molino' => array( 'Molino', "" ) ,
    );

    if ( defined('CLTVO_ISLOCAL') && CLTVO_ISLOCAL ) {
        $special_pages['atomos'] = array('Átomos', '');
        $special_pages['grid']   = array('Grid', '');
    }

    $special_pages_ids = get_option('special_pages_ids'); // almacena los ids de las paginas especiales

    if ( !is_array($special_pages_ids) )  { //crea la opccion si aun no esta creada
    	add_option('special_pages_ids');
    	$special_pages_ids=array();
    }

    foreach ($special_pages as $slug => $args) { // genera y revisa las paginas

    	$slug = trim($slug);
    	$post_parent_id = empty(trim($args[1])) ? 0 : $special_pages_ids[ trim($args[1]) ];

    	if (!isset($special_pages_ids[$slug])) { // si el slug existe
    		$page_by_slug = getSpecialPageBySlug($slug,$post_parent_id);

    		if ($page_by_slug)  {
    			$special_pages_ids[$slug] = $page_by_slug->ID;
    		}

    	}

    	if (!isset($special_pages_ids[$slug])) { // si el slug exixste pero en la papelera
    		$page_trashed = getSpecialPageBySlugTrashed($slug,$post_parent_id);

    		if ($page_trashed )  {
    			$special_pages_ids[$slug] = $page_trashed->ID;
    		}

    	}

    	$CreaPost = true;
    	if( isset($special_pages_ids[$slug]) ){ // si ya se ha creado

    		$trased =  wp_untrash_post($special_pages_ids[$slug]); // por si esta borrado

    		$special_pages_ids[$slug] = intval($special_pages_ids[$slug]);

    		$pagina = get_post( $special_pages_ids[$slug] ); //traemos el post


    		if ( $pagina ) { // si no borraron permanentemente la pagina
    			$CreaPost = false;
    			$actualizar = false;

    			$pagina_by_slug = getSpecialPageBySlug($slug,$post_parent_id );

    			if($pagina_by_slug){ // verifica que el slug no lo tenga otra pagina
    				$pagina = ($pagina_by_slug->ID != $pagina->ID ) ? $pagina_by_slug : $pagina ;
    				$special_pages_ids[$slug] = $pagina->ID;
    			}else{ // si el slug no pertenece a ninguna pagina lo manda a crear
    				$CreaPost = true;
    			}

    			if (!$CreaPost) { // si no tiene que crearse
    				$pagina_args = array(
    					'ID'		   =>   $pagina->ID,
    					'post_title'   =>   $pagina->post_title,
    					'post_content' =>   $pagina->post_content,
    				);
    				// si no esta publicada
    				if ( $pagina->post_status != 'publish' ){ // evita que las paginas se coloquen en borador o se envien a la papelera.
    					$pagina_args['post_status'] = 'publish';
    					$actualizar = true;
    				}

    				// si modificaron el post parent
    				if ( $pagina->post_parent != $post_parent_id ){ // evita que las paginas se cambien de padre
    					$pagina_args['post_parent'] = $post_parent_id;
    					$actualizar = true;
    				}

    				// si modificaron el slug
    				if ( $pagina->post_name != $slug ){ // evita que las paginas se cambien de slug
    					$pagina_args['post_name'] = $slug;
    					$actualizar = true;
    				}

    				if( $actualizar ){
    					wp_update_post( $pagina_args );
    				}
    			}
    		}
    	}

    	if( $CreaPost ){ // si no existe la pagina guarda

    		$page = array(
    			'post_author'  => 1,
    			'post_status'  => 'publish',
    			'post_name'	=> $slug,
    			'post_title'   => $args[0],
    			'post_type'	=> 'page',
    			'post_parent'  => $post_parent_id
    			);

    		$special_pages_ids[$slug] = wp_insert_post( $page, true );
    	}
    }

    foreach ($special_pages_ids as $slug => $id) {
    	if (!isset($special_pages[$slug]) ) {
    		unset($special_pages_ids[$slug]);
    	}
    }

    update_option('special_pages_ids',$special_pages_ids);
    $GLOBALS['special_pages_ids'] = $special_pages_ids;
});

add_action('init', function(){
	update_option('page_on_front',specialPage("home"));
	update_option('page_for_posts',0);
	update_option('show_on_front','page');
});

add_action('wp_trash_post', 'restrict_post_deletion', 10, 1);
add_action('before_delete_post', 'restrict_post_deletion', 10, 1);

function restrict_post_deletion($post_id) {
    if( in_array($post_id,$GLOBALS['special_pages_ids']) ) {
      exit(__('You cant delete this page.'));
    }
};
