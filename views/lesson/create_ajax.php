<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */

//$this->title = 'Create Lesson';
//$this->params['breadcrumbs'][] = ['label' => 'Lessons', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-create col-12 col-md-12">

    <?= $this->render('_form_ajax', [
        'model' => $model,
    ]) ?>

</div>
