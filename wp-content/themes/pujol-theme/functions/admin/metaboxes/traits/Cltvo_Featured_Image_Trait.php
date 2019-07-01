<?php


trait Cltvo_Featured_Image_Trait {


	/* Define el metodo que inicializa el valor de la imagen */
	public static function setImageValue($img)
	{
		$image = new Cltvo_Img($img);
		return $image->img_id ? $image : null;
	}


	/*
	Es la funcion que muestra el contenido del metabox
	@param object $object en principio es un objeto de WP_post
	*/
	public function printFeaturedImage($image_name, array $path = [] ) {

		$img = $this->meta_value;
        $name_path = $image_id  = $this->meta_key;

        foreach ($path as $part) {
            $path = (string) $part;
            $img = $img[$part];
            $image_id = $image_id."_".$part;
            $name_path = $name_path."[".$part."]";
        }

	?>

		<div class="featured_image_JS">

			<div class="" style="overflow:hidden">
				<!-- <a href="#" class=""> -->
					<div class="" style="    max-width: 266px; max-height: 266px;">
						<img 						src="<?= $img ? $img->getImgSrc("full") : ""  ?>" class="featured_image-image_JS " alt=""
						style="	<?php if (!$img): ?> display:none;<?php endif; ?> width:100%;"
							>
					</div>

			</div>
			<div class="">
				<p class=" howto featured_image-howto_JS"	<?php if (!$img): ?> style="display:none"<?php endif; ?> >
					<?= __("Clik en la imagen para cambiar " ,TRANSDOMAIN).$image_name ?>
				</p>

				<input
					type="hidden"
					class=" featured_image-input_JS"
					placeholder="URL"
					name="<?= $name_path; ?>"
					id="<?= $image_id; ?>"
					value="<?= $img ? $img->img_id : ""; ?>"
				/>
			</div>
			<div class="" style="    margin: 1em 0;">
				<a href="#"  class="featured_image-add_JS" <?php if ( $img ) : ?>	style="display:none" <?php endif; ?> >
					<?= __("Agregar " ,TRANSDOMAIN).$image_name ?>
				</a>
				<a href="#"  class="featured_image-remove_JS" <?php if ( !$img  ) : ?>	style="display:none" <?php endif; ?> >
					<?= __("Remover " ,TRANSDOMAIN).$image_name ?>
				</a>
			</div>
		</div>
	<?php }
}
