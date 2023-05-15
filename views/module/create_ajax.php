<?php

use yii\helpers\Html;

///** @var yii\web\View $this */
///** @var app\models\Module $model */

//$this->title = 'Modul qo\'shish';
//$this->params['breadcrumbs'][] = ['label' => 'Modullar', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-create col-12 col-md-12">

    <?= $this->render('_form_ajax', [
        'model' => $model,
    ]) ?>

</div>
