<?php
use \yii\helpers\Html;

/**
 * @var  $this yii\web\View
 * @var $model common\models\MetersData;
 */
$this->title = 'Изменение показаний счётчиков воды указанных '.$model->date;
$this->params['breadcrumbs'][] = ['label' => 'Показания воды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div>
    <h1><?= Html::encode($this->title)?></h1>
    <?= $this->render('_form', ['model' => $model])?>


</div>
