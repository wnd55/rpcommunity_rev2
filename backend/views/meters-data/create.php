<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MetersData */

$this->title = 'Create MetersData';
$this->params['breadcrumbs'][] = ['label' => 'Metersdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metersdata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
