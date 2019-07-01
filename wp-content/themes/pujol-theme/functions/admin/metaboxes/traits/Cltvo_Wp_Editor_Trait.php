<?php

trait Cltvo_Wp_Editor_Trait
{

    protected function printWpEditor(array $path = [])
    {
        $editor_value = $this->meta_value;
        $name_path = $editor_id  = $this->meta_key;

        foreach ($path as $part) {
            $path = (string) $part;
            $editor_value = $editor_value[$part];
            $editor_id = $editor_id."_".$part;
            $name_path = $name_path."[".$part."]";
        }

        wp_editor($editor_value, strtolower($editor_id), array(
                   'textarea_name'	=> 	$name_path,
                   'media_buttons'	=> 	false,
                   'tinymce'        => $this->getWpEditorTinymce(),
               ));
    }

    protected function getWpEditorTinymce()
    {
        return [
            'toolbar1'      => 'underline,bold,italic,spellchecker,charmap,undo,redo',
            'toolbar2'      => '',
            'toolbar3'      => '',
        ];
    }

}
