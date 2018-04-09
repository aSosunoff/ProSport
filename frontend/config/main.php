<?php
/*
 * http://stuff.cebe.cc/yii2docs-ru/guide-structure-applications.html#application-configurations
 * http://lavrik-v.ru/info/260/YII_2_ADVANCED_htaccess_primer_pravilnoj_nastrojki.html
 *
 *  Как использовать UrlManager для настройки роутинга и создания «дружелюбных» URL
 * https://habrahabr.ru/post/308948/
 *
 * Роутинг в Yii 2.x - UrlManager (Часть 1)
 * http://www.webapplex.ru/routing-v-yii-2.x-urlmanager
 */
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$config = [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'common\infrastructure\CustomRules'
    ],
    'language' => 'ru',
    'homeUrl' => '/',
    // Включить всё перенаправление на одну страницу в случае ремонта сайта
    'catchAll' => CATCH_ALL ? ['error/offline'] : null,
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xhLvd@!XQ4N1231sdf12312dfwqwlBoKewq2Ia5g',
        ],
        'urlManager' => [
            'enableStrictParsing' => YII_ENV_PROD,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer'
            ],
            'rules' => [
                //'sitemap.xml' => 'sitemap/index',
                // for work to js file
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\engine\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['authentication/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
//        'assetManager' => [
//            'appendTimestamp' => YII_ENV_PROD ? true : false,
//            'bundles' => [
//                'yii\bootstrap\BootstrapAsset' => [
//                    'sourcePath' => null,
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web',
//                    'css' => [
//                        YII_ENV_DEV ? 'css/src/bootstrap/css/bootstrap.css' : 'css/src/bootstrap/css/bootstrap.min.css',
//                        YII_ENV_DEV ? 'css/src/bootstrap/css/bootstrap-theme.css' : 'css/src/bootstrap/css/bootstrap-theme.min.css'
//                    ],
//                ],
//                'yii\bootstrap\BootstrapPluginAsset' => [
//                    'sourcePath' => null,
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web',
//                    'js' => [
//                        YII_ENV_DEV ? 'css/src/bootstrap/js/bootstrap.js' : 'css/src/bootstrap/js/bootstrap.min.js'
//                    ]
//                ],
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web',
//                    'js' => [
//                        YII_ENV_PROD ? '/dist/jquery-3.2.1.min.js' : '/js/jquery/jquery-3.2.1.js'
//                    ]
//                ]
//            ],
//        ],

    ],
    'params' => $params,
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;