<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lesson-view">

    <p class="text-right">
        <?= Html::a('Yangilash', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->uuid], [
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
            'uuid',
            'name',
            [
                'attribute' => 'filename',
                'format' => 'raw',
                'value' => function (\app\models\Lesson $model) {
                    return Html::a('Yuklab olish', ['download-file', 'id' => $model->uuid], ['class' => 'btn btn-success']);
                }
            ],
            'description:ntext',
            [
                'attribute' => 'module_id',
                'value' => function (\app\models\Lesson $model) {
                    return $model->module->name ?? '';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (\app\models\Lesson $model) {
                    return \app\models\Lesson::STATUSES[$model->status] ?? '';
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (\app\models\Lesson $model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Lesson $model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'created_by',
                'value' => function (\app\models\Lesson $model) {
                    return $model->createdBy->name ?? '';
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function (\app\models\Lesson $model) {
                    return $model->updatedBy->name ?? '';
                }
            ]
        ],
    ]) ?>

</div>
