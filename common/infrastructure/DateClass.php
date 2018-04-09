<?php

namespace common\infrastructure;

use DateTime;

class DateClass
{
    public static function TimestampToDate($timestamp = null){
        // http://php.net/manual/ru/function.date.php
        // http://php.net/manual/ru/datetime.format.php

        $timestamp = empty($timestamp) ? time() : $timestamp;

        $monthes = [
            1 => "Января", 2 => "Февраля", 3 => "Марта",
            4 => "Апреля", 5 => "Мая", 6 => "Июня",
            7 => "Июля", 8 => "Августа", 9 => "Сентября",
            10 => "Октября", 11 => "Ноября", 12 => "Декабря"
        ];

        $date = new DateTime();

        $date->setTimestamp($timestamp);

        $m = $monthes[date('n', $timestamp)];

        if(date('Y', $timestamp) < date('Y')){
            return $date->format('d ' . $m . ' Y года в H:i');
        }else{
            return $date->format('d ' . $m . ' в H:i');
        }
    }
}