<?php
/**
 * Created by PhpStorm.
 * User: webndesign
 * Date: 17.04.20
 * Time: 11:59
 */

namespace common\components;


use yii\di\ServiceLocator;

class Client
{

    public static function connect()
    {
        $container = new ServiceLocator();
        $container->set('client', ['now' => getdate()]);


        return getdate();

    }



}