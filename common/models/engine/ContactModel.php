<?php

namespace common\models\engine;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use common\infrastructure\DateClass;

/**
 * Contact model
 *
 * @property integer $ID
 * @property string $ADDRESS
 * @property string $PHONE
 * @property string $MAIL
 * @property string $MAP
 * @property integer $ACTIVE_FLAG
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class ContactModel extends MainModel
{
    public $date_create;
    public $date_update;
    public $isActive;

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

    public static function tableName()
    {
        return self::_g(get_called_class());
    }

    public function afterFind(){
        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);
        $this->isActive = $this->ACTIVE_FLAG == self::IS_ACTIVE ? true : false ;
    }

    public static function find(){
        return new ContactQuery(get_called_class());
    }
}

class ContactQuery extends ActiveQuery{
    /**
     * Только активные записи
     */
    public function isActive(){
        return $this->andWhere(['ACTIVE_FLAG' => ContactModel::IS_ACTIVE]);
    }
}