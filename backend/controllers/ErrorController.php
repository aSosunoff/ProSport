<?php

namespace backend\controllers;

use common\models\engine\ExceptionLogModel;
use common\models\engine\ExceptionLogStatusModel;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ErrorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    if($action->id === 'error'){
                        Yii::$app->session->setFlash('warning', 'Вы не можете войти на данную страницу');
                        Yii::$app->user->loginRequired();
                    }
                    throw new ForbiddenHttpException("Доступ закрыт");
                },
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                        'roles' => ['adminpanel/error-page-view'],
                    ],
                    [
                        'actions' => [
                            'exception-table',
                            'set-status'
                        ],
                        'allow' => true,
                        'roles' => ['adminpanel/error-table-view'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'error' => ['get'],
                    'exception-table' => ['get'],
                    'set-status' => ['post']
                ],
            ],
        ];
    }

    public function actionError(){
        try{
            $exception = Yii::$app->errorHandler->exception;

            if ($exception !== null) {
                $statusCode = $exception->statusCode;
                $name = $exception->getName();
                $message = $exception->getMessage();
                return $this->render('error', [
                    'exception' => $exception,
                    'statusCode' => $statusCode,
                    'name' => $name,
                    'message' => $message
                ]);
            }
        } catch (Exception $ex){
            ExceptionLogModel::Run($ex);
            throw new NotFoundHttpException(ExceptionLogModel::DEFAULT_MESSAGE);
        }
    }

    public function actionExceptionTable($status = null){
        try{
            $exceptions = null;

            switch ($status){
                case ExceptionLogStatusModel::IS_NEW:
                    $exceptions = ExceptionLogModel::find()
                        ->where(['ID_EXCEPTION_LOG_STATUS' => ExceptionLogStatusModel::IS_NEW])
                        ->orderBy(['UPDATED_AT' => SORT_DESC])
                        ->asArray()
                        ->all();
                    break;
                case ExceptionLogStatusModel::IS_SUCCESS:
                    $exceptions = ExceptionLogModel::find()
                        ->where(['ID_EXCEPTION_LOG_STATUS' => ExceptionLogStatusModel::IS_SUCCESS])
                        ->orderBy(['UPDATED_AT' => SORT_DESC])
                        ->asArray()
                        ->all();
                    break;
                default:
                    $exceptions = ExceptionLogModel::find()
                        ->orderBy(['UPDATED_AT' => SORT_DESC])
                        ->asArray()
                        ->all();
                    break;
            }

            ExceptionLogModel::renderModel($exceptions);

            $statusList = ExceptionLogStatusModel::find()->asArray()->all();

            $resultStatus = [];
            array_map(function($e) use(&$resultStatus){
                $resultStatus = $resultStatus + [ $e['ID'] => $e['NAME'] ];
            }, $statusList);

            return $this->render('exception-table', [
                'exceptions' => $exceptions,
                'statusList' => $resultStatus
            ]);
        } catch (Exception $ex){
            ExceptionLogModel::Run($ex);
            throw new NotFoundHttpException(ExceptionLogModel::DEFAULT_MESSAGE);
        }
    }

    public function actionSetStatus(){
        try{
            Yii::$app->response->format = Response::FORMAT_JSON;

            $idStatus = Yii::$app->request->post('idStatus');
            $idRow = Yii::$app->request->post('idRow');

            /* @var $element ExceptionLogModel */
            $element = ExceptionLogModel::find()->where(['ID' => $idRow])->one();
            $element->ID_EXCEPTION_LOG_STATUS = $idStatus;
            $element->save();

            return [
                'success' => true,
                'result' => [
                    'statusColor' => ExceptionLogStatusModel::find()
                        ->where(['ID' => $idStatus])
                        ->asArray()
                        ->one()['COLOR']
                ],
            ];
        } catch (Exception $ex){
            ExceptionLogModel::Run($ex);
            return [
                'success' => false,
                'message' => [
                    'Error' => ExceptionLogModel::DEFAULT_MESSAGE
                ],
            ];
        }
    }

}