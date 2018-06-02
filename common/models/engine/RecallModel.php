<?php

namespace common\models\engine;

use common\models\form\RecallForm;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use common\infrastructure\DateClass;

/**
 * Recall model
 *
 * @property integer $ID
 * @property string $NAME
 * @property string $TEXT
 * @property string $IMG
 * @property boolean $CHECK
 * @property boolean $I_AGREE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class RecallModel extends MainModel
{
    const CHECK = 1;

    public $date_create;
    public $date_update;
    public $isCheck;
    public $img;

    public static function tableName()
    {
        return self::_g(get_called_class());
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

    public function afterFind()
    {
        $this->img = strlen(trim($this->IMG)) > 0 ? "/images/" . $this->IMG : self::PHOTO_GUEST;

        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);

        $this->isCheck = !empty($this->CHECK) && is_numeric($this->CHECK) && $this->CHECK === 1;
    }

    /**
     * @param $model RecallForm
     * @return null|static
     */
    public static function SaveRecall($model){
        $recall = new RecallModel();
        $recall->NAME = $model->name;
        $recall->TEXT = $model->text;
        $recall->I_AGREE = $model->iAgree;
        // Новые отзывы должны пройти проверку администратора
        $recall->CHECK = 0;
        $recall->save();
        return RecallModel::findOne(['ID' => $recall->ID]);
    }

    public static function find(){
        return new RecallQuery(get_called_class());
    }
}

class RecallQuery extends ActiveQuery{
    /**
     * Только проверенные записи
     */
    public function isCheck(){
        return $this->andWhere(['CHECK' => RecallModel::CHECK]);
    }
}