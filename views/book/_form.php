<?php

use app\components\Globals;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput([
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'image')->fileInput([
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'author_id')->widget(Select2::classname(), [
        'data' => \app\models\Author::selectList(),
        'language' => 'de',
        'options' => ['placeholder' => 'Muallifni tanlang ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(Globals::getStatuses(), [
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
