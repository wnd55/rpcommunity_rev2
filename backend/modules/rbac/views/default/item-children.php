<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rbac\forms\RoleSearch */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Разрешения';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="user-index">

    <div class="box">
        <div class="box-body">

            <?= GridView::widget([
                'dataProvider' => $providerItemChildren,
                'filterModel' => $searchItemChildren,
                'rowOptions'   => function ($model, $index, $widget, $grid) {

                    return [
                        'style' => 'cursor:pointer',
                        'onclick' => 'location.href="' . Yii::$app->urlManager->createUrl(['role/view-role', 'name' => $model->name]). '"'
                    ];
                },
                'columns' => [
                    'parent',
                    'child',


//                    ['class' => ActionColumn::class],
                ]
            ]);

            ?>

        </div>
    </div>
</div>
