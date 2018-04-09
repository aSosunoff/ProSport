<?php
namespace common\models\engine;

use Yii;
use yii\db\ActiveRecord;
use common\infrastructure\DateClass;
use yii\behaviors\TimestampBehavior;

/**
 * ExceptionLog model
 *
 * @property integer $ID
 * @property integer $ID_EXCEPTION_LOG_STATUS
 * @property string $MESSAGE
 * @property integer $CODE
 * @property string $FILE
 * @property integer $LINE
 * @property string $TRACE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 *
 * @property ExceptionLogStatusModel $status
 */
class ExceptionLogModel extends MainModel
{
    const DEFAULT_MESSAGE = "Произошла ошибка. Администратор получит уведомление и приступит к её устранению";
    const UNHANDLED_ERRORS = "Не обработанные ошибки";

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

    public function getStatus(){
        return $this->hasOne(ExceptionLogStatusModel::className(), ['ID' => 'ID_EXCEPTION_LOG_STATUS']);
    }

    public static function renderModel(&$elements){
        foreach ($elements as &$element){
            $element['date_create'] = DateClass::TimestampToDate($element['CREATED_AT']);
            $element['date_update'] = DateClass::TimestampToDate($element['UPDATED_AT']);

            $status = ExceptionLogStatusModel::find()
                ->where(['ID' => $element['ID_EXCEPTION_LOG_STATUS']])
                ->asArray()
                ->all();

            ExceptionLogStatusModel::renderModel($status);

            $element['status'] = $status[0];
        }
    }

    public static function Run($ex){
        $exception = new ExceptionLogModel();
        $exception->ID_EXCEPTION_LOG_STATUS = 1; // Новое исключение
        $exception->MESSAGE = $ex->getMessage();
        $exception->CODE = $ex->getCode();
        $exception->FILE = $ex->getFile();
        $exception->LINE = $ex->getLine();
        $exception->TRACE = json_encode($ex->getTrace(), JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_PRETTY_PRINT);

        $exception->save();

        Yii::$app->mailer->compose(
            [
                'html' => 'exception'
            ], [
            'nameForm' => 'Произошла ошибка. Обратитесь к разработчику',
            'ExceptionLogModel' => $exception
        ])
            ->setTo(Yii::$app->params['adminEmail'])
            //->setFrom([$this->email => $this->name])
            ->setSubject("Произошла ошибка.")
            ->send();
    }
}