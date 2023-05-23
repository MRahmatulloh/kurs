<?php

use app\models\Book;
use yii\helpers\Html;
use app\assets\AppAsset;

/** @var yii\web\View $this */
/** @var app\models\search\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

AppAsset::register($this);

$this->title = 'Kitoblar';
$this->params['count'] = count($dataProvider->getModels());
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .bg3 {
        background-color: #1F4323;
    }

    .bg4 {
        background-color: #1f5022;
    }
</style>
<div class="book-index container">
<div class="col-10 m-auto">

    <div class="container">
        <div class="row">
            <?php
            /**
             * @var Book $book
             */
            foreach ($dataProvider->getModels() as $book): ?>
                <div class="col-4">
                    <div class="card">
                        <div class="card-img d-flex justify-content-center">
                            <img class="card-img-top" src="<?= Yii::getAlias('@web') . '/img/books/' . ($book->photo ?? 'no-photo.png') ?>"
                                 alt="">
                        </div>
                        <div class="card-body bg3 fs-6 text-white text-start">
                            <h5><?= $book->name ?></h5>
                            <p><?= $book->description ?></p>
                            <span class="d-flex justify-content-between align-items-center">
                                <?php if($book->price):?>
                                    <span class="fs-6"><?= pul2($book->price, 2) ?> so'm</span>
                                <?php else:?>
                                    <span class="fs-6">Bepul</span>
                                <?php endif;?>

                                        <div>
                                            <?= Html::a('<i class="fa fa-fw fa-eye text-white"></i>', ['view', 'id' => $book->id], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                            <?= Html::a('<i class="fa fa-fw fa-pen text-white"></i>', ['update', 'id' => $book->id], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                            <?= Html::a('<i class="fa fa-fw fa-trash text-white"></i>', ['delete', 'id' => $book->id], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                        </div>
                                        </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="col-4 bg-light pb-3">
                <div class="card h-100 d-flex flex-row justify-content-center align-items-center py-5">
                    <?= Html::a('<i class="fa fa-7x fa-fw fa-plus text-white"></i>', ['create'], ['class' => 'btn btn-light border-0 text-center img-circle elevation-3 bg-gray', 'title' => 'Qo\'shish']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
