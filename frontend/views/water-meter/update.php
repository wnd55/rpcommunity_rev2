<?php
use \yii\helpers\Html;

/**
 * @var  $this yii\web\View
 * @var $model \common\models\Watermeter;
 */
$this->title = 'Изменение счётчиков воды '. $model->wmcold .' '. $model->wmhot;
$this->params['breadcrumbs'][] = ['label' => 'Счётчики воды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div>
    <h1><?= Html::encode($this->title)?></h1>
    <?= $this->render('_form', ['model' => $model])?>


</div>
