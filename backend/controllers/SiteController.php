<?php
namespace backend\controllers;

use common\models\engine\ExceptionLogModel;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['adminpanel/main-page-view'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get']
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        try
        {
            return $this->render('index');
        }
        catch (Exception $ex){
            ExceptionLogModel::Run($ex);
            throw new NotFoundHttpException(ExceptionLogModel::DEFAULT_MESSAGE);
        }
    }
}