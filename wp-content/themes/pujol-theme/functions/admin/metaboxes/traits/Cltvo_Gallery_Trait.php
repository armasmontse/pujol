<?php

trait Cltvo_Gallery_Trait
{

    public static function setGalleryInPath(array $item_parts, $array,$key)
    {
        return  static::setGalleryMeta($item_parts, (is_array($array) && isset($array[$key])) ? $array[$key] : []);
    }

    public static function setGalleryMeta(array $image_parts,$gallery ){
        return is_array($gallery) ? static::setGalleryValues($image_parts, $gallery) : [];
    }

    public static function setGalleryValues(array $image_parts,array $gallery)
    {

        return array_map(function($image) use ($image_parts) {
            return static::initializeGallerryItem( $image_parts, $image);
        }, $gallery);
    }

    public static function initializeGallerryItem(array $image_parts, $image = null )
    {
        $image = is_array($image) ? $image : is_object($image) ? (array) $image : array();

        foreach ($image_parts as $part => $part_info) {
            $image[$part] = (isset($image[$part]) && (is_string($image[$part]) || is_integer($image[$part]))  ) ? $image[$part] : "";
        }

        return (object) $image;
    }

    public static function getGalleryImages(array $gallery){
        return array_filter(array_map(function($img_arr){
            $image = new Cltvo_Img($img_arr->imagen);
            return $image->img_id ? $image : null;
        },$gallery ), function($img){
            return $img;
        }) ;
    }

    public function drawGalleryTemplate($gallery) {
        $gallery_images = array_map(function($image) {
            $image->url =  wp_get_attachment_url($image->imagen);
            return $image;
        }, $gallery);
        $gallery_images_json = json_encode($gallery_images);
        ?>
            <tr>
                <td>
                    <style>
                        .gallery__image {
                            height: 150px;
                            width: 80%;
                            background-size: cover;
                            background-position: center;
                            display: inline-block;
                        }

                        .gallery__image-container:nth-child(2n){
                            text-align: right;
                        }

                        .gallery__image-container {
                            position: relative;
                            width: 100%;
                            display: inline-block;
                            margin: 0px 10px 10px 0px;
                        }

                        .gallery_delete {
                            border: none;
                            line-height: normal;
                            padding-top: 0.2em;
                            padding-right: 0.5em;
                            padding-bottom: 0.2em;
                            padding-left: 0.5em;
                            margin: 5px;
                            color: red;
                            cursor: pointer;
                            border-radius: 50%;
                            display: inline-block;
                            border-bottom: 1px solid #eee;
                            box-shadow: 0px 0px 5px #ccc;
                            background-color: white;
                        }
                    </style>
                    <div id="<?php echo $this->meta_key ?>" class="cltvo_gallery_container_JS" data-gallery-var="<?php echo $this->meta_key ?>"></div>

                    <div class="ancho_100" style="text-align:right">
                        <button class="button add-image-to-gallery_JS" data-gallery-container-id="<?php echo $this->meta_key ?>">Agregar</button>
                    </div>
                    <script>
                        var <?php echo $this->meta_key ?> = JSON.parse('<?php echo  $gallery_images_json ?>');
                        initGallery('<?php echo $this->meta_key ?>', <?php echo $this->meta_key ?>)
                    </script>
                </td>
            </tr>
        <?php
    }


    public function printGallery(array $gallery_parts, array $meta_path)
    {

        $images = $this->meta_value;

        foreach ($meta_path as $new_path) {
            $images    = static::setGalleryInPath($gallery_parts,$images,$new_path);
        }
        ?>
            <div id="table__galeria">
                <table class="table__galeria ancho_100" cellpadding="0" cellspacing="0">
                    <tbody id="tbody__imagen_JS">
                        <?php $this->drawGalleryTemplate($images); ?>
                    </tbody>
                </table>
            </div>
        <?php
    }

}
