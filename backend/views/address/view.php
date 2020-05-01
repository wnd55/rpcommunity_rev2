<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\web\View;
use \backend\models\Profile;
/* @var $this yii\web\View */
/* @var $model backend\models\Address */

$this->title = $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Адрес', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$profiles = Profile::find()->where(['address_id' => $model->idaddress])->one();

if (isset($profiles)) {

    $this->registerJs(
        "$('#addressDelete').attr('disabled', true);",
        View::POS_READY,
        'addressDelete'
    );
}

?>
<div class="address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->idaddress], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idaddress], [
            'id' => 'addressDelete',
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idaddress',
            'address',
        ],
    ]) ?>

</div>
