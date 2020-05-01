<?php


use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use \common\models\User;

/* @var $this yii\web\View */
/* @var $searchAuthItem backend\modules\rbac\forms\RoleSearch */
/* @var $providerAuthItem yii\data\ActiveDataProvider */
/* @var $providerItemChildren \backend\modules\rbac\entities\AuthItemChild */
/* @var $searchItemChildren backend\modules\rbac\forms\ItemChildrenSearch */
/* @var $providerAuthAssignments \backend\modules\rbac\entities\AuthAssignment */
/* @var $searchAuthAssignments backend\modules\rbac\forms\AuthAssignmentsSearch */

$this->title = 'Роли';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-index">

    <p>
        <?= Html::a('Создать роль', ['/rbac/default/create-role'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Создать разрешение', ['/rbac/default/create-permission'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">

            <?= GridView::widget([
                'dataProvider' => $providerAuthItem,
                'filterModel' => $searchAuthItem,
                'rowOptions' => function ($model, $index, $widget, $grid) {

                    return [
                        'style' => 'cursor:pointer',
                        'onclick' => 'location.href="' . Yii::$app->urlManager->createUrl(['/rbac/default/view-role', 'name' => $model->name]) . '"'
                    ];
                },
                'columns' => [
                    'name',
                    'type',
                    'description',
                    'rule_name',
                    'data',
                    'created_at:date',
                    'updated_at:date',

                    [
                        'class' => ActionColumn::class,
                        'template' => '{view}{update}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url = Yii::$app->urlManager->createUrl(['/rbac/default/view-role', 'name' => $model->name]);
                                return $url;
                            }

                            if ($action === 'update') {
                                $url = Yii::$app->urlManager->createUrl(['/rbac/default/update-role', 'name' => $model->name]);
                                return $url;
                            }

                        }

                    ],
                ]
            ]);

            ?>

        </div>
    </div>
</div>

<hr>
<div class="user-index">

    <p>
        <?= Html::a('Создать иерархию', ['/rbac/default/create-item-children'], ['class' => 'btn btn-success']) ?>

    </p>
    <div class="box">
        <div class="box-body">

            <?= GridView::widget([
                'dataProvider' => $providerItemChildren,
                'filterModel' => $searchItemChildren,
                'rowOptions' => function ($model, $index, $widget, $grid) {
                    return [
                        'style' => 'cursor:pointer',
                    ];
                },
                'columns' => [
                    'parent',
                    'child',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {

                            if ($action === 'delete') {
                                $url = Yii::$app->urlManager->createUrl(['/rbac/default/delete-item-children', 'parent' => $model->parent, 'child' => $model->child, 'method' => 'post']);

                                return $url;
                            }

                        }

                    ],
                ]
            ]);

            ?>

        </div>
    </div>
</div>
<hr>
<div class="user-index">

    <p>
        <?= Html::a('Назначить роль', ['/rbac/default/create-auth-assignment'], ['class' => 'btn btn-success']) ?>

    </p>
    <div class="box">
        <div class="box-body">

            <?= GridView::widget([
                'dataProvider' => $providerAuthAssignments,
                 'filterModel' => $searchAuthAssignments,
                'rowOptions' => function ($model, $index, $widget, $grid) {
                    return [
                        'style' => 'cursor:pointer',
                    ];
                },
                'columns' => [

                    [
                        'attribute' => 'item_name',
                        'value'=>'item_name',
                        'filter'=> $searchAuthAssignments->getFilterAuthItems(),
                        'format' => 'raw',
                    ],
                    'user_id',

                    [
                        'attribute' => 'email',
                        'label' => 'Логин&Email',
                        'value' => function ($model){

                            $user = User::find()->where(['id' => $model->user_id])->one();
                                if(isset($user)) {
                                    return $user->username . ' <---> ' . $user->email;
                                }else{

                                    return null;
                                }
                        }
                    ],
                     'created_at:date',
                    [
                        'class' => ActionColumn::class,
                        'template' => '{delete}',
                        'urlCreator' => function ($action, $model, $key, $index) {

                            if ($action === 'delete') {
                                $url = Yii::$app->urlManager->createUrl(['/rbac/default/delete-auth-assignment', 'item_name' => $model->item_name, 'userId'=> $model->user_id, 'method' => 'post']);

                                return $url;
                            }

                        }

                    ],


                ]
            ]);

            ?>

        </div>
    </div>
</div>
