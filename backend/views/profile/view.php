<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

$this->title = $model->idprofile;
$this->params['breadcrumbs'][] = ['label' => 'Профили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->idprofile], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idprofile], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот профиль?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idprofile',

            [
                'attribute' => 'surname',
                'label' => 'ФИО',
                'value' => function ($model) {

                    return $model->surname . ' ' . $model->name . ' ' . $model->patronymic;
                }
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Email',
                'value' => function ($model) {

                    return $model->user->email;
                }
            ],
            'account',
            [
                'attribute' => 'homeowners_id',
                'label' => 'ТСЖ',
                'value' => function ($model) {

                    return $model->homeowners->homeowners;
                },

            ],

            [
                'attribute' => 'address_id',
                'label' => 'Адрес',
                'value' => function ($model) {

                    return $model->address->address;
                },


            ],
            'created_at:date',
            'updated_at:date',


            'check1',
            'check2',

            [

                'label' => 'Создано',
                'value' => function ($model) {

                    return $model->user->email;
                }
            ],

            [

                'label' => 'Изменено',
                'value' => function ($model) {

                    return $model->user->email;
                }
            ],

        ],
    ]) ?>

</div>
