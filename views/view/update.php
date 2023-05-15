<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\View $model */

$this->title = 'Update View: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="view-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
