<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use \yii\jui\DatePicker;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \frontend\models\MetersDataSearchForm */
/** @var $counters */

$this->title = 'Показания воды';
$this->params['breadcrumbs'][] = ['label' => 'Показание воды', 'url' => 'index'];

$from_date = isset(Yii::$app->request->getQueryParam('MetersDataSearchForm')['from_date']) ? Yii::$app->request->getQueryParam('MetersDataSearchForm')['from_date'] : null;
$to_date = isset(Yii::$app->request->getQueryParam('MetersDataSearchForm')['to_date']) ? Yii::$app->request->getQueryParam('MetersDataSearchForm')['to_date'] : null;

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сохранить все данные в Excel', ['export-excel'], ['class' => 'btn btn-default']) ?>
    </p>

    <hr>
<?php $form = ActiveForm::begin(['action' => 'index', 'method' => 'get']); ?>
    <div class="row">
        <h4>Поиск по дате</h4>

        <div class="col-md-3">
            <?= $form->field($searchModel, 'from_date')->widget(DatePicker::class, ['language' => 'ru', 'dateFormat' => 'php:Y/m/d'])->label('Дата с') ?>
        </div>
        <div class="col-md-3">

            <?= $form->field($searchModel, 'to_date')->widget(DatePicker::class, ['language' => 'ru', 'dateFormat' => 'php:Y/m/d'])->label('Дата по') ?>
        </div>

        <?php if (isset($from_date) && isset($to_date)) : ?>
            <div class="col-md-3">
                <?= Html::a('Сохранить в Excel результат поиска', ['search-export-excel', 'from_date' => $from_date, 'to_date' => $to_date], ['class' => 'btn btn-default']) ?>
            </div>
        <?php endif; ?>
        <div class="col-md-3">
            <div class="form-group">
                <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
                <?= Html::a("Сбросить", Url::toRoute(['/meters-data/index']), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>
    <hr>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions' => function ($model, $key, $index, $grid) {
        return [
            'onclick' => 'location.href="'
                . Url::to(['/meters-data/view', 'id' => $key,]) . '"',
            'onmouseenter' => "style='background-color:#dedede; cursor: pointer;'",
            'onmouseleave' => "style='background-color:'",
        ];
    },

    'columns' =>
        [

            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'watermeter_id',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],
            ],
            'cold1',

            [
                'attribute' => 'wmcold2',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],
            ],
            'cold2',
            [

                'attribute' => 'wmcold3',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],


            ],

            [
                'attribute' => 'cold3',

            ],

            [
                'attribute' => 'wmhot1',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],
            ],
            'hot1',

            [
                'attribute' => 'wmhot2',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],
            ],
            'hot2',
            [
                'attribute' => 'wmhot3',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],


            ],
            [
                'attribute' => 'hot3',

            ],

            'date:date',


        ],


]);


?>