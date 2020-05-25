<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoriesPages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categories-pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'slug',
            'content:ntext',
            [
                'attribute' => 'content',
                'value' => function ($model) {

                    return StringHelper::truncate($model->content, 20);
                }

            ],
            'parent',
            'status:boolean',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'created_at:date',
            'updated_at:date',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
