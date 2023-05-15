<?php

use app\models\Blog;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Blog $model */

$this->title = substr($model->title, 0, 35) . '...';
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = substr($model->title, 0, 35) . '...';
\yii\web\YiiAsset::register($this);
?>
<div class="blog-view">

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

    <div class="row">
        <div class="col-4">
            <div class="card-img d-flex justify-content-center m-auto">
                <img class="card-img-top" src="<?= '/img/blogs/' . ($model->photo ?? 'no-photo.png') ?>"
                     alt="">
            </div>
        </div>
        <div class="col-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'uuid',
                    'title',
                    'text:ntext',
                    [
                        'attribute' => 'photo',
                        'format' => 'raw',
                        'value' => function (Blog $blog) {
                            return Html::a('Yuklab olish', ['download-photo', 'id' => $blog->id], ['class' => 'btn btn-success']);
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function (Blog $blog) {
                            return \app\components\Globals::getStatuses()[$blog->status];
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>



</div>
