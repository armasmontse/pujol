<?php

trait Cltvo_Repiter_Trait
{

    protected $base_key	= "__next-key__";


    public static function setValuesOfSingleImputRepiterInPath($array,$key)
    {
        return  static::setValuesOfSingleImputRepiter((is_array($array) && isset($array[$key])) ? $array[$key] : []);
    }

    public static function setValuesOfSingleImputRepiter($values)
    {
        return  array_filter(is_array($values) ? $values : [] ,function($value){
            return !empty($value);
        });
    }

    public static function setValuesOfMultiImputRepiterInPath(array $item_parts, $array,$key)
    {
        return  static::setValuesOfMultiImputRepiter($item_parts, (is_array($array) && isset($array[$key])) ? $array[$key] : []);
    }

    public static function setValuesOfMultiImputRepiter(array $item_parts,$values)
    {
        $initialized_values = array_map(function($single_values) use ($item_parts) {
            return  static::initializeMultiImputItem( $item_parts, $single_values);
        },is_array($values) ? $values : [] );
        return  array_filter($initialized_values ,function($values)use ($item_parts) {
            $implode_value = "";
            foreach ($item_parts as $part => $part_info) {
                $implode_value .= $values->{$part};
            }
            return !empty($implode_value);
        })  ;
    }

    public static function initializeMultiImputItem(array $item_parts, $single_values = null )
    {
        $single_values = is_array($single_values) ? $single_values : is_object($single_values) ? (array) $single_values : array();

        foreach ($item_parts as $part => $part_info) {
            $single_values[$part] = (isset($single_values[$part]) && is_string($single_values[$part])) ? $single_values[$part] : "";
        }

        return (object) $single_values;
    }



    protected static function initializeInputInfo($input_info)
    {
        $input_info =  is_array($input_info) ? $input_info : array();
        $input_info["type"] = isset($input_info["type"]) ? $input_info["type"] :  "text";
        $input_info["label"] = isset($input_info["label"]) ? $input_info["label"] :  "";
        $input_info["placeholder"] = isset($input_info["placeholder"]) ? $input_info["placeholder"] :  "";

        return $input_info;
    }

    protected function printSingleItemRepiterList(array $meta_path,$placeholder)
	{
		$repiter_id = $this->meta_key;
		$input_base_name = $this->meta_key;
        $repiter_values = $this->meta_value;

        foreach ($meta_path as $new_path) {
            $repiter_id .= "_".$new_path;
            $input_base_name   .= "[".$new_path."]";
            $repiter_values    = static::setValuesOfSingleImputRepiterInPath($repiter_values,$new_path);
        }

		?><div id="<?= $repiter_id; ?>" class="cltvo_repiter_JS">
            <input type="hidden" name="<?= $input_base_name; ?>" value="" id="<?php echo $repiter_id ?>-hidden_JS">
			<div style="width: 100%; padding: 0px 5px " class=" <?php echo $repiter_id ?>-table_JS">
	            <?php foreach ($repiter_values as $key => $value) {
					$this->printSingleItemRow($repiter_id,$input_base_name,$key,$placeholder,$value);
				} ?>
			</div>
			<div  style="display:none; "  id = "<?php echo $repiter_id ?>-template" >
				<?php $this->printSingleItemRow($repiter_id,$input_base_name,$this->base_key,$placeholder); ?>
			</div>
			<div style="width: 100%; text-align: right; margin-top: 10px;">
				<button type="button" class="button <?php echo $repiter_id ?>-add_JS " style="display: inline-block; margin-top: 0px;" meta-name="">
					Agregar
				</button>
			</div>
		</div><?php
	}

    protected function printSingleItemRow($repiter_id,$input_base_name,$key,$placeholder,$value = "")
    {
        $input_name = $input_base_name.'['.$key.']';
        $input_id 	= $repiter_id.'_'.$key;
        ?>

        <div style="width:calc(100% - 12px); border-bottom: 1px solid #eee; padding: 5px; box-shadow: 0px 0px 5px #ccc;    margin: 5px auto 0px;"
        class="<?php echo $repiter_id ?>-row_JS" data-row-key = "<?php echo $key ?>"
        >
            <div style="    display: inline-block; width: calc(100% - 15px);">
                <input type="text"
                    class=" <?php if ($this->base_key !=  strval($key) ): ?>  i18n-multilingual <?php endif; ?>   <?php echo $repiter_id ?>-input_JS "
                    style="width:100%"
                    placeholder="<?= $placeholder ?>"
                    name="<?php echo $input_name ?>"
                    id="<?php echo $input_id ?>"
                    value="<?php  echo $value; ?>"
                    <?php if ($this->base_key ==  strval($key) ): ?> disabled="disabled"<?php endif; ?>
                    >
            </div>
            <div style="text-align: right; color:red; cursor:pointer;       display: inline-block;  width: 10px; "  >
                <a class="<?php echo $repiter_id ?>-delete_JS " title="borrar" style="
                    background-color: transparent;
                    border: none;

                    line-height: normal;
                    padding: 1px 5px;
                    color: red;
                    ">x</a>
            </div>
        </div>
        <?php
    }

