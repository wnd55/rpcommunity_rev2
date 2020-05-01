<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WaterMeter */

$this->title = 'Создание нового счётчика';
$this->params['breadcrumbs'][] = ['label' => 'Счётчики воды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>