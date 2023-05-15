<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Author $model */

$this->title = 'Muallif qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Mualliflar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-create col-12 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