    protected function printMultiItemRepiterList(array $item_parts, array $meta_path)
    {
        $repiter_id = $this->meta_key;
        $input_base_name = $this->meta_key;
        $repiter_values = $this->meta_value;

        foreach ($meta_path as $new_path) {
            $repiter_id .= "_".$new_path;
            $input_base_name   .= "[".$new_path."]";
            $repiter_values    = static::setValuesOfMultiImputRepiterInPath($item_parts,$repiter_values,$new_path);
        }

        ?><div id="<?= $repiter_id; ?>" class="cltvo_repiter_JS">
            <input type="hidden" name="<?= $input_base_name; ?>" value="" id="<?php echo $repiter_id ?>-hidden_JS">
            <div style="width: 100%; padding: 0px 5px " class=" <?php echo $repiter_id ?>-table_JS">
                <?php foreach ($repiter_values as $key => $value) {
                    $this->printMultiItemRow($item_parts,$repiter_id,$input_base_name,$key,$value);
                } ?>
            </div>
            <div  style="display:none; "  id = "<?php echo $repiter_id ?>-template" >
                <?php $this->printMultiItemRow($item_parts,$repiter_id,$input_base_name,$this->base_key); ?>
            </div>
            <div style="width: 100%; text-align: right; margin-top: 10px;">
                <button type="button" class="button <?php echo $repiter_id ?>-add_JS " style="display: inline-block; margin-top: 0px;" meta-name="">
                    Agregar
                </button>
            </div>
        </div><?php
    }

    protected function printMultiItemRow(array $item_parts,$repiter_id,$input_base_name,$key,$values = null)
    {
        $input_base_name = $input_base_name.'['.$key.']';
        $input_base_id 	= $repiter_id.'_'.$key;

        $values = static::initializeMultiImputItem($item_parts,$values);
        ?>

        <div style="width:calc(100% - 12px); border-bottom: 1px solid #eee; padding: 5px; box-shadow: 0px 0px 5px #ccc;    margin: 5px auto 0px;"
        class="<?php echo $repiter_id ?>-row_JS" data-row-key = "<?php echo $key ?>"
        >
        <div style="text-align: right; color:red; cursor:pointer;       display: inline-block;  width: 100%; "  >
            <a class="<?php echo $repiter_id ?>-delete_JS " title="borrar" style="
                background-color: transparent;
                border: none;

                line-height: normal;
                padding: 1px 5px;
                color: red;
                ">x</a>
        </div>
            <div style="    display: inline-block; width: 100%;">
                <?php foreach ($item_parts as $part => $part_info):

                    $input_name = $input_base_name.'['.$part.']';
                    $input_id 	= $input_base_id.'_'.$part;
                    $part_info = static::initializeInputInfo($part_info);
                    ?>


                    <label for="<?php echo $input_id ?>"><?php echo $part_info['label']; ?></label>

                    <?php if ($part_info['type'] == "textarea"): ?>
                        <textarea
                            class=" <?php if ($this->base_key !=  strval($key) ): ?>  i18n-multilingual <?php endif; ?>   <?php echo $repiter_id ?>-input_JS "
                            placeholder="<?php echo $part_info['placeholder']; ?>"
                            name="<?php echo $input_name ?>"
                            id="<?php echo $input_id ?>"
                            rows="2"
                            style="width:100%"
                            <?php if ($this->base_key ==  strval($key) ): ?> disabled="disabled"<?php endif; ?>
                        ><?php  echo $values->{$part}; ?></textarea>

                    <?php else: ?>
                        <input type="<?php echo $part_info['type']; ?>"
                            class=" <?php if ($this->base_key !=  strval($key) ): ?>  i18n-multilingual <?php endif; ?>   <?php echo $repiter_id ?>-input_JS "
                            style="width:100%"
                            placeholder="<?php echo $part_info['placeholder']; ?>"
                            name="<?php echo $input_name ?>"
                            id="<?php echo $input_id ?>"
                            value="<?php  echo $values->{$part}; ?>"
                            <?php if ($this->base_key ==  strval($key) ): ?> disabled="disabled"<?php endif; ?>
                            >
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>


        </div>
        <?php
    }
}
