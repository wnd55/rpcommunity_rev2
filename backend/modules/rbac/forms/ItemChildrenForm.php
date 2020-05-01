<?php

namespace backend\modules\rbac\forms;


use \backend\modules\rbac\entities\AuthItem;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ItemChildrenForm extends Model
{

    /**
     * @var
     */
    public $parent;
    public $child;

    /**
     * @return array
     */
    public function rules()
    {


        return
            [
                [['parent', 'child'], 'required'],
                [['parent', 'child'], 'string'],

            ];

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
    public function getRole()
    {
        return ArrayHelper::map(AuthItem::find()->all(), 'name', 'name');

    }


}