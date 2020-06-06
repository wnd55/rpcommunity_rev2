<?php

use \yii\helpers\Html;
use \frontend\widgets\pages\PagesWidget;

/* @var $this yii\web\View */

$this->title = 'Сайт ТСЖ "Рублевское предместье 4/1';
$this->registerMetaTag(['name' => 'title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'description', 'content' => 'Офицальный сайт ТСЖ "Рублёвское предместье 4/1".
Новостная информация для жителей дома, личный кабинет жильца. Информация о расходах воды в личном кабинете']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->title]);

?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Рублевское предместье</h2>
        <p class="lead">Сайт ТСЖ "Рублевское предместье 4/1"</p>

    </div>

    <div class="body-content">

        <div class="container">
            <div class="row">

                <div class="col-lg-4 main ">


                    <?= Html::img('@web/uploads/files/user.png', ['class' => 'img-responsive']) ?>
                    <div class="rp-box-shadow">
                        <h3>Регистрация</h3>

                        <p>Зарегистрируйтесь на сайте и
                            воспользуйтесь личным кабинетом</p>
                    </div>

                </div>


                <div class="col-lg-4 main">

                    <?= Html::img('@web/uploads/files/info-circle.png', ['class' => 'img-responsive']) ?>
                    <div class="rp-box-shadow">
                        <h3>Новости</h3>

                        <p>Узнайте новости нашего поселка
                            и ТСЖ</p>
                    </div>

                </div>

                <div class="col-lg-4 main">

                    <?= Html::img('@web/uploads/files/waterdrop.png', ['class' => 'img-responsive']) ?>

                    <div class="rp-box-shadow">
                        <h3>Информация</h3>

                        <p>В личном кабинете вы можете предавать информацию о расходах воды в электоронном виде</p>


                    </div>
                </div>

            </div>
            <div class="pages-chat">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="pages">
                            <?= PagesWidget::widget() ?>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h4>Чат</h4>
                        Имя:<br/>

                        <?= Html::input('text', null, null, ['id' => 'username']) ?>
                        <?= Html::button('Ваше имя', ['id' => 'btnSetUsername']) ?>
                        <div id="chat">
                            <?php if (isset($chat)): ?>
                                <?= $this->render('_chat', [
                                    'chat' => $chat,
                                ]) ?>
                            <?php endif; ?>
                        </div>

                        Сообщение:<br/>

                        <?= Html::input('text', null, null, ['id' => 'message']) ?>
                        <div>
                            <?= Html::button('Отправить', ['id' => 'btnSend']) ?>
                            <?= Html::button('Удалить', ['id' => 'btnClean',]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
