<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\forms\AuthAssignmentForm */


$this->title = 'Назначить роль пользователю';
$this->params['breadcrumbs'][] = ['label' => 'Роли', 'url' => ['role']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">


    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'role')->dropDownList($model->getRole())->label('Выбрать роль'); ?>
    <?= $form->field($model, 'userId')->dropDownList($model->getUser())->label('Выбрать email'); ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>