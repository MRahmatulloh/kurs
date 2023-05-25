<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Course $model */

$this->title = 'Kursni yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kurslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="course-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
