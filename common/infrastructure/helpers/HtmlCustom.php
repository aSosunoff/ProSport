<?php
namespace common\infrastructure\helpers;

use yii\bootstrap\Html;

class HtmlCustom extends Html
{
    public static $div = 'div';

    public static function box_switch($name, $checked = false, $options = [])
    {
        $labelText = $name;
        if (isset($options['label'])) {
            if($options['label']){
                $labelText = $options['label'];
            } else {
                $labelText = "";
            }

            unset($options['label']);
        }

        if(!isset($options['id'])){
            $options['id'] = $name;
        }

        $hidenInput = parent::hiddenInput($name, 0, []);
        $mainInput = parent::checkbox($name, $checked, $options);
        $button = parent::tag('div', '', ['class' => 'button']);
        $labelForButton = parent::label($hidenInput . $mainInput . $button, $options['id'], null);
        $labelForText = parent::label($labelText, $options['id'], null);

        $r = parent::checkbox($name, $checked, $options);

        return parent::tag(self::$div, $labelForButton . $labelForText, ['class' => 'checkbox box-switch']);
    }
}