<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $hostSettings \backend\models\HostSettings */
/* @var $settings \backend\models\HostSettings */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="address-create">
    <h4>Добавить новую настройку</h4>
    <div class="box">

            <?php $form = ActiveForm::begin(); ?>
            <?php
            foreach ($hostSettings as $index => $setting) {
                echo $form->field($setting, "[$index]name")->label($setting->name);
                echo $form->field($setting, "[$index]value")->label($setting->value);
                echo $form->field($setting, "[$index]status")->checkbox();

            }
            ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <h4>Настройки</h4>
    <?php $formUpdate = ActiveForm::begin([
        'id' => 'formUpdate'
    ]); ?>
    <div class="table-responsive">
        <table class="table table-bordered" id="items">
            <thead>
            <tr style="background-color: rgba(42,0,49,0.33);">
                <th width="30%" class="text-left">Название</th>
                <th width="60%" class="text-left">Значение</th>
                <th width="5%" class="text-left">Статус</th>
                <th width="5%" class="text-left">Удалить</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($settings as $index => $setting): ?>

                <tr id="addItem">

                    <td class="text-left"><?= $form->field($setting, "[$index]name"); ?></td>
                    <td class="text-left"><?= $form->field($setting, "[$index]value"); ?></td>
                    <td class="text-center"><?= $form->field($setting, "[$index]status")->checkbox(); ?></td>
                    <td class="text-center"><?= Html::a('', ['delete-setting', 'id' => $setting->id], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить данную настройку?',
                                'method' => 'post',
                            ],
                        ]) ?></td>
                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
