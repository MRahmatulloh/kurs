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
<style>
    .bg-site-primary {
        background: rgba(13, 53, 17, .9) !important;
        color: white !important;
    }

    .bg-site-dark {
        background: rgba(0, 0, 0, .6) !important;
        color: white !important;
    }
</style>

<div class="module-index">
    <?php
    if ($lesson_id): ?>
        <div class="col-9 m-auto">
            <div class="card border-0 bg-site-dark pt-3">
                <div class="d-flex justify-content-center">
                    <video
                        id="my-video"
                        class="video-js"
                        controls="play"
                        preload="auto"
                        controlsList="nodownload"
                        width="640"
                        height="400" data-setup="{}"
                    >
                        <source src="<?= \yii\helpers\Url::to(['player/play', 'id' => $lesson_id ?? null]) ?>"
                                type="video/mp4"/>
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
                        <span class="fs-4"><?= $lesson->name ?? '' ?></span>
                        <a href="<?= \yii\helpers\Url::to(['', 'lesson_id' => $lesson_id, 'next' => true]) ?>"
                           class="text-white btn btn-success rounded-pill fs-5">Keyingi darsga o’tish <i
                                class="fa fa-angle-right"></i></a>
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
                    <span
                        class="w-100 bg-site-dark my-2 py-2 d-flex justify-content-between align-items-center rounded">
                            <span class="fs-5"><?= $module->name ?></span>
                            <span class="text-right d-inline-block">
                                        <div>
                                            <?= Html::a('<i class="fa fa-2x fa-angle-down text-white"></i>', ['#'], ['class' => 'btn btn-white white expand_button', 'title' => 'Ko\'rish', 'data-toggle' => "collapse", 'data-target' => "#module" . $module->id, 'aria-expanded' => "false", 'aria-controls' => "collapseExample", 'id' => "#btn" . $module->id,]) ?>
                                            <?php if (Yii::$app->user->can('admin')): ?>
                                                <?= Html::a('<i class="fa fa-eye  text-white"></i>', ['view', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                                <?= Html::a('<i class="fa fa-pen  text-white"></i>', ['update', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                                <?= Html::a('<i class="fa fa-trash  text-white"></i>', ['delete', 'id' => $module->id], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                            <?php endif; ?>
                                        </div>
                            </span>
                    </span>
                    <div class="collapse" id="<?= "module" . $module->id ?>">
                        <?php foreach ($module->lessons as $lesson): ?>
                            <div class="wrappere pl-2"
                                 style="border-left: 10px solid rgba(13, 53, 17, .9); border-radius: 10px">
                                <div class="card card-body py-2 bg-site-primary ">
                                <span class="w-100 d-flex justify-content-between align-items-center rounded">
                                    <span class="fs-6"><?= $lesson->name ?></span>
                                    <span class="text-right d-inline-block">
                                                <div>
                                                    <?php if (Yii::$app->user->can('admin') && $lesson->status == Lesson::STATUS_DEMO): ?>
                                                        <?= Html::a('<i class="fa fa-lock-open text-white"></i>', ['#'], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                                    <?php elseif (Yii::$app->user->can('admin') && $lesson->status == Lesson::STATUS_ACTIVE): ?>
                                                        <?= Html::a('<i class="fa fa-lock text-white"></i>', ['#'], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                                    <?php endif; ?>

                                                    <?= Html::a('<i class="fa fa-eye text-white"></i>', ['index', 'id' => $module->id, 'lesson_id' => $lesson->uuid], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                                    <?php if (Yii::$app->user->can('admin')): ?>
                                                        <?= Html::a('<i class="fa fa-pen text-white"></i>', ['lesson/update', 'id' => $lesson->uuid], ['class' => 'btn btn-white white', 'title' => 'Yangilash']) ?>
                                                        <?= Html::a('<i class="fa fa-trash text-white"></i>', ['lesson/delete', 'id' => $lesson->uuid], ['class' => 'btn btn-white white', 'title' => 'O\'chirish', 'data-method' => 'post', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить этот элемент?'),]) ?>
                                                    <?php endif; ?>
                                                </div>
                                    </span>
                                </span>
                                </div>
                            </div>

                        <?php endforeach; ?>

                        <?php if (Yii::$app->user->can('admin')): ?>
                            <div class="wrappere pl-2"
                                 style="border-left: 10px solid rgba(13, 53, 17, .9); border-radius: 10px">
                                <div class="card card-body py-2 bg-site-primary">
                                <span class="w-100 my-1 d-flex justify-content-end align-items-center rounded">
                                <span class="d-inline-block">
                                                <?= Html::button('<i class="fa fa-fw fa-plus text-white"></i>', ['class' => 'btn btn-light border-0 text-center bg-gray showModalButton', 'title' => 'Qo\'shish']) ?>
                                </span>
                                </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <?php if (Yii::$app->user->can('admin')): ?>
                    <div class="card card-body p-3 mt-2 bg-site-dark">
                                <span class="w-100 d-flex justify-content-end align-items-center rounded">
                                <span class="d-inline-block rounded-circle">
                                                <?= Html::button('<i class="fa fa-fw fa-plus text-gray"></i>', ['class' => 'btn btn-light border-0 text-center bg-light showModalModuleButton', 'title' => 'Qo\'shish']) ?>
                                </span>
                                </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div>
    <?php
    Modal::begin([
        'title' => 'Yangi dars qo\'shish',
        'id' => 'modal',
        'footer' => '',
    ]);
    echo '<div>';
    echo $this->render('/lesson/create_ajax', [
        'model' => new Lesson([
            'module_id' => $id,
        ]),
    ]);
    echo '</div>';
    Modal::end();
    ?>
</div>

<div>
    <?php
    Modal::begin([
        'title' => 'Yangi modul qo\'shish',
        'id' => 'modal-module',
        'footer' => '',
    ]);
    echo '<div>';
    echo $this->render('/module/create_ajax', [
        'model' => new Module([
            'course_id' => 1,
            'status' => Module::STATUS_ACTIVE
        ]),
    ]);
    echo '</div>';
    Modal::end();
    ?>
</div>

<?php
$script = <<< JS
let id = '$id';
$(function() {
    
    if (id != '') {
        $('#module' + id).collapse('show');
    }
    
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
    
    $(document).on('click', '.showModalModuleButton', function() {

         if ($('#modal-module').hasClass('in')) {
             $('#modal-module').find('#modalContent')
                 .load($(this).attr('value'));
             document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
         } else {
             $('#modal-module').modal('show')
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
    
    jQuery('.video-js').bind('contextmenu',function() { return false; });
    
});
JS;

$this->registerJs($script);
?>


