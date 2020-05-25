<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\grid\ActionColumn;
use \yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $logsSearch backend\models\LogsSearchForm */

$this->title = 'Логи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-logs">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

        <?= Html::a('Удалить все логи', ['/site/delete-all-logs'],[
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить все логи?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' =>$logsSearch,
        'columns' =>[

            ['class' => 'yii\grid\SerialColumn'],
            'id',
           [
                   'attribute' => 'level',
                   'value'=> function($model){

                        if($model->level === 1){

                            return 'error';
                        }
                   }
           ],
            'category',
            'log_time:date',
            'prefix',

            [
                'attribute' => 'message',
                'value' => function ($model) {

                    return StringHelper::truncate($model->message, 100);
                }

            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}{delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = Yii::$app->urlManager->createUrl(['/site/view-log', 'id' => $model->id]);
                        return $url;
                    }

                    if ($action === 'delete') {
                        $url = Yii::$app->urlManager->createUrl(['/site/delete-log', 'id' => $model->id]);
                        return $url;
                    }

                }

            ],

        ]
        ])?>


</div>

