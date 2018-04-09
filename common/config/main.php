<?php
use kartik\mpdf\Pdf;
use common\components\AuthManagerWrap;

// локальное подключение
$home = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=prosport_fm',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix' => 'fm_'
];

// подключение на продуктивном сервере
$prod = [
//    'class' => 'yii\db\Connection',
//    'dsn' => 'mysql:host=localhost;dbname=h93874_murom_banya_ig',
//    'username' => 'h93874_muBaUser',
//    'password' => '0H7r6X7p',
//    'charset' => 'utf8',
//    'tablePrefix' => 'igi_'
];

define('PHONE_1', '+7 (999) 999-99-99');
define('PHONE_2', '+7 (99999) 9-99-99');
define('E_MAIL', 'm.xxxx@yandex.ru');

return [
    'name' => 'ProSport',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => YII_ENV_PROD ? $prod : $home,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => YII_ENV_DEV,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'assetManager' => [
            'appendTimestamp' => YII_ENV_PROD ? true : false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'authManagerWrap' => [
            'class' => AuthManagerWrap::className()
        ],
        'cart' => [
            'class' => 'common\components\Cart'
        ],
        'pdf' => [
            // http://demos.krajee.com/mpdf#methods
            // https://github.com/kartik-v/yii2-mpdf
            'class' => Pdf::classname(),
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            //'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            //'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssFile' => '@common/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            //'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Интернет магазин "ProSport"'],
                'SetFooter'=>['{PAGENO}'],
            ]
            // refer settings section for all configuration options
        ]
    ],
];