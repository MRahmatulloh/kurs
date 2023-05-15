<?php

namespace app\components;

use yii\helpers\ArrayHelper;

trait SelectListTrait
{
    public static function selectList()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'name');
    }
}