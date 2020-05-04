<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Homeowners */

$this->title = 'ИзменитьТСЖ: ' . $model->idhomeowners;
$this->params['breadcrumbs'][] = ['label' => 'ТСЖ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idhomeowners, 'url' => ['view', 'id' => $model->idhomeowners]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="homeowners-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
