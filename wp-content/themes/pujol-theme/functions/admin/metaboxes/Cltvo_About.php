<?php
require_once 'traits/Cltvo_Featured_Image_Trait.php';
require_once 'traits/Cltvo_Wp_Editor_Trait.php';


class Cltvo_About extends Cltvo_Metabox_Master
{
    use Cltvo_Featured_Image_Trait;
    use Cltvo_Wp_Editor_Trait;

    /**
     * sobre escribiendo las opcciones del master
     */
    protected $description_metabox = "Acerca de";
    protected $post_type = "page";

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

        for ($i=1; $i <=3 ; $i++) {
            $meta["image_".$i] =  static::setImageValue (isset($meta["image_".$i]) ? $meta["image_".$i] :  0);
        }
        $meta["content"] =isset($meta["content"]) ? $meta["content"] :  "";
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
            <tr >
                <td ALIGN="CENTER">
                    <h4><?= __("Imagen superior ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen superior ",TRANSDOMAIN) ,["image_1"]) ?>
                </td>
                <td rowspan="2" ALIGN="CENTER">
                    <h4><?= __("Imagen inferior ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen inferior ",TRANSDOMAIN) ,["image_2"]) ?>
                </td>
                <td rowspan="2" style="width:40%">
                    <h4><?= __("Contenido" ,TRANSDOMAIN) ?>:</h4>
                    <?php  $this->printWpEditor(["content"])?>
                </td>
            </tr>
            <tr ALIGN="CENTER">
                <td>
                    <h4><?= __("Imagen derecha ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen derecha ",TRANSDOMAIN) ,["image_3"]) ?>
                </td>
            </tr>
        </table>

        <?php

	}


}
