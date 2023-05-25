<?php

use app\models\Lesson;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\LessonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-index">

    <p>
        <?= Html::a('Create Lesson', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uuid',
            'name',
            'filename',
            'description:ntext',
            //'module_id',
            [
                'attribute' => 'status',
                'value' => function (Lesson $book) {
                    return Lesson::STATUSES[$book->status] ?? '';
                }
            ],
            //'created_at',
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Order $order) {
                    return Yii::$app->formatter->asDatetime($order->updated_at, 'php:d.m.Y H:i:s');
                }
            ],
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lesson $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
