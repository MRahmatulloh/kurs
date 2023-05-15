<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Book $model */

$this->title = 'Yangi kitob qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Kitoblar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create col-12 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
