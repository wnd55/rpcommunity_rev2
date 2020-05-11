<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Логи', 'url' => ['logs']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Удалить', ['/site/delete-log', 'id' => $model->id], [
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
            'level',
            'category',
            'log_time:date',
            'prefix',
            'message',
        ],
    ]) ?>

</div>
