<?php

namespace common\assets;

use yii\web\AssetBundle;

class MaskedInputMinAsset extends AssetBundle
{
    public $sourcePath = '@bower/inputmask/dist';
    public $js = [
        'min/jquery.inputmask.bundle.min.js',
    ];
    public $depends = [
        'common\assets\YiiMinAsset',
    ];
}   