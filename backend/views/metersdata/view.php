<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Metersdata */

$this->title = $model->idmetersdata;
$this->params['breadcrumbs'][] = ['label' => 'Metersdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="metersdata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idmetersdata], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idmetersdata], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idmetersdata',
            'user_id',
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
            'date',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
