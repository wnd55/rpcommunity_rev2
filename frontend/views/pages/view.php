<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $page \backend\models\Pages */

$this->title = $page->title;
$this->registerMetaTag(['name' => 'title', 'content' => $page->meta_title]);
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta_keywords]);
foreach ($page->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->title, 'url' => ['view', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $page->title;
?>


<article class="page-view">

    <h1 class="_top"><?= Html::encode($page->title) ?></h1>


    <?= Yii::$app->formatter->asHtml($page->content, [
        'Attr.AllowedRel' => array('nofollow'),
        'HTML.SafeObject' => true,
        'Output.FlashCompat' => true,
        'HTML.SafeIframe' => true,
        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
    ]) ?>

</article>
