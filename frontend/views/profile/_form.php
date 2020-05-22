<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\helpers\UserHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileCreateForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">
    <div class="row">
        <div class="box">
            <?php $form = ActiveForm::begin(); ?>
            <div class="box-section">

                <div class="col-md-6">
                    <?= $form->field($model, 'account')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'apartment')->textInput(); ?>
                </div>
            </div>

            <div class="box-section">
                <div class="col-md-6">
                    <?= $form->field($model, 'homeowners_id')->dropDownList($model->getHomeownersList(), ['prompt' => 'Выбрать']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'address_id')->dropDownList($model->getAddressList(), ['prompt' => 'Выбрать']) ?>
                </div>
            </div>
            <div class="box-section-last">
                <div class="col-md-4">
                    <?= $form->field($model, 'surname')->textInput(); ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'name')->textInput(); ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'patronymic')->textInput(); ?>
                </div>
            </div>
            <div class="col-md-12">
                <?php if (Yii::$app->user->can('dashboardAdmin')): ?>
                    <?= $form->field($model, 'check1')->checkbox(); ?>
                    <?= $form->field($model, 'check2')->checkbox(); ?>
                <?php endif; ?>
            </div>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>