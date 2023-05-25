<?php

use app\models\Order;
use yii\helpers\Html;

if (Yii::$app->user->identity->isRoleUser('admin')) {
    $orderCount = Order::find()->where(['status' => Order::STATUS_NEW])->count();
}else{
    $orderCount = Order::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => Order::STATUS_APPROVED])->count();
}
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #3D3E42; color: white!important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell text-white"></i>
                <span class="badge badge-warning navbar-badge"><?= $orderCount ?? 0; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header"><?= $orderCount ?? 0; ?> Xabarlar</span>
                <div class="dropdown-divider"></div>
                <a href="/order/index" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> <?= $orderCount ?? 0; ?> yangi buyurtmalar
                </a>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="<?=$assetDir?>/img/user1-128x128.jpg" alt="User Avatar" class="img-size-30 img-circle mr-2">
                <span class="text-white"><?= Yii::$app->user->identity->name ?? '' ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="/user/profile" class="dropdown-item">
                    Mening profilim
                </a>
                <a href="/order/index" class="dropdown-item">
                    Mening buyurtmalarim
                </a>
                <a href="/user/change-password" class="dropdown-item">
                    Parolni yangilash
                </a>
            </div>
        </li>

        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt text-white"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->