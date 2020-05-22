<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 02.02.19
 * Time: 21:20
 */

namespace common\bootstrap;

use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;


class SetUp implements BootstrapInterface
{


    public function bootstrap($app)
    {

        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {

            return $app->mailer;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {

            return $app->authManager;
        });



    }


}