<?php
require_once 'traits/Cltvo_Featured_Image_Trait.php';

class Cltvo_Breaks extends Cltvo_Metabox_Master
{
    use Cltvo_Featured_Image_Trait;
    /**
     * sobre escribiendo las opcciones del master
     */
    protected $description_metabox = "Descansos";
    protected $post_type = "page";
    protected $position = "side"; // posicion

  /**
	 * define el metodo donde se mostrara el meta
	 * @return boolean si es verdadero el meta sera desplegado en el admin en caso constrario no
	 */
	public static function metaboxDisplayRule(){
        // return (isset($_GET['post']) && $_GET['post'] ) ? 'template-page.php' == get_post_meta($_GET['post'], '_wp_page_template', true) : false;
		return isSpecialPage("home");
	}


    /**
     * define el metodo que inicializa el valor del meta
     */
    public static function setMetaValue($meta){

        $meta = is_array($meta) ? $meta : [] ;

        for ($i=1; $i <=2 ; $i++) {
            $meta["break_".$i] =  static::setImageValue (isset($meta["break_".$i]) ? $meta["break_".$i] :  0);
        }

        return $meta;
    }


	/**
	 * Es la funcion que muestra el contenido del metabox
	 * @param object $object en principio es un objeto de WP_post
	 */
	public function CltvoDisplayMetabox( $object ){

        ?>
        <style media="screen">
            .ancho_100{
                width: 100%;
            }
        </style>

        <table class="ancho_100">
            <?php for ($i=1; $i <=2 ; $i++): ?>
                <tr >
                    <td>
                        <h4><?= __("Descanso ".$i,TRANSDOMAIN)  ?></h4>
                        <?php $this->printFeaturedImage(__("descanso ".$i,TRANSDOMAIN) ,["break_".$i]) ?>
                    </td>
                </tr>

            <?php endfor; ?>
        </table>

        <?php

	}


}
