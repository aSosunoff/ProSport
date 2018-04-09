<?php
namespace common\models\engine;

use common\models\form\PrivacyPolicyForm;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use common\infrastructure\DateClass;

/**
 * PrivacyPolicy model
 *
 * @property integer $ID
 * @property string $NAME
 * @property string $TEXT
 * @property boolean $CHECK
 * @property boolean $I_AGREE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class PrivacyPolicyModel extends MainModel
{
    public $date_create;
    public $date_update;

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
        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);
    }

    /**
     * @param $model PrivacyPolicyForm
     * @return $this
     */
    public static function SavePrivacyPolicy($model){
        $privacy = new PrivacyPolicyModel();
        $privacy->NAME = $model->name;
        $privacy->TEXT = $model->text;
        $privacy->I_AGREE = $model->iAgree;
        $privacy->CHECK = 0;
        $privacy->save();

        return PrivacyPolicyModel::findOne(['ID' => $privacy->ID]);
    }
}