<?php
namespace backend\controllers;

use Exception;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use common\models\form\LoginForm;
use common\models\engine\ExceptionLogModel;

class AuthenticationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post', 'get'],
                    'logout' => ['post'],
                ],
            ]
        ];
    }

    public function actionLogin()
    {
        try{
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                $this->layout = 'login';
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } catch (Exception $ex){
            ExceptionLogModel::Run($ex);
            throw new NotFoundHttpException(ExceptionLogModel::DEFAULT_MESSAGE);
        }
    }

    public function actionLogout()
    {
        try{
            Yii::$app->user->logout();

            return $this->goHome();
        } catch (Exception $ex){
            ExceptionLogModel::Run($ex);
            throw new NotFoundHttpException(ExceptionLogModel::DEFAULT_MESSAGE);
        }
    }
}