<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\View $model */

$this->title = 'Create View';
$this->params['breadcrumbs'][] = ['label' => 'Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-create col-12 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
