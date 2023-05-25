<?php

use app\models\Lesson;
use app\models\Module;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ModuleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Darslar';
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

    .bg7 {
        background-color: rgba(1, 19, 13, .3);
    }

    .trade {
        font-size: 24px;
        color: #03F291;
        text-transform: uppercase;
    }

    .bg3 {
        background-color: #1F4323;
    }

    .bg4 {
        background-color: #1f5022;
    }

    .title-bar {
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .section-buy {
        padding-bottom: 220px;
    }
</style>

<div class="module-index">
    <div class="col-6 m-auto mb-5 bg7 rounded rounded-3 text-white pt-5 text-center">
        <h1>INTENSIV <span class="trade fs-1">TREYDING</span> KURSINI</h1>
        <h3>SOTIB OLING VA QISQA VAQT ICHIDA PROFESSIONAL TREYDERGA AYLANING!</h3>
        <div class="d-flex justify-content-center my-5">
            <form method="post" action="<?= \yii\helpers\Url::to(['order/buy']) ?>">
                <input type="hidden" name="wants" value="course"/>
                <input type="hidden" name="id" value="6d81cd8c-b0c1-4122-95bb-ce1a30f2644d"/>
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                <button class="btn btn-success my-3 rounded rounded-pill fs-3 px-4" type="submit">Sotib olish</button>
            </form>
        </div>
    </div>

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
                                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-10 m-auto">
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
                                            <?= Html::a('<i class="fa fa-1x fa-lock text-white"></i>', ['#'], ['class' => 'btn btn-white white expand_button', 'title' => 'Ko\'rish', 'data-toggle' => "collapse", 'data-target' => "#module" . $module->id, 'aria-expanded' => "false", 'aria-controls' => "collapseExample", 'id' => "#btn" . $module->id,]) ?>
                                            <?= Html::a('<i class="fa fa-2x fa-angle-down text-white"></i>', ['#'], ['class' => 'btn btn-white white expand_button', 'title' => 'Ko\'rish', 'data-toggle' => "collapse", 'data-target' => "#module" . $module->id, 'aria-expanded' => "false", 'aria-controls' => "collapseExample", 'id' => "#btn" . $module->id,]) ?>
                                        </div>
                            </span>
                    </span>
                    <div class="collapse" id="<?= "module" . $module->id ?>">
                        <?php foreach ($module->lessons as $lesson): ?>
                        <?php if ($lesson->status == Lesson::STATUS_INACTIVE) continue; ?>
                            <div class="wrappere pl-2"
                                 style="border-left: 10px solid rgba(13, 53, 17, .9); border-radius: 10px">
                                <div class="card card-body py-2 bg-site-primary ">
                                <span class="w-100 d-flex justify-content-between align-items-center rounded">
                                    <span class="fs-6"><?= $lesson->name ?></span>
                                    <span class="text-right d-inline-block">
                                                <?php if ($lesson->status == Lesson::STATUS_DEMO): ?>
                                                    <div>
                                                        <?= Html::a('<i class="fa fa-eye text-white"></i>', ['index', 'id' => $module->id, 'lesson_id' => $lesson->uuid], ['class' => 'btn btn-white white', 'title' => 'Ko\'rish']) ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div>
                                                        <?= Html::a('<i class="fa fa-lock text-white"></i>', ['#'], ['class' => 'btn btn-white white', 'title' => 'Qulflangan']) ?>
                                                    </div>
                                                <?php endif; ?>
                                    </span>
                                </span>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-12 text-center section-buy">
        <div class="d-flex justify-content-center my-5">
            <form method="post" action="<?= \yii\helpers\Url::to(['order/buy']) ?>">
                <input type="hidden" name="wants" value="course"/>
                <input type="hidden" name="id" value="6d81cd8c-b0c1-4122-95bb-ce1a30f2644d"/>
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                <button class="btn btn-success my-3 rounded rounded-pill fs-3 px-4" type="submit">Kursni sotib olish
                </button>
            </form>
        </div>
    </div>
    <div class="col-12 text-center py-5 bg7 title-bar">
        <h1 class="text-white">Biz bilan birga rivojlaning</h1>
        <h1 class="trade fs-1">Uzscool invest!</h1>
    </div>
</div>

<?php
$script = <<< JS
let id = '$id';
$(function() {
    
    if (id != '') {
        $('#module' + id).collapse('show');
    }
    
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


