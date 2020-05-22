<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MetersDataSearchForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metersdata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmetersdata') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'watermeter_id') ?>

    <?= $form->field($model, 'cold1') ?>

    <?= $form->field($model, 'wmcold2') ?>

    <?php // echo $form->field($model, 'cold2') ?>

    <?php // echo $form->field($model, 'wmcold3') ?>

    <?php // echo $form->field($model, 'cold3') ?>

    <?php // echo $form->field($model, 'wmhot1') ?>

    <?php // echo $form->field($model, 'hot1') ?>

    <?php // echo $form->field($model, 'wmhot2') ?>

    <?php // echo $form->field($model, 'hot2') ?>

    <?php // echo $form->field($model, 'wmhot3') ?>

    <?php // echo $form->field($model, 'hot3') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
