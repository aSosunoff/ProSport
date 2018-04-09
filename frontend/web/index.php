<?php
//http://stuff.cebe.cc/yii2docs-ru/guide-structure-entry-scripts.html

/* НАСТРОЙКИ ДЛЯ .htaccess
 *
 * Перенаправляем всё в папку web от корня
 * http://wemarus.ru/yii-2/324-yii2-na-shared-xosting-nastrojka-htaccess.html
 * */

/* НАСТРОЙКА, УСТАНОВКА Node.js
 *
 * Перед установкой необходимо установить менеджер версий nvm
 * nodejs.org
 *
 * Управление несколькими версиями Node.js на одной машине
 * https://monsterlessons.com/project/lessons/ustanovka-node-js
 *
 * Менеджер версий для Windows
 * https://github.com/coreybutler/nvm-windows
 *
 * Установка и настройка YUI Compressor
 * Оптимизация CSS
 * http://rustorm.ru/phpstorm/rukovodstvo-phpstorm/jazyki-razmetki-i-stilei/optimizacija-css.html
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-db-migration#batchInsert()-detail
 * https://github.com/michael-vostrikov/yii2-migration-generator
 *
 * composer require "rmrevin/yii2-fontawesome:~2.17"
 * composer require "2amigos/yii2-transliterator-helper:*"
 * composer require kartik-v/yii2-mpdf "dev-master"
 * */

use yii\helpers\ArrayHelper;
// on/off don't work
// Если включаем на локали не забываем поменять YII_ENV в test || prod
defined('CATCH_ALL') or define('CATCH_ALL', false);

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
if(!CATCH_ALL){
    defined('YII_ENV') or define('YII_ENV', 'dev');

} else {
    defined('YII_ENV') or define('YII_ENV', 'test');
}

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();