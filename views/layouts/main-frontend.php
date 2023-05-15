<?php
/* @var $this \yii\web\View */
/* @var $content string */

$this->title = ' ';
$this->registerCssFile('/frontend/assets/dist/css/bootstrap.min.css');
$this->registerCssFile('/frontend/assets/dist/css/cover.css');
$this->registerJsFile('/frontend/assets/dist/js/bootstrap.bundle.min.js');

?>
<?= $this->render('content', ['content' => $content]) ?>
<?= $this->render('footer-origin') ?>