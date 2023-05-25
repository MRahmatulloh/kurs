<?php

use app\models\Module;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Mening profilim';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-index">
    <p class="text-end">
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="card">
                    <img class="card-img" src="<?= Yii::getAlias('@web') . '/img/users/' . ($model->photo  ?? 'no-photo.jpg'); ?>" alt="">
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-6">
                <h5 class="text-bold">Ismi:</h5>
                <h5 class="pl-3"><?= Html::encode($model->name) ?></h5>

                <h5 class="text-bold">Telefon:</h5>
                <h5 class="pl-3"><?= $model->phone ?? ' ' ?></h5>

                <h5 class="text-bold">Email:</h5>
                <h5 class="pl-3"><?= Html::encode($model->email) ?></h5>

                <h5 class="text-bold">Oxirgi kirgan vaqti:</h5>
                <h5 class="pl-3"><?= Yii::$app->formatter->asDatetime($model->last_login_at, 'php:d.m.Y H:i:s') ?></h5>
            </div>

        </div>
    </div>

</div>
