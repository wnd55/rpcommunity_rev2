<?php

/* @var $provider \yii\data\ActiveDataProvider */
/* @var $pages \backend\models\Pages */

//\yii\helpers\VarDumper::dump($pages, 20, true);die();

?>


<ul>
    <?php if (isset($pages)): ?>
        <?php foreach ($pages as $page): ?>
            <li> <?= $page->title ?></li>

        <?php endforeach; ?>
    <?php endif; ?>

</ul>
