<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoriesPages */

$this->title = 'Создать категорию страниц';
$this->params['breadcrumbs'][] = ['label' => 'Категории страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
