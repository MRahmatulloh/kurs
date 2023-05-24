<?php

namespace app\components;

use yii\helpers\ArrayHelper;

trait SelectListTrait
{
    public static function selectList($condition = null)
    {
        return ArrayHelper::map(self::find()->where($condition)->asArray()->all(), 'id', 'name');
    }
}