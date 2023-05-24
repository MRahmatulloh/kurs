<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->title = ' ';
\app\assets\FrontendAsset::register($this);

?>
    <link rel="icon" type="image/x-icon" href="/front/img/logo.svg">
    <div class="m-auto">
        <?= $this->render('content', ['content' => $content]) ?>
    </div>

<?= $this->render('footer-origin') ?>