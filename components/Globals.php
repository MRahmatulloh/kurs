<?php

namespace app\components;

class Globals
{
    public static function getStatuses()
    {
        return [
            0 => 'Faol emas',
            10 => 'Aktiv',
        ];
    }
    public static function getOrderStatuses()
    {
        return [
            1 => 'Yangi',
            2 => 'Tasdiqlangan',
            3 => 'Bekor qilingan',
        ];
    }

}