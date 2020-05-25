<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryPagesSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории страниц';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-pages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать категорию страниц', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'slug',
            'parent',
            'status:boolean',
            'created_at:date',
            'updated_at:date',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
