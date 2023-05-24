<?php
$this->title = 'Admin panel';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $ordersCount,
                'text' => 'Yangi buyurtmalar',
                'icon' => 'fas fa-shopping-cart',
                'linkUrl' => ['user/pupils'],
                'linkText' => 'Batafsil',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $pupilsCount,
                'text' => 'O\'quvchilar',
                'icon' => 'fas fa-user-graduate',
                'linkUrl' => ['order/index'],
                'linkText' => 'Batafsil',
                'theme' => 'success',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $booksCount,
                'text' => 'Kitoblar',
                'icon' => 'fa fa-book',
                'linkUrl' => ['book/index'],
                'linkText' => 'Batafsil',
                'theme' => 'success',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $lessonsCount,
                'text' => 'Darslar',
                'icon' => 'fa fa-clipboard-list',
                'linkUrl' => ['module/index'],
                'linkText' => 'Batafsil',
                'theme' => 'success',
            ]) ?>
        </div>
    </div>
</div>