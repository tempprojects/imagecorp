<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => 'Тесты',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список тестов', 'icon' => 'fa fa-circle-o', 'url' => '/test/index',],
                            ['label' => 'Создать тест', 'icon' => 'fa fa-circle-o', 'url' => '/test/create',],
                        ],
                    ],
                    [
                        'label' => 'Медиа',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Картинки', 'icon' => 'fa fa-circle-o', 'url' => '/media/index',],
                            ['label' => 'Загрузить', 'icon' => 'fa fa-circle-o', 'url' => '/media/gallery-load',],
                            ['label' => 'Слайдеры', 'icon' => 'fa fa-circle-o', 'url' => '/media/index-slide',],
                            ['label' => 'Создать слайдер', 'icon' => 'fa fa-circle-o', 'url' => '/media/create-slide',],
                        ],
                    ],
                    [
                        'label' => 'Скидки',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список скидок', 'icon' => 'fa fa-circle-o', 'url' => '/discount/index',],
                            ['label' => 'Создать скидку', 'icon' => 'fa fa-circle-o', 'url' => '/discount/create',],
                        ],
                    ],
                    [
                        'label' => 'Контент',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Блоки', 'icon' => 'fa fa-circle-o', 'url' => '/content/index',],
                            ['label' => 'Создать блок', 'icon' => 'fa fa-circle-o', 'url' => '/content/create',],
                        ],
                    ],
                    [
                        'label' => 'Блог',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Статьи', 'icon' => 'fa fa-circle-o', 'url' => '/blog/index',],
                            ['label' => 'Создать статью', 'icon' => 'fa fa-circle-o', 'url' => '/blog/create',],
                            ['label' => 'Категории', 'icon' => 'fa fa-circle-o', 'url' => '/blog-category/index',],
                            ['label' => 'Создать категорию', 'icon' => 'fa fa-circle-o', 'url' => '/blog-category/create',],
                            ['label' => 'Медиа', 'icon' => 'fa fa-circle-o', 'url' => '/blog-media/index',],
                            ['label' => 'Создать медиа', 'icon' => 'fa fa-circle-o', 'url' => '/blog-media/create',],
                        ],
                    ],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Пользователи', 'icon' => 'fa fa-circle-o', 'url' => '/user/admin/index',],
                            ['label' => 'Создать пользователя', 'icon' => 'fa fa-circle-o', 'url' => '/user/admin/create',],
                            ['label' => 'Роли', 'icon' => 'fa fa-circle-o', 'url' => '/rbac/role/index',],
                            ['label' => 'Создать новую роль', 'icon' => 'fa fa-circle-o', 'url' => '/rbac/role/create',],
                            ['label' => 'Права', 'icon' => 'fa fa-circle-o', 'url' => '/rbac/permission/index',],
                            ['label' => 'Создать новые права', 'icon' => 'fa fa-circle-o', 'url' => '/rbac/permission/create',],
                        ],
                    ],


//========================================================================================================================

                ],
            ]
        ) ?>

    </section>

</aside>
