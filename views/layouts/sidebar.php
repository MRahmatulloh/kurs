<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/site/index" class="brand-link border-0 text-center">
        <img src="<?= Yii::$app->request->baseUrl . '/img/logo.svg'; ?>" alt="AdminLTE Logo" class="brand-image-large bd-brand-logos img-circle elevation-3">
        <img src="<?= Yii::$app->request->baseUrl . '/img/logo.svg'; ?>" alt="AdminLTE Logo" class="brand-image d-none img-circle elevation-3" style="opacity: .9">
    </a>

    <!-- Sidebar -->
    <div class="sidebar pt-3">
        <!-- Sidebar user panel (optional) -->
<!--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
<!--            <div class="image">-->
<!--                <img src="--><?php //=$assetDir?><!--/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
<!--            </div>-->
<!--            <div class="info">-->
<!--                <a href="#" class="d-block">Alexander Pierce</a>-->
<!--            </div>-->
<!--        </div>-->

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Adminlar', 'icon' => 'user', 'url' => ['#']],
                    ['label' => 'O\'qituvchilar', 'icon' => 'user', 'url' => ['#']],
                    ['label' => 'O\'quvchilar', 'icon' => 'user', 'url' => ['#']],
                    ['label' => 'Zakazlar', 'icon' => 'user', 'url' => ['/order/index']],
                    ['label' => 'Mualliflar', 'icon' => 'user', 'url' => ['/author/index']],
                    ['label' => 'Darslar', 'icon' => 'list', 'url' => ['/course/index']],
                    ['label' => 'Kitoblar', 'icon' => 'book', 'url' => ['/book/index']],
                    ['label' => 'Bloglar', 'icon' => 'blog', 'url' => ['/blog/index']],
//
//                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
//                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
//                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
//                    ['label' => 'About','url' => ['/site/about'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
//                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
//                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>