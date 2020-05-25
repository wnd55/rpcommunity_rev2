<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  frontend\widgets\grid\MetersDataDetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MetersData */

$this->title = 'Показание воды';
$this->params['breadcrumbs'][] = ['label' => 'Показание воды', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div>


    <h1><?= Html::encode($this->title) ?></h1>

    <?= MetersDataDetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'account',
                'label' => 'Лицевой счет',
                'value' => function ($model) {

                    return $model->user->profile->account;
                }],
            [
                'attribute' => 'email',
                'label' => 'Email лицевой счёта',
                'value' => function ($model) {

                    return $model->user->email;

                }],

            [
                'attribute' => 'watermeter_id',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],

            ],
            'cold1',
            [
                'attribute' => 'wmcold2',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],
            ],
            'cold2',
            [
                'attribute' => 'wmcold3',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],

            ],
            'cold3',
            [
                'attribute' => 'wmhot1',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],
            ],
            'hot1',
            [
                'attribute' => 'wmhot2',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],
            ],
            'hot2',
            [
                'attribute' => 'wmhot3',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],

            ],
            'hot3',
            'date:date',
            'created_at:date',
            'updated_at:date',

            [
                'attribute' => 'created_by',

                'value' => function ($model) {

                    return $model->user->email;

                }],
            [
                'attribute' => 'updated_by',

                'value' => function ($model) {

                    return $model->user->email;

                }],
        ]
    ])
    ?>

</div>



