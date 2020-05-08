<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use \yii\helpers\Url;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
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
    <nav class="amp-navbar-fixed-top">
        <div class="container">

            <div class="navbar-header">
                <a class="navbar-brand" href="<?= Url::toRoute('/') ?>">Администратор</a>
            </div>


            <div class="menu-toggle">
                <h3 class=""><?= Html::a(Yii::$app->name, Url::home()) ?></h3>
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="">
                <ul id="ampMenu" class="amp-responsive-menu" data-menu-style="horizontal">

                    <li>
                        <a href=<?= Url::toRoute('/profile') ?>>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="title">Клиенты</span>

                        </a>
                        <!-- Level Two-->
                        <ul>
                            <li>
                                <?= Html::a('Профили', Url::toRoute('/profile')) ?>
                            </li>
                            <li>
                                <?= Html::a('Адрес', Url::toRoute('/address')) ?>
                            </li>
                            <li>
                                <?= Html::a('ТСЖ', Url::toRoute('/homeowner')) ?>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-crop" aria-hidden="true"></i>
                            <span class="title">Показания воды</span>
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
                                    <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Sub Item Link 1</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-diamond" aria-hidden="true"></i>Sub Item Link 2</a>
                                        <!-- Level Four-->
                                        <ul>
                                            <li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i>Sub Item Link
                                                    1</a></li>
                                            <li><a href="#"><i class="fa fa-dashcube" aria-hidden="true"></i>Sub Item
                                                    Link 2</a></li>
                                            <li><a href="#"><i class="fa fa-dropbox" aria-hidden="true"></i>Sub Item
                                                    Link 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Sub Item Link 3</a>
                                    </li>
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
                        <a class="" href="#">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <span class="title">Администратор</span>

                        </a>
                        <ul>
                            <li>
                                <?= Html::a('Роли', Url::toRoute('/rbac/default/role')) ?>


                            </li>
                            <li>
                                <?= Html::a('Регистрации', Url::toRoute('/user')) ?>
                            </li>

                            <li>
                                <?= Html::a('Настройки', Url::toRoute('/site/host-settings')) ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="title">Категории</span>
                        </a>
                        <ul>

                            <li>
                                <?= Html::a('Страницы', Url::toRoute('/page')) ?>
                            </li>

                            <li>
                                <?= Html::a('Категории страниц', Url::toRoute('/category-pages')) ?>
                            </li>
                            <li>
                                <?= Html::a('Меню', Url::toRoute('/menu')) ?>
                            </li>
                        </ul>
                    </li>

                    <li class="last ">
                        <a href="#">
                            <i class="fa fa-envelope"></i>
                            <span class="title">
                        <?= Html::beginForm(['/site/logout'], 'post'); ?>
                        <?= Html::submitButton('Выход (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']); ?>
                        <?= Html::endForm(); ?>
                    </span>
                        </a>
                    </li>
                </ul>
            </div>
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
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#ampMenu").menu({
            resizeWidth: '768', // Set the same in Media query
            animationSpeed: 'fast', //slow, medium, fast
            accoridonExpAll: false //Expands all the accordion menu on click
        });
    });
</script>

</body>
</html>
<?php $this->endPage() ?>
