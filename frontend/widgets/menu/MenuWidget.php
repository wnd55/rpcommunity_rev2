<?php
namespace frontend\widgets\menu;

use backend\models\CategoriesPages;
use yii\base\Widget;

class MenuWidget extends Widget
{



    public function run()
    {
        parent::run();

        $category = CategoriesPages::find()->where([]);
        return $this->render('menu');
    }

}
