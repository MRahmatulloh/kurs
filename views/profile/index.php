<?php

use app\models\Module;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\ModuleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$this->params['count'] = count($dataProvider->getModels());
?>
<div class="module-index">

    <p class="text-right">
        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email',
            'phone',
            [
                'attribute' => 'last_login_at',
                'value' => function (User $model) {
                    return Yii::$app->formatter->asDatetime($model->last_login_at, 'php:d.m.Y H:i:s');
                },
            ],
//            [
//                'attribute' => 'created_at',
//                'value' => function (\app\models\User $order) {
//                    return Yii::$app->formatter->asDatetime($order->created_at, 'php:d.m.Y H:i:s');
//                }
//            ],
//            [
//                'attribute' => 'updated_at',
//                'value' => function (\app\models\User $order) {
//                    return Yii::$app->formatter->asDatetime($order->updated_at, 'php:d.m.Y H:i:s');
//                }
//            ],
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    if ($model->id === 1) {
                        return null;
                    }
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
