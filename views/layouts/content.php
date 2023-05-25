<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;

?>
<div class="content-wrapper px-3 position-relative">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fs-2" style="color: rgba(13, 53, 17, .9);">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        if ($this->params['count'] ?? false) {
                            echo '      Soni: ' . \yii\helpers\Html::encode($this->params['count']);
                        }
                        if ($this->params['count_with_title'] ?? false) {
                            echo '      ' . \yii\helpers\Html::encode($this->params['count_with_title']);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'homeLink' => [
                            'label' => 'Bosh sahifa',
                            'url' => '/site/index',
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <?php
        $text = '';
        if (is_array(Yii::$app->session->getFlash('success'))) {
            foreach (Yii::$app->session->getFlash('success') as $key => $value) {
                $text .= $value . '<br>';
            }
        } else {
            $text = Yii::$app->session->getFlash('success');
        }
        ?>

        <?= \hail812\adminlte\widgets\Alert::widget([
            'type' => 'success',
            'title' => 'Amal muvaffaqiyatli!',
            'body' => "<h3>" . $text . "</h3>",
        ]) ?>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <?php
        $text = '';
        if (is_array(Yii::$app->session->getFlash('error'))) {
            foreach (Yii::$app->session->getFlash('error') as $key => $value) {
                $text .= $value . '<br>';
            }
        } else {
            $text = Yii::$app->session->getFlash('error');
        }
        ?>

        <?= \hail812\adminlte\widgets\Alert::widget([
            'type' => 'danger',
            'title' => 'Xatolik!',
            'body' => "<h3>" . $text . "</h3>",
        ]) ?>
    <?php endif; ?>

    <!-- Main content -->
    <div class="content">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>