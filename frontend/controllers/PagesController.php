<?php

namespace frontend\controllers;


use backend\models\Pages;
use yii\web\Controller;

class PagesController extends Controller
{


    public function actionView($slug)
    {
        $page = Pages::find()->where(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();

        return $this->render('view', ['page' => $page]);


    }


}


