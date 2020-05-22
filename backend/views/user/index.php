<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\widgets\grid\RoleColumn;
use backend\helpers\UserHelper;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearchForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $sort \yii\data\Sort */

$this->title = 'Регистрации';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/users.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-10">

        <?= Html::button('Удалить', ['id' => 'btnDelete',
            'class' => 'btn btn-danger type-hidden',]) ?>
    </div>

    <div class="col-md-2">

        <label>Показывать:</label>
        <select id="input-limit" onchange="location = this.value;" aria-label="Показывать:">
            <?php
            $values = [15, 20, 50, 75, 100];
            $current = $dataProvider->getPagination()->getPageSize();
            ?>
            <?php foreach ($values as $value): ?>
                <option value="<?= Html::encode(Url::current(['per-page' => $value])) ?>"
                        <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
            <?php endforeach; ?>
        </select>

    </div>

    <div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn'],
                'id',
                'username',
                'email:email',
                [
                    'attribute' => 'status',
                    'filter' => UserHelper::statusList(),
                    'value' => function ($model) {
                        return UserHelper::statusLabel($model->status);
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'role',
                    'label' => 'Роль',
                    'class' => RoleColumn::class,
                    'filter' => $searchModel->rolesList(),
                    'format'    => 'raw',
                ],
                [
                    'attribute' => 'profile',
                    'label' => 'Аккунт',
                    'value' => function ($model) {
                        if (isset($model->profile)) {
                            return $model->profile->account;

                        }
                    },

                    'filter' => $searchModel->getProfileFilter()
                ],


                'created_at:date',
                'updated_at:date',

                [
                    'class' => ActionColumn::class,
                    'template' => '{view}{update}',
                    'visibleButtons' =>[

                        'update' => \Yii::$app->user->can('dashboardAdmin'),
                    ]



                ],
            ],
        ]);

        ?>


    </div>
</div>
