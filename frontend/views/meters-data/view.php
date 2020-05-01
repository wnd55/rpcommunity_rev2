<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  frontend\widgets\grid\MetersDataDetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MetersData */

$this->title = 'Показание воды';
$this->params['breadcrumbs'][] = ['label' => 'Показание воды', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->idmetersdata], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idmetersdata], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Переслать на email', ['/meters-data/meters-data-email', 'id' => $model->idmetersdata], [
            'class' => 'btn btn-info',]) ?>


    </p>
    <?= MetersDataDetailView::widget([
        'model' => $model,
        'attributes' => [
            'watermeter_id',
            'cold1',
            'wmcold2',
            'cold2',
            'wmcold3',
            'cold3',
            'wmhot1',
            'hot1',
            'wmhot2',
            'hot2',
            'wmhot3',
            'hot3',
            'date:date',
        ]
    ])
    ?>

</div>

