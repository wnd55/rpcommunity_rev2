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
            'created_at:date',
            'updated_at:date',
            'created_by',
            'updated_by',
        ]
    ])
    ?>

</div>



