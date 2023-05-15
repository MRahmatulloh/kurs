<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Author $model */

$this->title = 'Muallifni yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mualliflar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="author-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
