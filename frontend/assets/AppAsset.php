<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/menu.css',
        'css/jquery.fancybox.css'
    ];
    public $js = [
        'js/common.js',
        'js/menu.js',
        'js/websocketChat.js',
        'js/jquery.fancybox.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\assets\FontAwesomeAsset',
    ];
}
