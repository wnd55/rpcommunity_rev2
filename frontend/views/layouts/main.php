<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

use \frontend\widgets\menu\MenuWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="amp-navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">ТСЖ Рублевское Предместье 4/1</a>
            </div>
            <div class="menu-toggle">
                <h3><?= Yii::$app->name ?></h3>
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul id="ampMenu" class="amp-responsive-menu" data-menu-style="horizontal">

                <li>
                    <a href="#">
                        <i class="fa fa-info" aria-hidden="true"></i>
                        <span class="title">Информация</span>

                    </a>

                    <?= MenuWidget::widget() ?>

                </li>
                <li>
                    <a href= <?= Url::toRoute('/site/contact') ?>>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span class="title">Контакты</span>
                    </a>

                </li>
                <?php if (Yii::$app->user->isGuest): ?>

                    <li>
                        <a href= <?= Url::toRoute('/site/signup') ?>>
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <span class="title">Регистрация</span>
                        </a>

                    </li>

                    <li>
                        <a href= <?= Url::toRoute('/site/login') ?>>
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <span class="title">Вход</span>
                        </a>

                    </li>

                <?php else: ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="title">Аккаунт</span>
                        </a>

                        <ul>
                            <li>
                                <?= Html::a('Профиль', Url::toRoute('/profile/view')) ?>
                            </li>
                            <li>
                                <?= Html::a('Счётчики воды', Url::toRoute('/water-meter')) ?>
                            </li>
                            <li>
                                <?= Html::a('Показания воды', Url::toRoute('/meters-data/index')) ?>
                            </li>

                        </ul>

                    </li>

                    <li>
                        <a href= <?= Url::toRoute('/site/documents') ?>>
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            <span class="title">Документы</span>
                        </a>

                    </li>


                    <li class="last ">
                        <a href="#">
                            <i class="fa fa-key"></i>
                            <span class="title">
                        <?= Html::beginForm(['/site/logout'], 'post'); ?>
                        <?= Html::submitButton('Выход (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']); ?>
                        <?= Html::endForm(); ?>
                    </span>
                        </a>
                    </li>

                <?php endif; ?>


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
