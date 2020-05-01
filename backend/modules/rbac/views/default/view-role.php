<?php
use shop\helpers\UserHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\rbac\Item;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\entities\AuthItem */

$this->title = 'Изменить роль: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Роли', 'url' => ['role']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view-role', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-view">

    <p>
        <?= Html::a('Изменить', ['update-role', 'name' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-role', 'name' => $model->name], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]) ?>
</p>

<div class="box">
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'type',
                'description',
                'rule_name',
                'data',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
</div>