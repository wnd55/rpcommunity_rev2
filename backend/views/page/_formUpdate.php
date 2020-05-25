<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
mihaildev\elfinder\Assets::noConflict($this);
/* @var $this yii\web\View */
/* @var $model backend\models\PageForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Основное</div>
        <div class="box-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentPagesList()) ?>

            <?= $form->field($model, 'categories_pages_id')->dropDownList($model->categoriesList(), ['prompt' => 'Выбрать категорию']) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->widget(CKEditor::className(),  ['editorOptions' => ElFinder::ckeditorOptions('elfinder')]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true])?>

            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model, 'meta_title')->textInput() ?>
            <?= $form->field($model, 'meta_description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model, 'meta_keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
