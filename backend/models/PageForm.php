<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 14.02.19
 * Time: 11:54
 */

namespace backend\models;

use backend\models\Pages;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class PageForm
 * @package shop\forms\manage
 */
class PageForm extends Model
{


    public $title;
    public $content;
    public $status;
    public $parentId;
    public $categories_pages_id;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $slug;


    private $_page;


    public function __construct(Pages $page = null, array $config = [])
    {
        if ($page) {

            $this->title = $page->title;
            $this->content = $page->content;
            $this->status = $page->status;
            $this->parentId = $page->parent ? $page->parent->id : null;
            $this->categories_pages_id = $page->categories_pages_id;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->meta_keywords = $page->meta_keywords;
            $this->slug = $page->slug;


            $this->_page = $page;
        }

        parent::__construct($config);
    }


    public function scenarios()
    {

        $scenarios = parent::scenarios();

        $scenarios['edit'] = ['status','slug', 'title', 'meta_title', 'meta_description', 'meta_keywords', 'content','categories_pages_id'];

        return $scenarios;
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [

            [['title', 'meta_title', 'meta_description', 'meta_keywords',], 'required'],
            [['title', 'meta_title', 'meta_description', 'meta_keywords', 'slug',], 'required', 'on' => 'edit'],
            [['slug', 'title', 'meta_title', 'meta_description', 'meta_keywords',], 'string', 'max' => 255, 'on' => 'edit'],
            [['parentId', 'categories_pages_id'], 'integer'],
            [['title', 'meta_title', 'meta_description', 'meta_keywords',], 'string', 'max' => 255],
            [['content'], 'string'],
            [['content'], 'string', 'on' => 'edit'],
            [['status',], 'integer'],
            [['status',], 'integer', 'on' => 'edit'],
            [['title'], 'unique', 'targetClass' => Pages::class,
                'filter' => $this->_page ? ['<>', 'id', $this->_page->id] : null],
            [['title'], 'unique', 'targetClass' => Pages::class,
                'filter' => $this->_page ? ['<>', 'id', $this->_page->id] : null, 'on' => 'edit'],

            [['slug'], 'unique', 'targetClass' => Pages::class,
                'filter' => $this->_page ? ['<>', 'id', $this->_page->id] : null, 'on' => 'edit']];

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'content' => 'Текст',
            'status'=> 'Статус',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'parentId' => 'Главная страница'
        ];
    }


    /**
     * @return array
     */
    public function parentPagesList()
    {
        return ArrayHelper::map(Pages::find()->orderBy('lft')->andWhere($this->_page ? ['<>', 'id', $this->_page->id] : null)->all(), 'id', function (Pages $page) {


            return ($page->depth > 1 ? str_repeat('-- ', $page->depth - 1) . ' ' : '') . $page->title;
        }

        );
    }


    public function categoriesList()
    {
        return ArrayHelper::map(CategoriesPages::find()->all(), 'id', 'title');
    }

}