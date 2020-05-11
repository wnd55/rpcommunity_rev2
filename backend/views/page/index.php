<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Pages;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagesSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'value' => function (Pages $model) {
                    $indent = ($model->depth > 1 ? str_repeat('-->', $model->depth - 1) . ' ' : '');
                    return $indent . Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'value' => function (Pages $model) {
                    return
                        Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $model->id]) .
                        Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $model->id]);
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'text-align: center'],
            ],
            'slug',

            'lft',
            'rgt',
            'depth',
            'created_at:date',
            'updated_at:date',
            'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
