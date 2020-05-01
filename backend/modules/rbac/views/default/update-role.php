<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\forms\RoleEditForm */
/* @var $role backend\modules\rbac\entities\AuthItem */

$this->title = 'Изменить роль: ' . $role->name;
$this->params['breadcrumbs'][] = ['label' => 'Роли', 'url' => ['role']];
$this->params['breadcrumbs'][] = ['label' => $role->name, 'url' => ['view-role', 'name' => $role->name]];
$this->params['breadcrumbs'][] = 'Изменить';

?>



<div class="user-create">

    <?= Html::textInput('name', $role->name, ['class' => 'form-control', 'readonly' => true, 'style' => 'cursor: not-allowed']) ?>
    <p>Вид</p>
    <?= Html::textInput('type',$role->type, ['class' => 'form-control', 'readonly' => true, 'style' => 'cursor: not-allowed']) ?>
<hr>
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'data')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

