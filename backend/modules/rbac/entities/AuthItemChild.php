<?php
namespace backend\modules\rbac\entities;

use yii\db\ActiveRecord;

/**
 * auth_item_children
 *
 * @property string $parent
 * @property string $child
 */
class AuthItemChild extends ActiveRecord
{


    /**
     * auth_item_children
     *
     * @property string $parent
     * @property string $child
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item_child}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => 'Родитель',
            'child' => 'Потомок',
        ];
    }


    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }





}