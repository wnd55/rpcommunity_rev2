<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\Homeowners */

$this->title = $model->idhomeowners;
$this->params['breadcrumbs'][] = ['label' => 'ТСЖ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>


<div class="homeowners-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->idhomeowners], ['class' => 'btn btn-primary',]) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idhomeowners], [

            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить ТСЖ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idhomeowners',
            'homeowners',
        ],
    ]) ?>

</div>
