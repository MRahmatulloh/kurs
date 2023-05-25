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
    .bg-site-primary {
        background: rgba(13, 53, 17, .9) !important;
        color: white !important;
    }

    .bg-site-dark {
        background: rgba(0, 0, 0, .6) !important;
        color: white !important;
    }

    .bg7 {
        background-color: rgba(1, 19, 13, .3);
    }
    .trade {
        font-size: 24px;
        color: #03F291;
        text-transform: uppercase;
    }

    .bg3 {
        background-color: #1F4323;
    }

    .bg4 {
        background-color: #1f5022;
    }
    .title-bar{
        position: absolute;
        bottom: 0;
        left: 0;
    }
    .section-buy{
        padding-bottom: 220px;
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
                                <img class="card-img-top"
                                     src="<?= Yii::getAlias('@web') . '/img/books/' . ($book->photo ?? 'no-photo.png') ?>"
                                     alt="">
                            </div>
                            <div class="card-body bg3 fs-6 text-white text-start">
                                <h5><?= $book->name ?></h5>
                                <p><?= $book->description ?></p>
                                <span class="d-flex justify-content-between align-items-center">
                                    <?php if (Yii::$app->user->identity->isRoleUser('admin')): ?>
                                        <?php if ($book->price): ?>
                                            <span class="fs-6"><?= pul2($book->price, 2) ?> so'm</span>
                                        <?php else: ?>
                                            <span class="fs-6">Bepul</span>
                                        <?php endif; ?>


                                        <div>
                                            <?= Html::a('<i class="fa fa-fw fa-eye text-white"></i>', ['view', 'id' => $book->id], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                            <?= Html::a('<i class="fa fa-fw fa-pen text-white"></i>', ['update', 'id' => $book->id], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                            <?= Html::a('<i class="fa fa-fw fa-trash text-white"></i>', ['delete', 'id' => $book->id], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                        </div>

                                    <?php else: ?>
                                        <?php if ($book->price && !$book->isPurchased()): ?>
                                            <span class=""><?= pul2($book->price, 2) . ' so\'m' ?></span>
                                            <form method="post" action="<?= \yii\helpers\Url::to(['order/buy']) ?>">
                                                      <input type="hidden" name="wants" value="book"/>
                                                      <input type="hidden" name="id" value="<?= $book->uuid ?>"/>
                                                      <input type="hidden" name="_csrf"
                                                             value="<?= Yii::$app->request->csrfToken ?>"/>
                                                      <button class="btn text-white btn btn-success fs-5" type="submit">Sotib olish</button>
                                                    </form>
                                        <?php else: ?>
                                            <span style="color: #05C979">Bepul</span>
                                            <form method="post" action="<?= \yii\helpers\Url::to(['book/download']) ?>">
                                                      <input type="hidden" name="id" value="<?= $book->uuid ?>"/>
                                                      <input type="hidden" name="_csrf"
                                                             value="<?= Yii::$app->request->csrfToken ?>"/>
                                                      <button class="btn text-white btn btn-success fs-5" type="submit">Yuklab olish</button>
                                                    </form>
                                        <?php endif; ?>
                                    <?php endif ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (Yii::$app->user->can('admin')): ?>
                    <div class="col-4 bg-light pb-3">
                        <div class="card h-100 d-flex flex-row justify-content-center align-items-center py-5">
                            <?= Html::a('<i class="fa fa-7x fa-fw fa-plus text-white"></i>', ['create'], ['class' => 'btn btn-light border-0 text-center img-circle elevation-3 bg-gray', 'title' => 'Qo\'shish']) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (Yii::$app->user->can('pupil')): ?>
        <div class="col-12 text-center section-buy">
            <div class="d-flex justify-content-center my-5">
                <form method="post" action="<?= \yii\helpers\Url::to(['order/buy']) ?>">
                    <input type="hidden" name="wants" value="course"/>
                    <input type="hidden" name="id" value="6d81cd8c-b0c1-4122-95bb-ce1a30f2644d"/>
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                    <button class="btn btn-success my-3 rounded rounded-pill fs-3 px-4" type="submit">Kursni sotib olish</button>
                </form>
            </div>
        </div>
        <div class="col-12 text-center py-5 bg7 title-bar">
            <h1 class="text-white">Biz bilan birga rivojlaning</h1>
            <h1 class="trade fs-1">Uzscool invest!</h1>
        </div>
    <?php endif; ?>
</div>
