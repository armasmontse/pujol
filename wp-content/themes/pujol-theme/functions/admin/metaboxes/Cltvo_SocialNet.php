<?php
require_once 'traits/Cltvo_Featured_Image_Trait.php';

class Cltvo_SocialNet extends Cltvo_Metabox_Master
{
    use Cltvo_Featured_Image_Trait;
    /**
     * sobre escribiendo las opcciones del master
     */
    protected $description_metabox = "Contacto";
    protected $post_type = "page";


    /**
     * proiedades de esta clase
     */
    public static $redesConUrl = [
                        'facebook'      => 'Facebook',
                        'instagram'     => 'Instagram',
						'twitter'       => 'Twitter',
						'spotify'       => 'Spotify:',
						// 'google' => 'Google plus:',
						// 'tumblr' => 'Tumblr:'
					];

    protected static $redesSinUrl = [
                        'mail'            => 'Email:',
                        'phone_1'         => 'Teléfono 1:',
                        'phone_2'         => 'Teléfono 2:',

                        'mail'            => 'Email:',

                        'address'         => "Dirección",
                        'google_maps'     => "Link a mapa"
					];

    protected static $images = [
                        'image'           => 'Imagen',
                        'map'         => 'Mapa',
					];


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

        foreach (self::$redesSinUrl as $red => $imagen) {
			$meta[$red] = isset($meta[$red]) ? $meta[$red] :  "";
		}

		foreach (self::$redesConUrl as $red => $imagen) {
			$meta[$red] = isset($meta[$red]) ? $meta[$red] :  array('label'=> '', 'url'=> '');
            $meta[$red]['label'] = isset($meta[$red]['label']) ? $meta[$red]['label'] :  "";
            $meta[$red]['url'] = isset($meta[$red]['url']) ? $meta[$red]['url'] :  "";
		}

        foreach (self::$images as $red => $imagen) {
            $meta[$red] =  static::setImageValue (isset($meta[$red]) ? $meta[$red] :  0);
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
        		<table class="ancho_100" >
        			<tr>
        				<td>
        					 Email:
        				</td>
        				<td>
        					<input type="email" placeholder="ejemplo@ejemplo.com" name="<?php echo  $this->meta_key; ?>[mail]" id="<?php echo  $this->meta_key; ?>[mail]" value="<?php echo $this->meta_value['mail']; ?>" class="ancho_100 " />
        				</td>
        			</tr>
                    <tr>
                        <td >
                            <?= __("Teléfono 1" ,TRANSDOMAIN) ?>:
                        </td>
                        <td>
                            <input type="text" placeholder="+(52 55) 5555 5555 " name="<?php echo  $this->meta_key; ?>[phone_1]" id="<?php echo  $this->meta_key; ?>[phone_1]" value="<?php echo $this->meta_value['phone_1']; ?>" class="ancho_100" />
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <?= __("Teléfono 2" ,TRANSDOMAIN) ?>:
                        </td>
                        <td>
                            <input type="text" placeholder="+(52 55) 5555 5555 " name="<?php echo  $this->meta_key; ?>[phone_2]" id="<?php echo  $this->meta_key; ?>[phone_2]" value="<?php echo $this->meta_value['phone_2']; ?>" class="ancho_100" />
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <?= __("Dirección" ,TRANSDOMAIN) ?>:
                        </td>
                        <td>
                            <textarea
                                rows="4"
                                placeholder="Tennyson 133,
Polanco,
C.P. 11550,
CDMX, México
"
                                name="<?php echo  $this->meta_key; ?>[address]"
                                id="<?php echo  $this->meta_key; ?>[address]"
                                class="ancho_100" ><?php echo $this->meta_value['address']; ?></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td >
                            <?= __("Google Map" ,TRANSDOMAIN) ?>:
                        </td>
                        <td>
                            <input type="url" placeholder="https://www.google.com/maps" name="<?php echo  $this->meta_key; ?>[google_maps]" id="<?php echo  $this->meta_key; ?>[google_maps]" value="<?php echo $this->meta_value['google_maps']; ?>" class="ancho_100" />
                        </td>
                    </tr>
                    <tr ALIGN="CENTER">
                        <td>
                            <h3><?= __("Imagen",TRANSDOMAIN)  ?></h3>
                            <?php $this->printFeaturedImage(__("imagen",TRANSDOMAIN) ,["image"]) ?>
                        </td>
                        <td>
                            <h3><?= __("Mapa",TRANSDOMAIN)  ?></h3>
                            <?php $this->printFeaturedImage(__("mapa",TRANSDOMAIN) ,["map"]) ?>
                        </td>
                    </tr>
        			<?php foreach (self::$redesConUrl as $slug => $nombre): ?>
        				<tr>
        					<td>
        						<?php echo $nombre; ?>
        					</td>
        					<td>
        						<?php $this->social_network_url($slug); ?>
        					</td>
        				</tr>

        			<?php endforeach; ?>

        		</table>
        		<?php
	}



    /**
     * Imprime los input de las redes sociales
     *
     * Parametros:
     *
     * @param string $slug slug de la red social
     * @param array $meta array con los valores url y label
     */

    private function social_network_url($slug) {
    	 ?>
            <p>
                <label for="<?php echo $this->meta_key."_".$slug; ?>_label" > <?= __("Nombre" ,TRANSDOMAIN) ?>:</label><br>
                <input type="text"
                      placeholder="<?= $slug ?>"
                      name="<?php echo $this->meta_key."[".$slug."][label]"; ?>"
                      id="<?php echo $this->meta_key."_".$slug; ?>_label"
                      value="<?php echo $this->meta_value[$slug]['label']; ?>"
                      class="ancho_100" />
            </p>
    		<p>
    			<label for="<?php echo $this->meta_key."_".$slug; ?>_url" ><?= __("Link" ,TRANSDOMAIN) ?>:</label><br>
    			<input type="url"
                        placeholder="http://"
                        name="<?php echo $this->meta_key."[".$slug."][url]"; ?>"
                        id="<?php echo $this->meta_key."_".$slug; ?>_url"
                        value="<?php echo $this->meta_value[$slug]['url']; ?>"
                        class="ancho_100" />
    		</p>
    	 <?php
    }

}
