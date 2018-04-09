<?php
namespace frontend\widget;

use Yii;
use yii\base\Widget;

use common\models\engine\MenuModel;

class MenuWidget extends Widget
{
    public function run(){
        $itemMenu = MenuModel::find()
            ->isActive()
            ->orderBy('ID')
            ->all();

        return $this->render('menuWidget',[
            'itemMenu' => $itemMenu,
            'phone' => PHONE_1,
            'email' => E_MAIL
        ]);
    }
}