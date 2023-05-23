<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Author $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mualliflar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

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
            'phone',
            'email:email',
            [
                'attribute' => 'user_id',
                'value' => function (Author $author) {
                    return $author->user->name ?? '';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (\app\models\Author $author) {
                    return \app\components\Globals::getStatuses()[$author->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function (\app\models\Author $model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function (\app\models\Author $model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s');;
                }
            ]
        ],
    ]) ?>

</div>
