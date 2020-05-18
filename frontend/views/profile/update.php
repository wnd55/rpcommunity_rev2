<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileCreateForm */
/* @var $profile common\models\Profile */

$this->title = 'Изменение профиля: ' . $profile->idprofile;
$this->params['breadcrumbs'][] = ['label' => $profile->idprofile, 'url' => ['view', 'id' => $profile->idprofile]];
$this->params['breadcrumbs'][] = 'Изменение профиля';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>