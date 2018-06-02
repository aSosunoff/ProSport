<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

use common\infrastructure\DateClass;

class RecallForm extends Model
{
    public $name;
    public $text;
    public $iAgree = false;
    public $date;

    public function __construct($config = [])
    {
        $this->date = DateClass::TimestampToDate();
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'text' => 'Ваше сообщение',
            'iAgree' => 'Согласен на обработку персональных данных'
        ];
    }

    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'default', 'value' => 'Гость'],
            ['name', 'common\infrastructure\CheckOnSpam', 'message' => 'Имя содержит запрещённые символы, слова'],
            ['name', 'string', 'max' => 255, 'message' => 'Слишком длинное сообщение'],

            ['text', 'trim'],
            ['text', 'required', 'message' => 'Необходимо ввести текст'],
            ['text', 'common\infrastructure\CheckOnSpam', 'message' => 'Текст содержит запрещённые символы, слова'],
            ['text', 'string', 'max' => 255, 'message' => 'Слишком длинное сообщение'],

            ['date', 'required', 'message' => 'Необходимо заполнить поле даты'],

            ['iAgree', 'compare', 'compareValue' => true, 'message' => 'Необходимо Ваше согласие на обработку персональных данных'],
        ];
    }

    public function sendMail(){
        if (!$this->validate())
            return false;

        return Yii::$app->mailer->compose(['html' => 'recall'], [
            'nameForm' => 'Новый отзыв',
            'recallForm' => $this
        ])
            ->setTo(Yii::$app->params['adminEmail'])
            //->setFrom([$this->email => $this->name])
            ->setSubject("Новый отзыв")
            ->send();

    }
}