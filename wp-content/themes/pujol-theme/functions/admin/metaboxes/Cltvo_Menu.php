<?php
require_once 'traits/Cltvo_Repiter_Trait.php';
require_once 'traits/Cltvo_Gallery_Trait.php';


class Cltvo_Menu extends Cltvo_Metabox_Master
{
    use Cltvo_Repiter_Trait;
    use Cltvo_Gallery_Trait;

    /**
     * sobre escribiendo las opcciones del master
     */
    protected $description_metabox = "Menú";
    protected $post_type = "page";

  /**
	 * define el metodo donde se mostrara el meta
	 * @return boolean si es verdadero el meta sera desplegado en el admin en caso constrario no
	 */
	public static function metaboxDisplayRule(){
        // return (isset($_GET['post']) && $_GET['post'] ) ? 'template-page.php' == get_post_meta($_GET['post'], '_wp_page_template', true) : false;
		return isSpecialPage("home");
	}

    protected static function getItemParts()
	{
		return [
            "title"=>[

                    "type"			=>	"textarea",
                    "label"			=>	"Category:",
                    "placeholder"	=>	"Category...",
                
            ],
            "content"			=> [
                "type"			=>	"textarea",
                "label"			=>	"Name:",
                "placeholder"	=>	"Lubina, jugo de cacahuazintle...",
            ],

		];
	}

    protected static function getGalleyParts()
	{
		return [
            "imagen"			=> [
                    "image_id"
                ]
            ];
	}

    /**
     * define el metodo que inicializa el valor del meta
     */
    public static function setMetaValue($meta){

        $meta = is_array($meta) ? $meta : [] ;

        $meta["items"] = static::setValuesOfMultiImputRepiterInPath(static::getItemParts(), $meta,"items");

        $meta["gallery"] = static::setGalleryInPath(static::getGalleyParts(), $meta, "gallery");

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
            <tr valign  ="TOP">
                <td style="width:50%">
                    <h4 style="text-align:center"><?= __("Photografías ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printGallery(static::getGalleyParts(),["gallery"]);; ?>
                </td>
                <td style="width:50%">
                    <h4 style="text-align:center"><?= __("Menú ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printMultiItemRepiterList(static::getItemParts(),["items"]);; ?>
                </td>
            </tr>
        </table>

        <?php

	}



}
