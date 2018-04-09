<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css;
    public $js = [
        'js/backend.js',
        'js/setting.js'
    ];
    public $depends = [
        'common\assets\CommonAsset',
        'yiister\gentelella\assets\Asset'
    ];

    public function __construct(array $config = [])
    {
        $this->css = YII_ENV_PROD ? ['css/all.min.css'] : [
            'css/backend.css',
        ];
        parent::__construct($config);
    }
}