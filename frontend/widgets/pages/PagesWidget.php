<?php
namespace frontend\widgets\pages;

use yii\jui\Widget;
use backend\models\Pages;

class PagesWidget extends Widget
{


  public function run()
  {
      parent::run();

      $pages = Pages::find()->where(['categories_pages_id' => 1])->andWhere(['status' => 1])->orderBy(['created_at' => SORT_DESC])->all();

      return $this->render('pages', ['pages' => $pages]);
  }


}