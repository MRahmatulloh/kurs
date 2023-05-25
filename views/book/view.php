<?php

use app\models\Book;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Book $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kitoblar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <?php if (Yii::$app->user->identity->isRoleUser('admin')):?>
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
    <?php endif;?>

    <div class="row">
        <div class="col-4">
            <div class="card-img d-flex justify-content-center m-auto">
                <img  src="<?= '/img/books/' . ($model->photo ?? 'no-photo.png') ?>" width="400px"
                     alt="">
            </div>
        </div>
        <div class="col-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'uuid',
                    'name',
                    [
                        'attribute' => 'filename',
                        'format' => 'raw',
                        'value' => function (Book $book) {
                            return Html::a('Yuklab olish', ['download-file', 'id' => $book->id], ['class' => 'btn btn-success']);
                        }
                    ],
                    [
                        'attribute' => 'price',
                        'format' => 'raw',
                        'value' => function (Book $book) {
                            return $book->price ? pul2($book->price, 2) . ' so\'m' : '';
                        }
                    ],
                    [
                        'attribute' => 'photo',
                        'format' => 'raw',
                        'value' => function (Book $book) {
                            return Html::a('Yuklab olish', ['download-photo', 'id' => $book->id], ['class' => 'btn btn-success']);
                        }
                    ],
                    'description:ntext',
                    [
                        'attribute' => 'author_id',
                        'value' => function (Book $book) {
                            return $book->author->name ?? '';
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function (Book $book) {
                            return \app\components\Globals::getStatuses()[$book->status];
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
