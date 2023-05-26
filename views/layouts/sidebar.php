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
                        'label' => 'O\'quvchilar',
                        'icon' => 'user-graduate',
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