<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */

$this->title = 'Darsni yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Darslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->uuid]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="lesson-update col-12 col-md-6">

    <?= $this->render('_form_ajax', [
        'model' => $model,
    ]) ?>

</div>
