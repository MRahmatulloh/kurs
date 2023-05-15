<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Course $model */

$this->title = 'Kurs qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Kurslar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create col-12 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
