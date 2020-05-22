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
    'rowOptions' => function ($model, $key, $index, $grid) {
        return [
            'onclick' => 'location.href="'
                . Url::to(['/profile/view', 'id' => $key,]) . '"',
            'onmouseenter' => "style='background-color:#dedede; cursor: pointer;'",
            'onmouseleave' => "style='background-color:'",
        ];
    },
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
        [
            'attribute' => 'role',
            'label' => 'Роль',
            'value'=> 'user.authAssignment.item_name',


        ],
        'created_at:date',
        'updated_at:date',

        [
            'class' => ActionColumn::class,
            'template' => '{view}{update}',


        ],

    ]

])


?>

