<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\HomeownersSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ТСЖ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homeowners-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать ТСЖ', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сбросить поиск', [Url::to('index')], ['class' => 'btn btn-default']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idhomeowners',
            'homeowners',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
