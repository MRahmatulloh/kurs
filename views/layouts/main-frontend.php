<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->title = ' ';
\app\assets\FrontendAsset::register($this);

?>
<div class="m-auto">
    <?= $this->render('content', ['content' => $content]) ?>
</div>

<?= $this->render('footer-origin') ?>