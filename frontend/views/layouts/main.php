<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Контакт', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {

        $menuItems[] = [
            'label' => 'Документы ТСЖ', 'url' => ['site/documents'],
            'items' => [
                ['label' => 'Учредительные документы', 'url' => ['site/documents' . '#constituent']],
                ['label' => 'Устав', 'url' => ['site/documents' . '#articles']],
                ['label' => 'Правила проживания', 'url' => ['site/documents' . '#rules']],
            ],
        ];

        $menuItems[] = [
            'label' => 'Личный кабинет',
            'items' => [
                ['label' => 'Профиль', 'url' => ['/profile/index'],],
                ['label' => 'Счетчики воды', 'url' => ['/water-meter/index'],],
                ['label' => 'Показания воды', 'url' => ['/meters-data/index'],],
            ],
        ];

        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <nav class="amp-navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/admin">ТСЖ Рублевское Предместье 4/1</a>
            </div>
            <div class="menu-toggle">
                <h3><?=Yii::$app->name?></h3>
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul id="ampMenu" class="amp-responsive-menu" data-menu-style="horizontal">
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                        <span class="title">About Us</span>

                    </a>
                    <!-- Level Two-->
                    <ul>
                        <li>
                            <a href="#">Sub Item One</a>
                        </li>
                        <li>
                            <a href="#">Sub Item Two</a>
                        </li>
                        <li>
                            <a href="#">Sub Item Three</a>
                        </li>
                        <li>
                            <a href="#">Sub Item Four</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="fa fa-crop" aria-hidden="true"></i>
                        <span class="title">4 Level Menu</span>
                    </a>
                    <!-- Level Two-->
                    <ul>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                Sub Item One
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                Sub Item Two
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-amazon" aria-hidden="true"></i>
                                Sub Item Three
                            </a>
                            <!-- Level Three-->
                            <ul>
                                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Sub Item Link 1</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-diamond" aria-hidden="true"></i>Sub Item Link 2</a>
                                    <!-- Level Four-->
                                    <ul>
                                        <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i>Sub Item Link 1</a></li>
                                        <li><a href="#"><i class="fa fa-dashcube" aria-hidden="true"></i>Sub Item Link 2</a></li>
                                        <li><a href="#"><i class="fa fa-dropbox" aria-hidden="true"></i>Sub Item Link 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Sub Item Link 3</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                Sub Item Four
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="" href="javascript:;">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span class="title">Services</span>

                    </a>
                    <ul>
                        <li>
                            <a href="#">Sub Item One
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">Sub Item Two
                            </a>
                            <ul>
                                <li><a href="#">Sub Item Link 1</a></li>
                                <li><a href="#">Sub Item Link 2</a></li>
                                <li><a href="#">Sub Item Link 3</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;">Sub Item Three
                            </a>
                            <ul>
                                <li><a href="#">Sub Item Link 1</a></li>
                                <li><a href="#">Sub Item Link 1</a></li>
                                <li><a href="#">Sub Item Link 1</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Sub Item Four
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span class="title">Contact Us</span>
                    </a>
                </li>


                <li class="last ">
                    <a href="#">
                        <i class="fa fa-envelope"></i>
                        <span class="title">
                        <?= Html::beginForm(['/site/logout'], 'post'); ?>
<!--                        --><?//= Html::submitButton('Выход (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']); ?>
                        <?= Html::endForm(); ?>
                    </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
