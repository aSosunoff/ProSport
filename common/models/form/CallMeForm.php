<?php

namespace common\models\form;

use Yii;
use yii\base\Model;

use common\infrastructure\DateClass;


class CallMeForm extends Model
{
    public $name;
    public $phone;
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
            'phone' => 'Ваш телефон',
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
            ['text', 'common\infrastructure\CheckOnSpam', 'message' => 'Текст содержит запрещённые символы, слова'],
            ['text', 'string', 'max' => 255, 'message' => 'Слишком длинное сообщение'],

            ['phone', 'match', 'pattern' => '/^\+\d\s*\(\d{3}\)\s*\d{3}\s*\-\s*\d{2}\s*\-\s*\d{2}$/', 'message' => 'Некорректный номер телефона'],
            ['phone', 'required', 'message' => 'Необходимо заполнить поле номера'],

            ['iAgree', 'compare', 'compareValue' => true, 'message' => 'Необходимо Ваше согласие на обработку персональных данных'],

            ['date', 'required', 'message' => 'Необходимо заполнить поле даты']
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function sendEmail(){
        if (!$this->validate())
            return false;

        return Yii::$app->mailer->compose(
            ['html' => 'call-me'], [
            'nameForm' => 'Перезвоните мне',
            'CallMeForm' => $this
        ])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject("Перезвоните мне")
            ->send();
    }
}