<?php

namespace common\assets;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{
    public $sourcePath = '@common/web';
    public $css;
    public $js;
    public $depends;

    public function __construct(array $config = [])
    {
        $this->css = YII_ENV_PROD ? ['/common/css/all.min.css'] : [
            '/common/css/fonts.css',
            '/common/css/common.css',

            '/common/css/fonts/custom-icon/custom-icon/style.css',
            '/common/css/fonts/custom-icon/web-cook/style.css',

            '/common/css/components/box-switch.css',

            '/common/css/BEM/b-scroll-up.css',
            '/common/css/BEM/b-menu.css',
            '/common/css/BEM/b-component.css',

            '/common/css/Redefinition-Bootstrap/Modal-Window.css',
            '/common/css/Redefinition-Bootstrap/navbar.css',
            '/common/css/Redefinition-Bootstrap/alert.css',
            '/common/css/Redefinition-Bootstrap/form.css',
            '/common/css/Redefinition-Bootstrap/input-group.css',
            '/common/css/Redefinition-Bootstrap/well.css',
            '/common/css/Redefinition-Bootstrap/custom.css',
        ];
        //YII_ENV_PROD ? ['dist/all.min.css'] : [
//        'css/fonts.css',
//        'fonts/custom-font-icon/web-cook/style.css',
//        'fonts/custom-font-icon/banya/style.css',
//        'fonts/custom-font-icon/banya-icon/style.css',
//        'css/BEM/b-panel.css',
//        'css/BEM/b-item-select.css',
//        'css/BEM/b-component.css',
//        'css/style-common.css'
        //];

        $this->js = YII_ENV_PROD ? [

            '/common/js/conflict/tooltipconflictStart.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js',
            '/common/js/conflict/tooltipconflictEnd.js',

            '/common/js/all.min.js'

        ] : [

            '/common/js/conflict/tooltipconflictStart.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js',
            '/common/js/conflict/tooltipconflictEnd.js',

            '/common/js/component/AJAXGlobal.js',
            '/common/js/component/Message.js',
            '/common/js/component/Animate_Load.js',
        ];

        $this->depends = YII_ENV_PROD ? [
            'common\assets\YiiMinAsset',
            'common\assets\ResetCssAsset',
            'common\assets\BootstrapMinAsset',
            'rmrevin\yii\fontawesome\AssetBundle',
            'common\assets\MaskedInputMinAsset'
        ] : [
            'yii\web\YiiAsset',
            'common\assets\ResetCssAsset',
            'yii\bootstrap\BootstrapPluginAsset',
            'yii\bootstrap\BootstrapAsset',
            'yii\bootstrap\BootstrapThemeAsset',
            //https://github.com/rmrevin/yii2-fontawesome
            'rmrevin\yii\fontawesome\AssetBundle',
            'yii\widgets\MaskedInputAsset'
        ];

        parent::__construct($config);
    }
}