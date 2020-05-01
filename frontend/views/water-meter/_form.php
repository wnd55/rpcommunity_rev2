<?php

use yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WaterMeter */
/* @var $form yii\widgets\ActiveForm */
?>

<div>
    <?php $form = ActiveForm::begin(['id' => 'watermeter-form',]) ?>

    <?= $form->field($model, 'wmcold', ['enableAjaxValidation' => true])->textInput(); ?>
    <?= $form->field($model, 'wmhot', ['enableAjaxValidation' => true])->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>