<?php

namespace common\models\engine;

use Yii;
use yii\db\ActiveRecord;
use common\infrastructure\DateClass;
use yii\behaviors\TimestampBehavior;

/**
 * Exception Status Log model
 *
 * @property integer $ID
 * @property string $NAME
 * @property string $COLOR
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class ExceptionLogStatusModel extends MainModel
{
    const IS_NEW = 1;
    const IS_SUCCESS = 2;

    public $date_create;
    public $date_update;

    public static function tableName()
    {
        return self::_g(get_called_class());
    }

    public function afterFind()
    {
        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['CREATED_AT', 'UPDATED_AT'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['UPDATED_AT'],
                ],
            ],
        ];
    }

    public static function renderModel(&$elements){
        foreach ($elements as &$element){
            $element['date_create'] = DateClass::TimestampToDate($element['CREATED_AT']);
            $element['date_update'] = DateClass::TimestampToDate($element['UPDATED_AT']);
        }
    }
}