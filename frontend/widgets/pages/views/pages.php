<?php

use \yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $pages \backend\models\Pages */

?>

<?php foreach ($pages as $page): ?>
<h4><?=Html::encode($page->title)?></h4>

    <?= Yii::$app->formatter->asHtml($page->content) ?>

<?php endforeach;?>