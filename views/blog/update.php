<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Blog $model */

$this->title = 'Maqolani yangilash: ' . substr($model->title, 0, 35) . '...';
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => substr($model->title, 0, 35) . '...', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="blog-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
