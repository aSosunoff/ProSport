<?php

namespace common\assets;

use yii\web\AssetBundle;

class BootstrapMinAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap-theme.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
    ];
    public $depends = [
        'common\assets\JqueryMinAsset',
    ];
}