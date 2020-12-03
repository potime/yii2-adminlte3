<?php

/* @var $directoryAsset string */

use potime\adminlte3\widgets\Menu;
use yii\helpers\Url;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link">
        <img src="<?= $directoryAsset ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?= Menu::widget([
                'options' => [
                    'class' => 'nav nav-pills nav-sidebar flex-column nav-child-indent',
                    'data-widget' => 'treeview',
                    'role' => 'menu',
                    'data-accordion' => 'false'
                ],
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'tachometer-alt',
                        'items' => [
                            ['label' => 'Home', 'url' => ['site/index'], 'iconType' => 'far'],
                            ['label' => 'About', 'url' => ['site/about'], 'iconType' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'YII Tools',
                        'icon' => 'share',
                        'badge' => ['message' => 'New', 'badgeType' => 'danger'],
                        'items' => [
                            ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Gii', 'url' => ['/gii'], 'icon' => 'file-code', 'target' => '_blank'],
                            ['label' => 'Debug', 'url' => ['/debug'], 'icon' => 'bug', 'target' => '_blank', 'badge' => ['badgeType' => 'warning', 'message' => 2]],
                        ]
                    ],

                    ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    ['label' => 'Level1'],
                    [
                        'label' => 'Level1',
                        'items' => [
                            ['label' => 'Level2', 'iconType' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconType' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconType' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconType' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconType' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconType' => 'far']
                        ]
                    ],
                    ['label' => 'Level1'],

                    ['label' => 'LABELS', 'header' => true],
                    ['label' => 'Important', 'iconType' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => 'Informational', 'iconType' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>