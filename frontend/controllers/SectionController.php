<?php
namespace frontend\controllers;

use common\models\engine\ExceptionLogModel;
use common\models\engine\ProductModel;
use common\models\engine\RecallModel;
use common\models\engine\SectionModel;
use common\models\form\CallMeForm;
use Exception;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SectionController  extends Controller
{
    private function _getSection($content){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => $content
                    ]),
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

    public function actionTop_1(){
        return $this->_getSection([]);
    }

    public function actionAbout_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu
                        ]
                    ]),
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

    public function actionAbout_2(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu
                        ]
                    ]),
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

    public function actionAbout_3(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu
                        ]
                    ]),
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

    public function actionProduct_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu,
                            'products' => ProductModel::find()
                                ->isActive()
                                ->all()
                        ]
                    ]),
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

    public function actionPayment_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu
                        ]
                    ]),
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

    public function actionOrder_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu
                        ]
                    ]),
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

    public function actionReview_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            $recall = RecallModel::find()
                ->isCheck()
                ->all();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu,
                            'recall' => $recall
                        ]
                    ]),
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

    public function actionContact_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu,
                            'model' => new CallMeForm()
                        ]
                    ]),
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

    public function actionAddress_1(){
        try {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $sectionDTO = new SectionDTO(Yii::$app->request->post('id'));

            /* @var SectionModel $section */
            $section = SectionModel::find()
                ->isActive()
                ->andWhere(['ID' => $sectionDTO->id])
                ->one();

            return [
                'success' => true,
                'result' => [
                    'html' => $this->renderAjax('root', [
                        'section' => $section,
                        'content' => [
                            'menu' => $section->menu
                        ]
                    ]),
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

class SectionDTO{
    public $id;
    //public $url;
    //public $id_menu;
    //public $is_active;

    public function __construct($id)
    {
        $this->id = $this->_getId($id);
    }

    private function _getId($id){
        if(preg_match('/^\d+$/', $id)){
            return $id;
        }
    }
}