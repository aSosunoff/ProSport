<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.02.2018
 * Time: 22:55
 */

namespace console\controllers;


use common\models\engine\User;
use yii\console\Controller;

class CommonController extends Controller
{
    private $_error;

    private function _setStdout(){
        if(count($this->_error) > 0){
            $this->stdout(implode("\n", $this->_error));
        }
    }

    public function actionAddUser(){
        $model = User::find()->where(['USERNAME' => 'test'])->one();
        if(empty($model)){
            $user = new User();
            $user->USERNAME = 'test';
            $user->EMAIL = 'test@gmail.com';
            $user->NAME = 'test';
            $user->SURNAME = 'test';
            $user->I_AGREE = 1;
            $user->GROUP = User::ROLE_USER;
            $user->setPassword(123456);
            $user->generateAuthKey();
            $user->save();

            $this->_error[] = "User \"$user->USERNAME\" is added";
        } else {
            $this->_error[] = "User \"$model->USERNAME\" is exists";
        }
        $this->_setStdout();
    }
}