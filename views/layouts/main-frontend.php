<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->title = ' ';
\app\assets\FrontendAsset::register($this);

?>
<?= $this->render('content', ['content' => $content]) ?>
<?= $this->render('footer-origin') ?>