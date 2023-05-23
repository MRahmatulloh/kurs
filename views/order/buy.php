<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Buyurtma qilish';
$this->params['breadcrumbs'][] = ['label' => 'Buyurtmalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create col-12 col-md-6">

    <?= $this->render('_buy_form', [
        'model' => $model,
    ]) ?>

</div>
