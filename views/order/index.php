<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Buyurtmalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uuid',
            [
                'attribute' => 'user_id',
                'value' => function (\app\models\Order $order) {
                    return $order->user->name;
                },
                'filter' => \app\models\User::selectList(),
                'filterInputOptions' => [
                    'prompt' => 'Hammasi'
                ]
            ],
            [
                'attribute' => 'wants',
                'value' => function (\app\models\Order $order) {
                    return \app\models\Order::WANTS[$order->wants] ?? null;
                },
                'filter' => \app\models\Order::WANTS,
                'filterInputOptions' => [
                    'prompt' => 'Hammasi'
                ]
            ],
            [
                'attribute' => 'wants_id',
                'format' => 'raw',
                'value' => function (\app\models\Order $order) {

                    if ($order->wants == 'book')
                        return Html::a(($order->getWantedObject())->name ?? null, ['book/view-detail', 'id' => $order->wants_id]);

                    elseif ($order->wants == 'course')
                        return Html::a(($order->getWantedObject())->name ?? null, ['module/index']);

                    return ($order->getWantedObject())->name ?? null;
                },
                'filter' => ''
            ],
            [
                'attribute' => 'status',
                'value' => function (\app\models\Order $order) {
                    return \app\components\Globals::getOrderStatuses()[$order->status];
                },
                'filter' => \app\components\Globals::getOrderStatuses(),
                'filterInputOptions' => [
                    'prompt' => 'Hammasi'
                ]
            ],
            [
                'attribute' => 'created_at',
                'value' => function (\app\models\Order $order) {
                    return Yii::$app->formatter->asDatetime($order->created_at, 'php:d.m.Y H:i:s');
                },
                'filter' => ''
            ],
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Order $order) {
                    return Yii::$app->formatter->asDatetime($order->updated_at, 'php:d.m.Y H:i:s');
                },
                'filter' => ''
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
