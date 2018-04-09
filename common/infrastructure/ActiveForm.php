<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.01.2018
 * Time: 12:50
 */

namespace common\infrastructure;


class ActiveForm extends \yii\bootstrap\ActiveForm
{
    public $fieldClass = 'frontend\infrastructure\ActiveField';

    /**
     * @inheritdoc
     * @return ActiveField the created ActiveField object
     */
    public function field($model, $attribute, $options = [])
    {
        return parent::field($model, $attribute, $options);
    }
}