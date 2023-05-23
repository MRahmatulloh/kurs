<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #011A11!important;">
    <!-- Brand Logo -->
    <a href="/site/index" class="brand-link border-0 text-center">
        <img src="<?= Yii::$app->request->baseUrl . '/img/logo.svg'; ?>" alt="AdminLTE Logo"
             class="brand-image-large bd-brand-logos img-circle elevation-5">
        <img src="<?= Yii::$app->request->baseUrl . '/img/logo.svg'; ?>" alt="AdminLTE Logo"
             class="brand-image d-none img-circle elevation-3" style="opacity: .9">
    </a>

    <!-- Sidebar -->
    <div class="sidebar pt-3">
        <!-- Sidebar user panel (optional) -->
        <!--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
        <!--            <div class="image">-->
        <!--                <img src="-->
        <?php //=$assetDir?><!--/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
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
        <nav class="mt-2" style="background: rgba(13, 53, 17, .9)!important;">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Adminlar',
                        'icon' => 'user-shield',
                        'url' => ['/user/admins'],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->can('admin')
                    ],
                    [
                        'label' => 'O\'qituvchilar',
                        'icon' => 'user-graduate',
                        'url' => ['/user/teachers'],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->can('admin')
                    ],
                    [
                        'label' => 'O\'quvchilar',
                        'icon' => 'users',
                        'url' => ['/user/pupils'],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->can('admin')
                    ],
                    [
                        'label' => 'Buyurtmalar',
                        'icon' => 'cart-plus',
                        'url' => ['/order/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Mualliflar',
                        'icon' => 'person-booth',
                        'url' => ['/author/index'],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->can('admin')
                    ],
                    [
                        'label' => 'Darslar',
                        'icon' => 'clipboard-list',
                        'url' => ['/module/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Kitoblar',
                        'icon' => 'book',
                        'url' => ['/book/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => 'Bloglar',
                        'icon' => 'rss',
                        'url' => ['/blog/index'],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->can('admin')
                    ],

                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>