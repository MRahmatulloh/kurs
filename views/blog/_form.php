<?php

use app\components\Globals;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Blog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'image')->fileInput([
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(Globals::getStatuses(), [
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
