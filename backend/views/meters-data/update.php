<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MetersData */

$this->title = 'Update MetersData: ' . $model->idmetersdata;
$this->params['breadcrumbs'][] = ['label' => 'Metersdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmetersdata, 'url' => ['view', 'id' => $model->idmetersdata]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="metersdata-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
