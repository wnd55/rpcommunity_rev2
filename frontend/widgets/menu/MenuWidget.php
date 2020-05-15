<?php

namespace frontend\widgets\menu;

use backend\models\CategoriesPages;
use backend\models\Pages;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property int categories_pages_id
 * @property string $title
 * @property string $slug
 * @property string|null $content
 * @property int|null $status
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property Pages $parent
 * @property Pages[] $parents
 * @property Pages[] $children
 * @property Pages $prev
 * @property Pages $next
 * @mixin NestedSetsBehavior
 */
class MenuWidget extends Widget
{


    /**
     * @var string
     */
    public $leftAttribute = 'lft';

    /**
     * @var string
     */
    public $depthAttribute = 'depth';

    /**
     * @var string
     */
    public $labelAttribute = 'name';

    /**
     * @var string
     */
    public $childrenOutAttribute = 'children';


    public function run()
    {
        parent::run();


        $pages = Pages::find()->where(['categories_pages_id' => 1])->orderBy('lft')->asArray()->all();

        return $this->tree($pages);
    }


    /**
     * Построение дерева Nested Sets в виде массива
     *
     * @param array $collection
     * @return array
     */
    public function tree(array $collection)
    {

        $trees = []; // Дерево

        if (count($collection) > 0) {


            // Узел. Используется для создания иерархии
            $stack = array();

            foreach ($collection as $node) {
                $item = $node;
                $item[$this->childrenOutAttribute] = array();

                // Количество элементов узла
                $l = count($stack);

                // Проверка имеем ли мы дело с разными уровнями
                while ($l > 0 && $stack[$l - 1][$this->depthAttribute] >= $item[$this->depthAttribute]) {
                    array_pop($stack);
                    $l--;
                }

                // Если это корень
                if ($l === 0) {
                    // Создание корневого элемента
                    $i = count($trees);
                    $trees[$i] = $item;
                    $stack[] = &$trees[$i];

                } else {
                    // Добавление элемента в родительский
                    $i = count($stack[$l - 1][$this->childrenOutAttribute]);
                    $stack[$l - 1][$this->childrenOutAttribute][$i] = $item;
                    $stack[] = &$stack[$l - 1][$this->childrenOutAttribute][$i];
                }
            }
        }


        return $this->buildMenu($trees);
    }

    /**
     * @param $array
     */
    public function buildMenu($array)
    {
        echo '<ul>';
        foreach ($array as $item) {
            echo '<li>';
            echo $item['title'];
            if (!empty($item['children'])) {
                $this->buildMenu($item['children']);
            }
            echo '</li>';
        }
        echo '</ul>';
    }


}
