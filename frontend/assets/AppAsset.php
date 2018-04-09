<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css;
    public $js;
    public $depends = [
        'common\assets\CommonAsset'
    ];

    public function __construct(array $config = [])
    {
        $this->css = YII_ENV_PROD ? ['css/all.min.css'] : [
            // AppAsset

            'library/owlcarousel/assets/owl.carousel.css',
            'library/owlcarousel/assets/owl.theme.default.css',
            'library/fancybox/dist/jquery.fancybox.css',

            'css/frontend.css',
            'css/footer-bottom.css'
        ];

        $this->js = YII_ENV_PROD ? ['js/all.min.js'] : [
            'library/owlcarousel/owl.carousel.js',
            'library/elevatezoom/jquery.elevatezoom.js',
            'library/fancybox/dist/jquery.fancybox.js',


            'js/frontend.js',
            'js/setting.js',
            'js/scroll-up.js'
        ];


        parent::__construct($config);
    }
}