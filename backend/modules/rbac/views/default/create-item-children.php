<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\forms\ItemChildrenForm */


$this->title = 'Создание связи';
$this->params['breadcrumbs'][] = ['label' => 'Роли', 'url' => ['role']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">


    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'parent')->dropDownList($model->getRole()); ?>
    <?= $form->field($model, 'child')->dropDownList($model->getRole()); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>