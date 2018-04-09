<?php

namespace common\assets;

use yii\web\AssetBundle;

class YiiMinAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];
    public $depends = [
        'common\assets\JqueryMinAsset',
    ];
}