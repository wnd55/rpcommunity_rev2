<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AddressSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Адрес';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать адрес', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сбросить поиск', [Url::to('index')], ['class' => 'btn btn-default']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idaddress',
            'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
