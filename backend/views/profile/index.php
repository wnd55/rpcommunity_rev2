<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */
/* @var $profileSearch \backend\models\ProfileSearchForm */


$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Создать профиль', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Сбросить поиск', [Url::to('index')], ['class' => 'btn btn-default']) ?>

</p>
<?= GridView::widget([

    'dataProvider' => $provider,
    'filterModel' => $profileSearch,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
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
            'filter' => $profileSearch->getHomeownersFilter(),
        ],

        [
            'attribute' => 'address_id',
            'label' => 'Адрес',
            'value' => function ($model) {

                return $model->address->address;
            },
            'filter' => $profileSearch->getAddressFilter(),

        ],
        'apartment',
        'created_at:date',
        'updated_at:date',
        'created_by',
        'updated_by',

        [
            'class' => ActionColumn::class,
            'template' => '{view}{update}',


        ],

    ]

])


?>

