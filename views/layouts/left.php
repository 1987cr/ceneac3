<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                    // Usuarios
                    [
                        'label' => 'Usuarios',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => 'Usuarios CENEAC', 'icon' => 'fa fa-user', 'url' => ['/user'],],
                            ['label' => 'Participantes', 'icon' => 'fa fa-user', 'url' => ['/participante'],],
                        ],
                    ],

                    // Roles y Permisos
                    [
                        'label' => 'Roles y Permisos',
                        'icon' => 'fa fa-key',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => 'Assignment', 'icon' => 'fa fa-user-plus', 'url' => ['/admin/assignment'],],
                            ['label' => 'Roles', 'icon' => 'fa fa-user-plus', 'url' => ['/admin/role'],],
                            ['label' => 'Permissions', 'icon' => 'fa fa-key', 'url' => ['/admin/permission'],],
                        ],
                    ],

                    // Instructores
                    [
                        'label' => 'Instructores',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => 'Instructores', 'icon' => 'fa fa-id-card-o', 'url' => ['/instructor'],],
                            ['label' => 'Postulados', 'icon' => 'fa fa-hand-stop-o', 'url' => ['/postulate'],],
                        ],
                    ],

                    // Cursos
                    [
                        'label' => 'Cursos',
                        'icon' => 'fa fa-graduation-cap',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            (\Yii::$app->user->can('Cursos - Todos') ? ['label' => 'Cursos', 'icon' => 'fa fa-list', 'url' => ['/course'],] : []),
                            ['label' => 'Categorías', 'icon' => 'fa fa-tags', 'url' => ['/category'],],
                            ['label' => 'Cronograma', 'icon' => 'fa fa-calendar', 'url' => ['/schedule'],],
                        ],
                    ],

                    // Listas
                    [
                        'label' => 'Listas',
                        'icon' => 'fa fa-list',
                        'url' => '#',
                        'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => 'Inscritos', 'icon' => 'fa fa-list-ul', 'url' => ['/registered'],],
                            ['label' => 'Preinscritos', 'icon' => 'fa fa-list-ul', 'url' => ['/preregistered'],],
                            ['label' => 'Pagos', 'icon' => 'fa fa-money', 'url' => ['/payment'],],
                            ['label' => 'Interesados', 'icon' => 'fa fa-list-ul', 'url' => ['/interest-list'],],
                        ],
                    ],
                    [
                        'label' => 'Herramientas',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            ['label' => 'Backups', 'icon' => 'fa fa-dashboard', 'url' => ['/backup'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
