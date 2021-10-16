<?php

namespace App\Components\Helpers;

class DateHelper
{
    public const SQL_DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    public const SQL_DATE_FORMAT = 'Y-m-d';

    public static function strToTime(string $dateTime): int
    {
        return strtotime($dateTime);
    }
    
    public static function modifyDate(string $date, $modifier = '+1 minutes'): int
    {
        return strtotime($modifier, strtotime($date));
    }
    
    public static function toFormat(string $date, string $format = self::SQL_DATE_TIME_FORMAT): string
    {
        return date(strtotime($date), $format);
    }
    
    public static function now(): string
    {
        return date(self::SQL_DATE_TIME_FORMAT);
    }
}