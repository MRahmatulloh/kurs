<?php

use app\components\Globals;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wants')->dropDownList($model::WANTS, [
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'wants_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Globals::getOrderStatuses(), [
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Buyurtma qilish', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
