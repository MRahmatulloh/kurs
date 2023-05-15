<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\CourseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kurslar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <p class="text-right">
        <?= Html::a('Kurs qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'uuid',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function (Course $course) {
                    return Html::a($course->name, ['details', 'id' => $course->id]);
                }
            ],
            'description:ntext',
            [
                'attribute' => 'price',
                'format' => 'raw',
                'value' => function (Course $course) {
                    return $course->price ? pul2($course->price, 2) . ' so\'m' : '';
                }
            ],
            [
                'attribute' => 'author_id',
                'value' => function (Course $course) {
                    return $course->author->name ?? '';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Course $course) {
                    return \app\components\Globals::getStatuses()[$course->status];
                }
            ],
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Course $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
