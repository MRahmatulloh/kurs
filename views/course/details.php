<?php

use app\models\Module;
use yii\bootstrap4\Modal;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Course $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kurslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
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
            echo $this->renderAjax('/module/create_ajax', [
                'model' => new Module([
                    'course_id' => $model->id,
                ]),
            ]);
            Modal::end();
            ?>

            <?= GridView::widget([
                'dataProvider' => $moduleDataProvider,
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
            <h4>Darslar</h4>
            <p>
                <?= Html::a('Dars qo\'shish', ['/lesson/create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $lessonDataProvider,
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
    </div>
</div>
