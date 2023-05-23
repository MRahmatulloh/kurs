<?php

namespace services;

use app\models\Order;
use Yii;

class CheckAccessService
{
    public $user;

    public function __construct()
    {
        $this->user = Yii::$app->user->identity;
    }

    public function checkAccess($resourse_id)
    {
        $order = \app\models\Order::findOne(['wants_id' => $resourse_id, 'user_id' => $this->user->id, 'status' => Order::STATUS_APPROVED]);

        if ($order) {
            return true;
        }

        return false;
    }

}