<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "categories_pages".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $content
 * @property int|null $parent
 * @property int|null $status
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Pages $page
 */
class CategoriesPages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories_pages';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [

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
    public function rules()
    {
        return [
            [['title', 'meta_title', 'meta_description', 'meta_keywords',], 'required'],
            [['content',], 'string'],
            [['parent', 'status',], 'integer'],
            [['title', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
            [['title'], 'unique',]

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
            'parent' => 'Родительская категория',
            'status' => 'Статус',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Создал',
            'updated_by' => 'Изменил',
        ];
    }


    public function getCategoryPagesParent($id)
    {


        return ArrayHelper::map(CategoriesPages::find()->where(['not', ['id' => $id]])->asArray()->all(), 'id', 'title');
    }

    /**
     * Gets query for [[Pages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['categories_pages_id' => 'id']);
    }


}
