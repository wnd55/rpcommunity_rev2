<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\web\View;

/* @var $this yii\web\View */
/* @var $waterConsumption */
/* @var $model common\models\Profile */

$this->title = $model->idprofile;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
    '@web/js/chart.js',
    ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJs(
    "var waterConsumption = ".\yii\helpers\Json::htmlEncode($waterConsumption).";",
    View::POS_HEAD,
    'waterConsumption'
);

?>
<div class="profile-view">


    <p class="lead"><?=Html::encode($model->surname . ' ' . $model->name . ' ' . $model->patronymic)?></p>

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

    <br>
   <hr>
<h3>Диаграмма динамики расхода воды</h3>
    <br>
    <canvas id="chart1"></canvas>
    <canvas id="chart2"></canvas>
    <canvas id="chart3"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</div>
