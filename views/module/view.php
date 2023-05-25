<?php

use app\components\Globals;
use app\models\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Module $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Darslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="module-view">

    <p class="text-right">
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
            'name',
            'description:ntext',
            [
                'attribute' => 'course_id',
                'value' => function (Module $module) {
                    return $module->course->name ?? '';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Module $module) {
                    return Globals::getStatuses()[$module->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (\app\models\Module $model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Module $model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'created_by',
                'value' => function (\app\models\Module $model) {
                    return $model->createdBy->name ?? '';
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function (\app\models\Module $model) {
                    return $model->updatedBy->name ?? '';
                }
            ]
        ],
    ]) ?>

</div>
