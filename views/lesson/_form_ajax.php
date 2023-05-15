<?php

use app\components\Globals;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin([
        'action' => '/lesson/create-ajax',
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput([
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'module_id')->widget(Select2::classname(), [
        'data' => \app\models\Module::selectList(),
        'language' => 'en',
        'options' => ['placeholder' => 'Modulni tanlang ...'],
        'pluginOptions' => [
            'allowClear' => true,
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
