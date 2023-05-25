<?php

namespace app\controllers;

use app\components\VideoStream;
use app\models\Order;
use Yii;
use yii\web\Controller;

class PlayerController extends Controller
{
    public function actionPlay($id = null)
    {
        $user = Yii::$app->user->identity;
        $ordered = Order::findOne(['wants_id' => '3ffb626c-07b2-4928-a5eb-4ee1e78c1f2c', 'user_id' => Yii::$app->user->identity->id, 'status' => Order::STATUS_APPROVED]);

        $lesson = \app\models\Lesson::findOne(['uuid' => $id]);

        if ($user->isRoleUser('pupil') && (!$ordered && $lesson->status != \app\models\Lesson::STATUS_DEMO)) {
            return null;
        }

        $videoPath = Yii::getAlias('@app') . '/files/lessons/' . $lesson->filename;
        $stream = new VideoStream($videoPath);
        $stream->start();
    }
}