<?php
namespace frontend\widgets\menu;

use backend\models\CategoriesPages;
use backend\models\Pages;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;

class MenuWidget extends Widget
{



    public function run()
    {
        parent::run();

        $pages = Pages::find()->where(['categories_pages_id' => 1])->all();
        $provider = new ActiveDataProvider([
          'query' => $pages,
        ]);
        return $this->render('menu', ['pages' => $pages]);
    }

}
