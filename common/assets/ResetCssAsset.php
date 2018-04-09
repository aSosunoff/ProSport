<?php

namespace common\assets;

use yii\web\AssetBundle;

class ResetCssAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'common/css/reset.css',
    ];

    public $js = [];

    public $depends = [];
}