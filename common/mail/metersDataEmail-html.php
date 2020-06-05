<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11.12.18
 * Time: 21:57
 */

/* @var $this yii\web\View */
/* @var $model  \common\models\MetersData */

use yii\helpers\Html;

?>
<div>

    <p>Здравствуйте,</p>
    <p></p>
    <p>Показания воды:</p>
    <hr>
    <p>Показания холодной воды:</p>
    <p></p>
    <p><?= Html::encode($model->watermeter_id) ?> - <?= Html::encode($model->cold1) ?></p>
    <p><?= Html::encode($model->wmcold2) ?> - <?= Html::encode($model->cold2) ?></p>
    <p><?= Html::encode($model->wmcold3) ?> - <?= Html::encode($model->cold3) ?></p>
    <hr>
    <p>Показания горячей воды:</p>
    <p></p>
    <p><?= Html::encode($model->wmhot1) ?> - <?= Html::encode($model->hot1) ?></p>
    <p><?= Html::encode($model->wmhot2) ?> - <?= Html::encode($model->hot2) ?></p>
    <p><?= Html::encode($model->wmhot3) ?> - <?= Html::encode($model->hot3) ?></p>
    <hr>
    <p>Дата создания:</p>
    <p><?= Html::encode($model->date) ?></p>

    <p></p>


</div>