<?php

use app\models\Lesson;
use app\models\Module;
use yii\bootstrap4\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Course $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kurslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <style>
        .link:hover{
            background: #0b2e13!important;
            color: white!important;
            cursor: pointer;
        }
        .table-striped > tbody > tr.link:nth-of-type(odd) > *:hover{
            color: white!important;
        }
        .table-striped > tbody > tr.link:nth-of-type(2n+1) > *:hover{
            color: white!important;
        }
    </style>
<div class="course-view">
    <div class="row">
        <div class="col-6">
            <h4>Modullar</h4>
            <?php
            Modal::begin([
                'title' => 'Yangi modul qo\'shish',
                'toggleButton' => [
                    'label' => 'Modul qo\'shish',
                    'tag' => 'button',
                    'class' => 'btn btn-success',
                ],
                'footer' => '',
            ]);
            echo $this->render('/module/create_ajax', [
                'model' => new Module([
                    'course_id' => $model->id,
                ]),
            ]);
            Modal::end();
            ?>
            <br>
            <br>
            <?= GridView::widget([
                'dataProvider' => $moduleDataProvider,
                'rowOptions'   => function (Module $model, $key, $index, $grid) {
                    return ['data-id' => $model->id, 'data-course_id' => $model->course_id, 'class' => 'link'];
                },
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',

                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Module $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-6">
            <h4> <?= $module_name ? $module_name . ': ' : '' ?> Darslar</h4>
            <?php
            Modal::begin([
                'title' => 'Yangi dars qo\'shish',
                'toggleButton' => [
                    'label' => 'Dars qo\'shish',
                    'tag' => 'button',
                    'class' => 'btn btn-success',
                ],
                'footer' => '',
            ]);
            echo $this->renderAjax('/lesson/create_ajax', [
                'model' => new Lesson([
                    'module_id' => $model->id,
                ]),
            ]);
            Modal::end();
            ?>
            <br>
            <br>
            <?= GridView::widget([
                'dataProvider' => $lessonDataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',

                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Lesson $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php
$this->registerJs("

    $('td.link').click(function (e) {
        var id = $(this).closest('tr').data('id');
        var course_id = $(this).closest('tr').data('course_id');
        if(e.target == this)
            location.href = '" . Url::to(['']) . "?id=' + course_id + '&module_id=' + id;
    });

");
