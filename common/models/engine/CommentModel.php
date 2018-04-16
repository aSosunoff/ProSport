<?php

namespace common\models\engine;

use common\models\form\CommentForm;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use common\infrastructure\DateClass;

/**
 * Comment model
 *
 * @property integer $ID
 * @property string $IMG
 * @property string $NAME_COMMENTATOR
 * @property string $TEXT
 * @property boolean $CHECK
 * @property boolean $I_AGREE
 * @property integer $CREATED_AT
 * @property integer $UPDATED_AT
 */
class CommentModel extends MainModel
{
    const CHECK_ACTIVE = 1;

    public $img;
    public $isIAgree;
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
        $this->img = strlen(trim($this->IMG)) > 0 ? "/images/" . $this->IMG : self::PHOTO_GUEST;

        $this->date_create = DateClass::TimestampToDate($this->CREATED_AT);
        $this->date_update = DateClass::TimestampToDate($this->UPDATED_AT);

        $this->isIAgree = $this->I_AGREE == 0 ? false : true ;
    }

    /**
     * @param $model CommentForm
     * @return null|static
     */
    public static function SaveMessage($model){
        $comment = new CommentModel();
        $comment->NAME_COMMENTATOR = $model->name;
        $comment->TEXT = $model->text;
        $comment->I_AGREE = $model->iAgree;
        // Новые комментарии должны пройти проверку администратора
        $comment->CHECK = 0;
        $comment->save();
        return CommentModel::findOne(['ID' => $comment->ID]);
    }
}