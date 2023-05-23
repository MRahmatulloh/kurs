<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Buyurtma № ' . $model->uuid . ' / ' . $model->user->name . ' / ' . Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
$this->params['breadcrumbs'][] = ['label' => 'Buyurtmalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->uuid;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <p class="text-end">
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uuid',
            [
                'attribute' => 'user_id',
                'value' => function (\app\models\Order $order) {
                    return $order->user->name;
                }
            ],
            [
                'attribute' => 'wants',
                'value' => function (\app\models\Order $order) {
                    return \app\models\Order::WANTS[$order->wants] ?? null;
                }
            ],
            'wants_id',
            [
                'attribute' => 'status',
                'value' => function (\app\models\Order $order) {
                    return \app\components\Globals::getOrderStatuses()[$order->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (\app\models\Order $order) {
                    return Yii::$app->formatter->asDatetime($order->created_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Order $order) {
                    return Yii::$app->formatter->asDatetime($order->updated_at, 'php:d.m.Y H:i:s');
                }
            ],
        ],
    ]) ?>

</div>
