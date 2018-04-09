<?php

namespace common\infrastructure;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;

class CustomRules implements BootstrapInterface
{
    /**
     * TODO: Используется в 2 местах. Навёрнута логика отображения ссылки. Ссылка не показывается если display false и наоборот.
     * */
    public static function LinksNotDB(){
        return [
            /*
                'urlName' => 'controllerName/actionName'
            */

            /*
                'urlName' => [
                    'url' => 'controllerName/actionName',
                    'display' => [true|false]
                ]
            */
        ];
    }


    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // Праивла которые нельзя вычислить
        $otherRules = self::LinksNotDB();

        $otherRules = array_map(function($e){
            if(is_array($e) && array_key_exists('url', $e)){
                return $e['url'];
            } else {
                return $e;
            }
        }, $otherRules);

        $commonRules = array_merge(
            $otherRules
        );

        $app->getUrlManager()
            ->addRules(
                YII_ENV_DEV ? [] : $commonRules,
                false);
    }
}