<?php
namespace common\models\engine;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class MainModel extends ActiveRecord
{
    const PHOTO_NOT_FOUND = '/images/photo-not-found.png';

    const PHOTO_GUEST = "/images/guest.png";
    const IS_ACTIVE = 1;

    public static function _g($path){
        // последнее вхождение косой линии
        $pos = strripos($path, "\\");

        // если найдено то отрезаем от неё до конца
        if($pos)
            $path = substr($path, $pos + 1);

        // удаляем слово Model
        $path = preg_replace('/Model/', '', $path);

        // разбиваем на массив по заглавной букве
        $path = preg_split('/(?<=[a-z])(?=[A-Z])/u',$path);

        // формируем имя
        //return Yii::$app->components['db']['tablePrefix'] . strtoupper(implode("_", $path));
        return '{{%' . strtolower(implode("_", $path)) . '}}';
    }
}