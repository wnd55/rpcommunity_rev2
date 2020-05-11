<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MetersdataSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Показания воды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metersdata-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Metersdata', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idmetersdata',
          //  'user_id',
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
           // 'date',
            'created_at:date',
            //'updated_at:date',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
