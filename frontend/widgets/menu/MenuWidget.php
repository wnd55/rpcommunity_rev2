<?php

namespace frontend\widgets\menu;

use backend\models\CategoriesPages;
use backend\models\Pages;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "pages".
 * @mixin NestedSetsBehavior
 */
class MenuWidget extends Widget
{


    public function run()
    {
        parent::run();


        $pages = Pages::find()->where(['categories_pages_id' => 1])->andWhere(['status' => 1])->orderBy('lft')->asArray()->all();

        return $this->newTree($pages);
    }

    /**
     * @param $pages
     */

    public function newTree($pages)
    {
        $tree = array();
        $stack = array();


        foreach ($pages as $page) {

            $item = $page;

            $item['children'] = array();

            $l = count($stack);

            while ($l > 0 && (int)$stack[$l - 1]['depth'] >= (int)$item['depth']) {

                array_pop($stack);
                $l--;
            }

            if ($l === 0) {

                $i = count($tree);
                $tree[$i] = $item;
                $stack[] = &$tree[$i];


            } else {
                $i = count($stack[$l - 1]['children']);
                $stack[$l - 1]['children'][$i] = $item;
                $stack[] = &$stack[$l - 1]['children'][$i];
            }

        }


        // VarDumper::dump($tree, 20, true);die();
        return $this->buildMenu($tree);
    }

    /**
     * @param $array
     */
    public function buildMenu($array)
    {
        echo '<ul>';
        foreach ($array as $item) {
            echo '<li>';
            echo Html::a($item['title'],['/pages/view', 'slug' => $item['slug']]);
            if (!empty($item['children'])) {
                $this->buildMenu($item['children']);
            }
            echo '</li>';
        }
        echo '</ul>';
    }


}
