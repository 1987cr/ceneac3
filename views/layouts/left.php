<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                    // Usuarios
                    [
                        'label' => 'User Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => 'Users', 'icon' => 'fa fa-file-code-o', 'url' => ['/user'],],
                            ['label' => 'Roles', 'icon' => 'fa fa-dashboard', 'url' => ['/role'],],
                            ['label' => 'Permissions', 'icon' => 'fa fa-dashboard', 'url' => ['/permission'],],
                        ],
                    ],

                    // Cursos
                    [
                        'label' => 'Course Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => 'Courses', 'icon' => 'fa fa-file-code-o', 'url' => ['/course'],],
                            ['label' => 'Categories', 'icon' => 'fa fa-file-code-o', 'url' => ['/category'],],
                            ['label' => 'Schedule', 'icon' => 'fa fa-file-code-o', 'url' => ['/schedule'],],
                        ],
                    ],

                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
