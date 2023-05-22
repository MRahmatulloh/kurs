<?php

use app\models\Blog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\BlogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Blog';
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
<div class="blog-index container">
    <div class="col-10 m-auto">
        <div class="container">
            <div class="row">
                <?php
                /**
                 * @var Blog $blog
                 */
                foreach ($dataProvider->getModels() as $blog): ?>

                    <div class="col-3 mb-3 pr-0">
                        <img src="<?= '/img/blogs/' . ($blog->photo  ?? 'no-photo.png') ?>" class="card-img-top h-100" alt="">
                    </div>
                    <div class="col-9 mb-3 pt-2 pl-2 pl-0 rounded-right bg-site-primary text-white d-flex justify-content-between flex-column">
                        <h5><?= $blog->title ?? '' ?></h5>
                        <p class="">
                            <?= $blog->text ?? '' ?>
                        </p>
                        <span class="text-right">
                                        <div>
                                            <?= Html::a('<i class="fa fa-fw fa-eye text-white"></i>', ['view', 'id' => $blog->id], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                            <?= Html::a('<i class="fa fa-fw fa-pen text-white"></i>', ['update', 'id' => $blog->id], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                            <?= Html::a('<i class="fa fa-fw fa-trash text-white"></i>', ['delete', 'id' => $blog->id], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                        </div>
                        </span>
                    </div>

                <?php endforeach; ?>

                <div class="col-3 mb-3 pr-0">
                    <img src="<?= '/img/blogs/no-photo.png' ?>" class="card-img-top h-100" alt="">
                </div>
                <div class="col-9 mb-3 pt-2 pl-2 pl-0 rounded-right bg-site-primary text-white d-flex justify-content-end align-items-center">
                        <span class="pr-5">
                                                    <?= Html::a('<i class="fa fa-5x fa-fw fa-plus text-white"></i>', ['create'], ['class' => 'btn btn-light border-0 text-center bg-gray', 'title' => 'Qo\'shish']) ?>

                        </span>

                </div>
            </div>
        </div>
    </div>
</div>

