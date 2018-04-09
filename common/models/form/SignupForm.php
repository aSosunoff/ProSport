<?php
namespace common\models\form;

use Yii;
use yii\base\Model;
use common\models\engine\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $USERNAME;
    public $EMAIL;
    public $NAME;
    public $SURNAME;
    public $PASSWORD;
    public $I_AGREE = false;

    public function attributeLabels()
    {
        return [
            'USERNAME' => 'Логин',
            'NAME' => 'Имя',
            'SURNAME' => 'Фамилия',
            'EMAIL' => 'Email',
            'PASSWORD' => 'Пароль',
            'I_AGREE' => 'Согласен на обработку персональных данных'
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['USERNAME', 'trim'],
            ['USERNAME', 'required'],
            ['USERNAME', 'unique', 'targetClass' => '\common\models\engine\User', 'message' => 'Данный логин уже используется'],
            ['USERNAME', 'string', 'min' => 2, 'max' => 255],

            ['NAME', 'trim'],
            ['NAME', 'string', 'max' => 255],

            ['SURNAME', 'trim'],
            ['SURNAME', 'string', 'max' => 255],

            ['EMAIL', 'trim'],
            ['EMAIL', 'required'],
            ['EMAIL', 'email'],
            ['EMAIL', 'string', 'max' => 255],
            ['EMAIL', 'unique', 'targetClass' => '\common\models\engine\User', 'message' => 'Данная электронная почта уже используется'],

            ['PASSWORD', 'required'],
            ['PASSWORD', 'string', 'min' => 6],

            ['I_AGREE', 'compare', 'compareValue' => true, 'message' => 'Необходимо Ваше согласие на обработку персональных данных'],

            [['USERNAME', 'NAME', 'SURNAME', 'PASSWORD'], 'frontend\infrastructure\CheckOnSpam', 'message' => 'Поле содержит запрещённые символы, слова'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->USERNAME = $this->USERNAME;
        $user->EMAIL = $this->EMAIL;
        $user->NAME = $this->NAME;
        $user->SURNAME = $this->SURNAME;
        $user->I_AGREE = $this->I_AGREE;
        //$user->GROUP = User::ROLE_USER;
        $user->setPassword($this->PASSWORD);
        $user->generateAuthKey();

        if($user->save()){
            /**
             *  @var \common\components\AuthManagerWrap $authManagerWrap The auth manager application component extension.
             */
            $authManagerWrap = Yii::$app->authManagerWrap;
            $authManagerWrap->assignValid('user', $user->getId());
            return $user;
        }

        return null;
    }
}
