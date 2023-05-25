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
            <div class="col-6">
                <h5>Ismi:</h5>
                <h5 class="pl-3"><?= Html::encode($model->name) ?></h5>

                <h5>Telefon:</h5>
                <h5 class="pl-3"><?= $model->phone ?? ' ' ?></h5>

                <h5>Email:</h5>
                <h5 class="pl-3"><?= Html::encode($model->email) ?></h5>

                <h5>Oxirgi kirgan vaqti:</h5>
                <h5 class="pl-3"><?= Yii::$app->formatter->asDatetime($model->last_login_at, 'php:d.m.Y H:i:s') ?></h5>
            </div>
            <div class="col-2">
                <div class="card">
                    <img class="card-img" src="<?= Yii::getAlias('@web') . '/assets/65dcec93/img/user1-128x128.jpg'; ?>" alt="">
                </div>
            </div>
        </div>
    </div>

</div>
