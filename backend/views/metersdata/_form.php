<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Metersdata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="metersdata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'watermeter_id')->textInput() ?>

    <?= $form->field($model, 'cold1')->textInput() ?>

    <?= $form->field($model, 'wmcold2')->textInput() ?>

    <?= $form->field($model, 'cold2')->textInput() ?>

    <?= $form->field($model, 'wmcold3')->textInput() ?>

    <?= $form->field($model, 'cold3')->textInput() ?>

    <?= $form->field($model, 'wmhot1')->textInput() ?>

    <?= $form->field($model, 'hot1')->textInput() ?>

    <?= $form->field($model, 'wmhot2')->textInput() ?>

    <?= $form->field($model, 'hot2')->textInput() ?>

    <?= $form->field($model, 'wmhot3')->textInput() ?>

    <?= $form->field($model, 'hot3')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
