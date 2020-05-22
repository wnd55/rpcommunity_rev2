<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <aside id="column-right" class="col-sm-3">
        <div class="list-group">
            <a href="<?= Html::encode(Url::to(['/site/contact'])) ?>" class="list-group-item">Контакты</a>

            <a href="<?= Html::encode(Url::to(['/site/request-password-reset'])) ?>" class="list-group-item">Изменение
                пароля</a>

        </div>
    </aside>
</div>

<?php


?>
<?php $this->endContent() ?>
