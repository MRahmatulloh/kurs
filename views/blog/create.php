<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Blog $model */

$this->title = 'Yangi maqola qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create col-12 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
