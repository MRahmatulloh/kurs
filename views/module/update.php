<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Module $model */

$this->title = 'Update Module: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="module-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
