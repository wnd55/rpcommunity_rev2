<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */
$this->title = 'Счётчики воды';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Добавить счётчик воды', ['create'], ['class' => 'btn btn-primary',]) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $provider,
    'rowOptions' => function ($model, $key, $index, $grid) {
        return [

            'style' => "cursor: pointer",
            'onclick' => 'location.href="'
                . Url::to(['/water-meter/view', 'id' => $key,]) . '"',
        ];
    },
    'columns' =>
        [
            [
                'attribute' => 'wmcold',
                'contentOptions' => ['style' => 'background-color:#0027ff14'],
            ],

            [
                'attribute' => 'wmhot',
                'contentOptions' => ['style' => 'background-color:#FFA39229'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ]


])

?>


