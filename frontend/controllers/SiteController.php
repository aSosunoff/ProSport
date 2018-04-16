<?php
namespace frontend\controllers;

use common\models\engine\MenuModel;
use common\models\engine\SectionModel;
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
}
