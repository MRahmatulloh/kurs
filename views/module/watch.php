<?php

use app\models\Lesson;
use app\models\Module;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ModuleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Darslar';
$this->params['count_with_title'] = 'Modullar: ' . $dataProvider->getTotalCount();
$this->params['breadcrumbs'][] = $this->title;

\app\assets\AppAsset::register($this);
?>
<link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet"/>
<style>
    .bg-site-primary {
        background: rgba(13, 53, 17, .9) !important;
        color: white !important;
    }

    .bg2 {
        background-color: #0D3511;
    }

    .bg3 {
        background-color: #1F4323;
    }

    .bg4 {
        background-color: #1f5022;
    }
</style>

<div class="module-index">

    <?php
    if ($lesson_id): ?>
        <div class="col-9 m-auto">
            <div class="card border-0 bg-gray pt-3">
                <div class="d-flex justify-content-center">
                    <video
                        id="my-video"
                        class="video-js"
                        controls="play"
                        preload="auto"
                        width="640"
                        height="350" data-setup="{}"
                    >
                        <source src="<?= \yii\helpers\Url::to(['player/play', 'id' => $lesson_id ?? null])?>" type="video/mp4"/>
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank"
                            >supports HTML5 video</a
                            >
                        </p>
                    </video>
                </div>
                <div class="card-body fs-6 text-white text-start">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <span class="fs-4"><?= $lesson->name ?? ''?></span>
                                        <a href="#" class="text-white btn btn-success rounded-pill fs-5">Keyingi darsga o’tish ></a>
                                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-8 m-auto">
        <div class="container">
            <div class="row">
                <?php
                /**
                 * @var Module $module
                 */
                foreach ($dataProvider->getModels() as $module): ?>
                    <span class="w-100 bg-gray my-2 py-2 d-flex justify-content-between align-items-center rounded">
                            <span class="fs-5"><?= $module->name ?></span>
                            <span class="text-right d-inline-block">
                                        <div>
                                            <?= Html::a('<i class="fa fa-2x fa-angle-down text-white"></i>', ['#'], ['class' => 'btn btn-white white expand_button', 'title' => 'Ko\'rish', 'data-toggle' => "collapse", 'data-target' => "#module" . $module->id, 'aria-expanded' => "false", 'aria-controls' => "collapseExample", 'id' => "#btn" . $module->id,]) ?>
                                            <?= Html::a('<i class="fa fa-eye  text-white"></i>', ['view', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                            <?= Html::a('<i class="fa fa-pen  text-white"></i>', ['update', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                            <?= Html::a('<i class="fa fa-trash  text-white"></i>', ['delete', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                        </div>
                            </span>
                    </span>
                    <div class="collapse" id="<?= "module" . $module->id ?>">
                        <?php foreach ($module->lessons as $lessons): ?>
                            <div class="wrappere pl-2"
                                 style="border-left: 10px solid rgba(13, 53, 17, .9); border-radius: 10px">
                                <div class="card card-body py-2 bg-site-primary ">
                                <span class="w-100 d-flex justify-content-between align-items-center rounded">
                                    <span class="fs-6"><?= $lessons->name ?></span>
                                    <span class="text-right d-inline-block">
                                                <div>
                                                    <?= Html::a('<i class="fa fa-eye text-white"></i>', ['module/watch', 'lesson_id' => $lessons->id], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                                    <?= Html::a('<i class="fa fa-pen text-white"></i>', ['update', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                                    <?= Html::a('<i class="fa fa-trash text-white"></i>', ['delete', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                                </div>
                                    </span>
                                </span>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        <div class="wrappere pl-2"
                             style="border-left: 10px solid rgba(13, 53, 17, .9); border-radius: 10px">
                            <div class="card card-body py-2 bg-site-primary">
                                <span class="w-100 my-1 d-flex justify-content-end align-items-center rounded">
                                <span class="d-inline-block">
                                                <?= Html::a('<i class="fa fa-fw fa-plus text-white"></i>', ['#'], ['class' => 'btn btn-light border-0 text-center bg-gray showModalButton', 'title' => 'Qo\'shish', 'id' => 'modalButton']) ?>
                                </span>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="card card-body p-3 mt-2 bg-gray">
                                <span class="w-100 d-flex justify-content-end align-items-center rounded">
                                <span class="d-inline-block rounded-circle">
                                                <?= Html::a('<i class="fa fa-fw fa-plus text-gray"></i>', ['create'], ['class' => 'btn btn-light border-0 text-center bg-light', 'title' => 'Qo\'shish']) ?>
                                </span>
                                </span>
                </div>

            </div>
        </div>
    </div>
</div>

<div>
    <?php
    Modal::begin([
        'title' => 'Yangi dars qo\'shish',
        'id' => 'modal',
//        'toggleButton' => [
//            'label' => 'Dars qo\'shish',
//            'tag' => 'button',
//            'class' => 'btn btn-success',
//        ],
        'footer' => '',
    ]);
    echo $this->renderAjax('/lesson/create_ajax', [
        'model' => new Lesson([
            'module_id' => 1,
        ]),
    ]);
    Modal::end();
    ?>
</div>

<script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

<?php
$script = <<< JS
$(function() {
    $(document).on('click', '.showModalButton', function() {

         if ($('#modal').hasClass('in')) {
             $('#modal').find('#modalContent')
                 .load($(this).attr('value'));
             document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
         } else {
             $('#modal').modal('show')
                 .find('#modalContent')
                 .load($(this).attr('value'));
             document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
    
    $(document).on('click', '.expand_button', function() {
        if (!$(this).hasClass('collapsed')) {
            $(this).find('i').removeClass('fa-angle-down');
            $(this).find('i').addClass('fa-angle-up');
        } else {
            $(this).find('i').removeClass('fa-angle-up');
            $(this).find('i').addClass('fa-angle-down');
        }
    });
    
});
JS;

$this->registerJs($script);
?>


