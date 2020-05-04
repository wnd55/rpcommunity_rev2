<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homeowners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="homeowners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'homeowners')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
