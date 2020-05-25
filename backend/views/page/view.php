<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pages-view">

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

            [
                'attribute' => 'content',
                'value' => function ($model) {

                    return StringHelper::truncate($model->content, 20);
                }

            ],
            'status:boolean',
            [
                'attribute' => 'categories_pages_id',
                'value' => function ($model) {

                    return isset($model->categoriesPages->title) ? $model->categoriesPages->title : 'Нет';
                }

            ],
            'lft',
            'rgt',
            'depth',
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
