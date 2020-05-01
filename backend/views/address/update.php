<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Address */

$this->title = 'Изменить адрес: ' . $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Адрес', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->address, 'url' => ['view', 'id' => $model->idaddress]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
