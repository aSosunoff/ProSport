<?php
namespace frontend\controllers;

use common\models\engine\CallMeModel;
use common\models\engine\ExceptionLogModel;
use common\models\engine\MenuModel;
use common\models\engine\SectionModel;
use common\models\form\CallMeForm;
use Exception;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $menu = MenuModel::find()
            ->isActive()
            ->orderBy('ID')
            ->all();

        $array = [];
        /* @var MenuModel $item */
        foreach($menu as $item) {
            /* @var SectionModel $section*/
            foreach($item->sections as $section) {
                $url = Yii::$app->urlManager->createUrl(["section/{$section->VIEW}"]);
                $elementId = $section->VIEW;
                $array[] = "{\"data\":{\"id\":$section->ID},\"url\":\"$url\",\"elementId\":\"#$elementId\"}";
            }
        }

        $sectionJson = "'[" . implode(',', $array) . "]'";

        return $this->render('index', [
            'menu' => $menu,
            'sectionJson' => $sectionJson
        ]);
    }

    /**
     * Send message call me
     */
    public function actionCallMe(){
        //https://blog.tormix.com/development/yii-2-response-formats-raw-html-json-jsonp-xml/

        Yii::$app->response->format = Response::FORMAT_JSON;

        try {

            $model = new CallMeForm();

            if($model->load(Yii::$app->request->post()) && $model->validate()){
                $transaction = CallMeModel::getDb()->beginTransaction();

                CallMeModel::SaveCallMe($model);

                if($model->sendEmail()){
                    $transaction->commit();

                    return [
                        'success' => true,
                        'result' => [
                            'isSend' => true,
                        ],
                        'message' => [
                            'Success' => 'Спасибо. Мы вам перезвоним'
                        ]
                    ];
                } else {
                    $transaction->rollBack();
                    throw new NotFoundHttpException("Произошла ошибка отправки сообщения на форме \"Позвони мне\".");
                };

            } else {
                $resultError = 'Произошла ошибка.<br>';
                foreach ($model->errors as $error){
                    foreach ($error as $errorIn){
                        $resultError .= $errorIn . '<br>';
                    }
                }

                ExceptionLogModel::Run(new Exception($resultError));

                return [
                    'success' => true,
                    'result' => [
                        'html' => $this->renderAjax('call-me-partial', [
                            'model' => $model,
                        ])
                    ],
                    'message' => [
                        'Error' => $resultError
                    ]
                ];
            }

        } catch (NotFoundHttpException $ex) {
            return [
                'success' => false,
                'message' => [
                    'Error' => $ex->getMessage()
                ]
            ];
        } catch(Exception $ex) {
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
