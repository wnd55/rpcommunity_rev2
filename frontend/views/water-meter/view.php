<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WaterMeter*/

$this->title = 'Счётчики воды '.$model->wmcold .' '. $model->wmhot;
$this->params['breadcrumbs'][] = ['label' => 'Счётчики воды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->idwatermeter], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idwatermeter], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' =>'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'wmcold',
            'wmhot',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->user->email;
                },

            ],
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return $model->user->email;
                },

            ],

        ],
    ]) ?>

</div>
