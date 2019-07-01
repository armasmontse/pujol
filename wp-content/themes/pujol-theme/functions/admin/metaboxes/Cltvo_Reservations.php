<?php
require_once 'traits/Cltvo_Featured_Image_Trait.php';
require_once 'traits/Cltvo_Wp_Editor_Trait.php';

class Cltvo_Reservations extends Cltvo_Metabox_Master
{
    use Cltvo_Featured_Image_Trait;
    use Cltvo_Wp_Editor_Trait;
    /**
     * sobre escribiendo las opcciones del master
     */
    protected $description_metabox = "Reservations";
    protected $post_type = "page";

  /**
	 * define el metodo donde se mostrara el meta
	 * @return boolean si es verdadero el meta sera desplegado en el admin en caso constrario no
	 */
	public static function metaboxDisplayRule(){
        // return (isset($_GET['post']) && $_GET['post'] ) ? 'template-page.php' == get_post_meta($_GET['post'], '_wp_page_template', true) : false;
		return isSpecialPage("home");
	}

  protected function getWpEditorTinymce()
  {
      return [
          'toolbar1'      => 'underline,bold,italic,spellchecker,charmap,undo,redo,link',
          'toolbar2'      => '',
          'toolbar3'      => '',
      ];
  }


    /**
     * define el metodo que inicializa el valor del meta
     */
    public static function setMetaValue($meta){

        $meta = is_array($meta) ? $meta : [] ;

        for ($i=1; $i <=2 ; $i++) {
            $meta["location_".$i] =  static::setImageValue (isset($meta["location_".$i]) ? $meta["location_".$i] :  0);
            $meta["content_".$i] =isset($meta["content_".$i]) ? $meta["content_".$i] :  "";
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
            <tr ALIGN="CENTER">
                <td>
                    <h4><?= __("Pujol ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("pujol ",TRANSDOMAIN) ,["location_1"]) ?>
                </td>
                <td>
                    <h4><?= __("Omakase ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("omakase ",TRANSDOMAIN) ,["location_2"]) ?>
                </td>
            </tr>
            <tr >
                <td>
                  <h4><?= __("Contenido Pujol" ,TRANSDOMAIN) ?>:</h4>
                  <?php  $this->printWpEditor(["content_1"])?>
                </td>
                <td>
                  <h4><?= __("Contenido Omakase" ,TRANSDOMAIN) ?>:</h4>
                  <?php  $this->printWpEditor(["content_2"])?>
                </td>
            </tr>
        </table>

        <?php

	}


}
