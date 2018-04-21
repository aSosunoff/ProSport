<?php
namespace common\models\engine;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use common\infrastructure\DateClass;
use common\models\form\CallMeForm;

/**
 * CallMe model
 *
 * @property integer $ID
 * @property string $NAME
 * @property string $TEXT
 * @property string $PHONE
 * @property boolean $CHECK
 * @property boolean $I_AGREE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class CallMeModel extends MainModel
{
    public $date_create;
    public $date_update;
    public $isCheck;
    public $isIAgree;

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
        $this->isCheck = $this->CHECK == 0 ? false : true ;
        $this->isIAgree = $this->I_AGREE == 0 ? false : true ;
    }

    public static function renderModel(&$elements){
        foreach ($elements as &$element){
            $element['date_create'] = DateClass::TimestampToDate($element['CREATED_AT']);
            $element['date_update'] = DateClass::TimestampToDate($element['UPDATED_AT']);
            $element['isCheck'] = $element['CHECK'] == 0 ? false : true;
            $element['isIAgree'] = $element['I_AGREE'] == 0 ? false : true;
        }
    }

    /**
     * @param $model CallMeForm
     * @return null|static
     */
    public static function SaveCallMe($model){
        $call = new CallMeModel();
        $call->NAME = $model->name;
        $call->TEXT = $model->text;
        $call->PHONE = $model->phone;
        $call->I_AGREE = $model->iAgree;
        // Новые позвони в статусе "не проверено"
        $call->CHECK = 0;
        $call->save();

        return CallMeModel::findOne(['ID' => $call->ID]);
    }
}