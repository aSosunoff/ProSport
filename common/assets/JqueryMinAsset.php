<?php

namespace common\assets;

use yii\web\AssetBundle;

class JqueryMinAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery/dist';
    public $js = [
        'jquery.min.js',
    ];
}