<?php
namespace common\models\engine;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use common\infrastructure\DateClass;

/**
 * Menu model
 *
 * @property integer $ID
 * @property string $TITLE
 * @property string $ANCHOR
 * @property integer $IS_ACTIVE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class MenuModel extends MainModel
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
        $this->isActive = $this->IS_ACTIVE == self::IS_ACTIVE ? true : false ;
    }

    public static function find(){
        return new MenuQuery(get_called_class());
    }
}

class MenuQuery extends ActiveQuery{
    /**
     * Только активные записи
     */
    public function isActive(){
        return $this->andWhere(['IS_ACTIVE' => MenuModel::IS_ACTIVE]);
    }
}