<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Module $model */

$this->title = 'Modulni yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Darslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="module-update col-12 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
