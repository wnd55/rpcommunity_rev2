<?php

use \backend\models\HostSettings;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);



return [
    'id' => 'rp-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
//
//        'frontend\chat\ChatServer',
//        'frontend\chat\Chat'


    ],
    'controllerNamespace' => 'frontend\controllers',
    'on beforeRequest' => function ($event) {
        $maintenance = HostSettings::findOne(['value' => 'Сервис']);

        if ((bool)$maintenance->status === true) {
            Yii::$app->catchAll = [
                'site/offline',

            ];
        }
    },

    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],


        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],

    'params' => $params,
];
