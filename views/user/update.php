<?php

use app\components\Globals;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model \app\models\User */

$this->title = 'Foydalanuvchi ma\'umotlarini yangilash';
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['profile', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
\app\assets\AppAsset::register($this);
?>
<div class="site-signup">

    <?= Html::errorSummary($model) ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                'mask' => '99-999-99-99',
                'options' => [
                    'class' => 'form-control',
                    'required' => 'required',
                ],
            ]) ?>
            <?= $form->field($model, 'image')->fileInput([
                'class' => 'form-control',
            ]) ?>
            <?php if (Yii::$app->user->identity->isRoleUser('admin')): ?>
                <?= $form->field($model, 'status')->dropDownList(Globals::getStatuses(), [
                    'class' => 'form-control',
                ]) ?>
            <?php endif; ?>
            <div class="form-group">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
