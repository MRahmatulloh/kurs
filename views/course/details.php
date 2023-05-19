<?php

use app\models\Lesson;
use app\models\Module;
use yii\bootstrap4\Modal;
use yii\bootstrap5\Html;
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
    .link:hover {
        background: #0b2e13 !important;
        color: white !important;
        cursor: pointer;
    }

    .active td {
        background: #03F291!important;
        font-weight: bold;
        color: white !important;
    }

    .table-striped > tbody > tr.link:nth-of-type(odd) > *:hover {
        color: white !important;
    }

    .table-striped > tbody > tr.link:nth-of-type(2n+1) > *:hover {
        color: white !important;
    }
    .link td:last-child {
        text-align: right;
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
                'rowOptions' => function (Module $model, $key, $index, $grid) use ($module_id) {
                    $class = $module_id == $model->id ? 'link active' : 'link';
                    return ['data-id' => $model->id, 'data-course_id' => $model->course_id, 'class' => $class];
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',

                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, Module $model, $key) {
                                return Html::a('<span class="fa fa-pen"></span>', ['module/update', 'id' => $model->id], [
                                    'title' => Yii::t('yii', 'Update'),
                                ]);
                            },
                            'delete' => function ($url, Module $model, $key) {
                                return Html::a('<span class="fa fa-eye"></span>', ['module/delete', 'id' => $model->id], [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                            },
                        ],
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
                    'module_id' => $module_id,
                ]),
            ]);
            Modal::end();
            ?>
            <br>
            <br>
            <?= GridView::widget([
                'dataProvider' => $lessonDataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',

                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, Lesson $model, $key) {
                                return Html::a('<span class="fa fa-pen"></span>', ['lesson/update', 'id' => $model->id], [
                                    'title' => Yii::t('yii', 'Update'),
                                ]);
                            },
                            'delete' => function ($url, Lesson $model, $key) {
                                return Html::a('<span class="fa fa-eye"></span>', ['lesson/delete', 'id' => $model->id], [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php

$url = Url::to(['']);

$js = <<<JS

let url = '$url';
let module_id = '$module_id';

$(document).ready(function() {

    $('tr.link').click(function (e) {
        var id = $(this).closest('tr').data('id');
        var course_id = $(this).closest('tr').data('course_id');

        if(e.target.parentNode === this){
            let newUrl = url + '?id=' + course_id + '&module_id=' + id;
            
            if (id === module_id) {
                newUrl = url + '?id=' + course_id;
            }
            
            location.href = newUrl;
        }

    });

});
JS;

$this->registerJs($js);
?>
