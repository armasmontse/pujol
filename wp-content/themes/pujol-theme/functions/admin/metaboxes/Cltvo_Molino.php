<?php
require_once 'traits/Cltvo_Featured_Image_Trait.php';
require_once 'traits/Cltvo_Wp_Editor_Trait.php';


class Cltvo_Molino extends Cltvo_Metabox_Master
{
    use Cltvo_Featured_Image_Trait;
    use Cltvo_Wp_Editor_Trait;

    /**
     * sobre escribiendo las opcciones del master
     */
    protected $description_metabox = "Molino";
    protected $post_type = "page";

  /**
	 * define el metodo donde se mostrara el meta
	 * @return boolean si es verdadero el meta sera desplegado en el admin en caso constrario no
	 */
	public static function metaboxDisplayRule(){
        // return (isset($_GET['post']) && $_GET['post'] ) ? 'template-page.php' == get_post_meta($_GET['post'], '_wp_page_template', true) : false;
		return isSpecialPage("molino");
	}


    /**
     * define el metodo que inicializa el valor del meta
     */
    public static function setMetaValue($meta){

        $meta = is_array($meta) ? $meta : [] ;

        for ($i=1; $i <=4 ; $i++) {
            $meta["image_".$i] =  static::setImageValue (isset($meta["image_".$i]) ? $meta["image_".$i] :  0);
        }
        $meta["content"] =isset($meta["content"]) ? $meta["content"] :  "";
        $meta["email"] =isset($meta["email"]) ? $meta["email"] :  "";
        $meta["hours"] =isset($meta["hours"]) ? $meta["hours"] :  "";

        $meta["address"] = static::setAddress($meta);

        return $meta;
    }



    public static function setAddress($meta)
    {
        $address = isset($meta["address"]) && is_array($meta["address"]) ? $meta["address"] :  [];

        $address["link"] = isset($address["link"]) && is_string($address["link"]) ?  $address["link"] : "";
        $address["link_label"] = isset($address["link_label"]) && is_string($address["link_label"]) ?  $address["link_label"] : "";
        $address["address"] = isset($address["address"]) && is_string($address["address"]) ?  $address["address"] : "";

        return $address;
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
                    <h4><?= __("Imagen superior izquierda",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen derecha ",TRANSDOMAIN) ,["image_1"]) ?>
                </td>
                <td  style="width:40%">
                    <h4><?= __("Contenido" ,TRANSDOMAIN) ?>:</h4>
                    <?php  $this->printWpEditor(["content"])?>
                </td>
                <td  ALIGN="CENTER">
                    <h4><?= __("Imagen superior ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen izquierda ",TRANSDOMAIN) ,["image_2"]) ?>
                </td>

            </tr>
            <tr >
                <td colspan="2" ALIGN="right" VALIGN="top">
                    <h4><?= __("Imagen inferior izquierda ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen derecha ",TRANSDOMAIN) ,["image_3"]) ?>
                </td>
                <td rowspan="2">
                    <h4><?= __("Horarios",TRANSDOMAIN)  ?></h4>
                    <textarea
                        rows="2"
                        placeholder="Abrimos todos los días
de 8:00 a 17:00 h.
"
                        name="<?php echo  $this->meta_key; ?>[hours]"
                        id="<?php echo  $this->meta_key; ?>_hours_"
                        class="ancho_100" ><?php echo $this->meta_value['hours']; ?></textarea>


                    <h4><?= __("Imagen inferior derecha ",TRANSDOMAIN)  ?></h4>
                    <?php $this->printFeaturedImage(__("imagen derecha ",TRANSDOMAIN) ,["image_4"]) ?>


                    <h4><?= __("Dirección",TRANSDOMAIN)  ?></h4>

                    <label for="<?php echo $this->meta_key."_"."link_label"; ?>" ><?= __("Nombre del link" ,TRANSDOMAIN) ?>:</label><br>
        			<input type="text"
                            placeholder="google map"
                            name="<?php echo $this->meta_key."[address][link_label]"; ?>"
                            id="<?php echo $this->meta_key."_address_link_label"; ?>"
                            value="<?php echo $this->meta_value["address"]["link_label"]; ?>"
                            class="ancho_100" />

                    <label for="<?php echo $this->meta_key."_"."link"; ?>" ><?= __("Link" ,TRANSDOMAIN) ?>:</label><br>
        			<input type="url"
                            placeholder="http://"
                            name="<?php echo $this->meta_key."[address][link]"; ?>"
                            id="<?php echo $this->meta_key."_address_link"; ?>"
                            value="<?php echo $this->meta_value["address"]["link"]; ?>"
                            class="ancho_100" />


                    <label for="<?php echo  $this->meta_key; ?>_address_address"><?= __("Dirección",TRANSDOMAIN)  ?></label>
                    <textarea
                        rows="4"
                        placeholder="Tennyson 133,
Benjamín Hill 146-A
Hipódromo Condesa
CP 06140
"
                        name="<?php echo  $this->meta_key; ?>[address][address]"
                        id="<?php echo  $this->meta_key; ?>_address_address"
                        class="ancho_100" ><?php echo $this->meta_value['address']['address']; ?></textarea>
                </td>
            </tr>
            <tr ALIGN="left">
                <td colspan="2">
                    <h4><?= __("Contacto ",TRANSDOMAIN)  ?></h4>
					<input type="email" placeholder="ejemplo@ejemplo.com" name="<?php echo  $this->meta_key; ?>[email]" id="<?php echo  $this->meta_key; ?>[email]" value="<?php echo $this->meta_value['email']; ?>" class="ancho_100 " />
                </td>
            </tr>
        </table>

        <?php

	}


}
