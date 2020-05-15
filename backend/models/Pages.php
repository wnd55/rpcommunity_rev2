<?php

namespace backend\models;


use Yii;
use yii\base\ErrorException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use \backend\models\PageForm;

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
class Pages extends \yii\db\ActiveRecord
{
    public $parentId;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @param \backend\models\PageForm $form
     * @return static
     * @throws ErrorException
     */
    public static function create(PageForm $form)
    {
        $parent = Pages::findOne($form->parentId);

        $page = new static();

        $page->title = $form->title;
        $page->content = $form->content;
        $page->status = $form->status;
        $page->categories_pages_id = $form->categories_pages_id;
        $page->meta_title = $form->meta_title;
        $page->meta_description = $form->meta_description;
        $page->meta_keywords = $form->meta_keywords;

        $page->appendTo($parent);

        if (!$page->save()) {

            throw new ErrorException('Ошибка сохранения');

        }

        return $page;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [

            [['title', 'meta_title', 'meta_description', 'meta_keywords', 'categories_pages_id'], 'required'],

            [['title', 'meta_title', 'meta_description', 'meta_keywords',], 'string', 'max' => 255],

            [['parentId', 'categories_pages_id'], 'integer'],

            [['content'], 'string'],

            [['status',], 'integer'],

            [['title'], 'unique', 'targetClass' => Pages::class,],

        ];

    }

    public function behaviors()
    {
        return [
            NestedSetsBehavior::class,
            TimestampBehavior::class,
            BlameableBehavior::class,
            'slug' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
                'immutable' => false
            ]
        ];
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
            'content' => 'Содержание',
            'status' => 'Статус',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Создал',
            'updated_by' => 'Изменил',
        ];
    }

    /**
     * @param $id
     * @param \backend\models\PageForm $form
     * @throws ErrorException
     */
    public function edit($id, PageForm $form)
    {
        $page = Pages::findOne($id);
        $this->assertIsNotRoot($page);

        $page->title = $form->title;
        $page->content = $form->content;
        $page->status = $form->status;
        $page->categories_pages_id = $form->categories_pages_id;
        $page->slug = $form->slug;
        $page->meta_title = $form->meta_title;
        $page->meta_description = $form->meta_description;
        $page->meta_keywords = $form->meta_keywords;

        if ($form->parentId !== $page->parent->id) {
            $parent = Pages::findOne($form->parentId);
            $page->appendTo($parent);
        }

        if (!$page->save(false)) {

            throw new ErrorException('Ошибка сохранения');

        }
    }

    /**
     * @param Pages $page
     */

    private function assertIsNotRoot(Pages $page)
    {
        if ($page->isRoot()) {
            throw new \DomainException('Невозможно управлять корневой категорией');
        }
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        $page = Pages::findOne($id);
        $this->assertIsNotRoot($page);

        if (!$page->delete()) {
            throw new \RuntimeException('Ошибка удаления');
        }
    }

    /**
     * @param $id
     */
    public function moveUp($id)
    {
        $page = Pages::findOne($id);
        $this->assertIsNotRoot($page);
        if ($prev = $page->prev) {
            $page->insertBefore($prev);
        }
        if (!$page->save()) {
            throw new \RuntimeException('Ошибка сохранения');
        }
    }

    /**
     * @param $id
     */
    public function moveDown($id)
    {
        $page = Pages::findOne($id);
        $this->assertIsNotRoot($page);
        if ($next = $page->next) {
            $page->insertAfter($next);
        }
        if (!$page->save()) {
            throw new \RuntimeException('Ошибка сохранения');
        }
    }

    /**
     * Gets query for [[CategoriesPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesPages()
    {
        return $this->hasOne(CategoriesPages::className(), ['id' => 'categories_pages_id']);
    }
}
