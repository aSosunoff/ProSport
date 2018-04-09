<?php

namespace common\infrastructure;

use Yii;
use yii\helpers\Inflector;
// https://habrahabr.ru/post/208328/
// https://github.com/2amigos/yii2-transliterator-helper
use dosamigos\transliterator\TransliteratorHelper;

class GetGenerationUrl
{
    /**
     * Метод, который получает 2 параметра
     * $url($u) - аргумент который за ранее не известен
     * $title($t) - если $url($t) пришёл пустым то генерируем url из этого аргумента
     */
    public static function Run($u, $t){
        if(strlen(trim($u)) > 0){
            // Если предусмотрен URL берём из него значение в url
            return Inflector::slug(TransliteratorHelper::process($u));
        } else {
            // Если не предусмотрен URL конфигурируем программно из поля TITLE
            return Inflector::slug(TransliteratorHelper::process($t));
        }
    }

    public static function Generate($text){
        return Inflector::slug(TransliteratorHelper::process($text));
    }
}