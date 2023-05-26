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

    public static function errorMessageText($message)
    {
        $text = '<br>';

        if (is_array($message)) {
            foreach ($message as $value) {
                if (is_array($value)) {
                    foreach ($value as $msg) {
                        $text .= $msg . '<br>';
                    }
                } else {
                    $text .= $value . '<br>';
                }
            }

        } else {
            $text = $message;
        }
        return $text;
    }

}