<?php

namespace services;

use app\models\Order;
use Yii;

class CheckAccessService
{
    public static function checkAccess($resourse_id, $user_id)
    {
        $order = \app\models\Order::findOne(['wants_id' => $resourse_id, 'user_id' => $user_id, 'status' => Order::STATUS_APPROVED]);

        if ($order) {
            return true;
        }

        return false;
    }

}