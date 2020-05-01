<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**@var $this \yii\web\View */
/**@var $model common\models\MetersData */
/**@var $form yii\widgets\ActiveForm */


?>

<div>
<div>
    <?php $form = ActiveForm::begin(['id' => 'metersData']) ?>
    <div class="col-md-6">

        <?= $form->field($model, 'watermeter_id')->textInput() ?>
        <?= $form->field($model, 'cold1')->textInput() ?>
        <?= $form->field($model, 'wmcold2')->textInput() ?>
        <?= $form->field($model, 'cold2')->textInput() ?>
        <?php if ($model->twoCounters !== true): ?>
            <?= $form->field($model, 'wmcold3')->textInput() ?>
            <?= $form->field($model, 'cold3')->textInput() ?>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'wmhot1')->textInput() ?>
        <?= $form->field($model, 'hot1')->textInput() ?>
        <?= $form->field($model, 'wmhot2')->textInput() ?>
        <?= $form->field($model, 'hot2')->textInput() ?>
        <?php if ($model->twoCounters !== true): ?>
            <?= $form->field($model, 'wmhot3')->textInput() ?>
            <?= $form->field($model, 'hot3')->textInput() ?>
        <?php endif; ?>

    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>

</div>

<?= print_r($model->errors) ?>