<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'homeUrl' => '/adminpanel',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'modules' => [],
    'components' => [
        'request' => [
            'baseUrl' => '/adminpanel',
            'csrfParam' => '_csrf-backend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DHRm3IDFER123ERdfsdf-3CFB6-yyZExG',
        ],
        'user' => [
            'identityClass' => 'common\models\engine\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['authentication/login'],
        ],
        'urlManager' => [
            'enableStrictParsing' => false,
        ],
//        'urlManager' => [
//            'normalizer' => [
//                'class' => 'yii\web\UrlNormalizer'
//            ],
//            'rules' => [
//                // for work to js file
//                'role-search-user' => 'role/search-user',
//            ],
//        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
    ],
    'params' => $params,
];