<?php
/**
 * Created by PhpStorm.
 * User: webndesign
 * Date: 25.04.20
 * Time: 23:50
 */

namespace console\controllers;

use yii\console\Controller;

class User extends Controller
{


    public function actionUser()
    {

        $users = \common\models\User::find();

        return print_r($users);
    }

}