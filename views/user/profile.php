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
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h3>Ismi:</h3>
                <h4 class="pl-3"><?= Html::encode($model->name) ?></h4>

                <h3>Telefon:</h3>
                <h4 class="pl-3"><?= $model->phone ?? ' ' ?></h4>

                <h3>Email:</h3>
                <h4 class="pl-3"><?= Html::encode($model->email) ?></h4>

                <h3>Oxirgi kirgan vaqti:</h3>
                <h4 class="pl-3"><?= Yii::$app->formatter->asDatetime($model->last_login_at, 'php:d.m.Y H:i:s') ?></h4>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img" src="/assets/65dcec93/img/user1-128x128.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

</div>
