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
        $ordered = Order::findOne(['wants_id' => '6d81cd8c-b0c1-4122-95bb-ce1a30f2644d', 'user_id' => Yii::$app->user->identity->id, 'status' => Order::STATUS_APPROVED]);

        if ($user->isRoleUser('pupil') && !$ordered) {
            return null;
        }

        $lesson = \app\models\Lesson::findOne(['uuid' => $id]);
        $videoPath = Yii::getAlias('@app') . '/files/lessons/' . $lesson->filename;
        $stream = new VideoStream($videoPath);
        $stream->start();
    }
}