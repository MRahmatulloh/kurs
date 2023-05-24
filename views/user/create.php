<?php

use app\models\Module;
use app\models\User;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\ModuleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Admin qo\'shish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->widget(Select2::classname(), [
        'data' => $userList,
        'language' => 'en',
        'class' => 'form-control',
        'options' => [
            'placeholder' => 'Foydalanuvchini tanlang ...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'class' => 'form-control',
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
