<?php
namespace backend\modules\rbac\forms;


use backend\modules\rbac\entities\AuthItem;
use yii\base\Model;

class PermissionCreateForm extends Model
{

    /**
     * @var
     */
    public $name;
    public $description;


    /**
     * @return array
     */
    public function rules()
    {

        return
            [
                [['name',], 'required'],
                [['name'], 'unique', 'targetClass' => AuthItem::className(),],
                [['name', 'description' ], 'string'],

            ];

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'type' => 'Тип',
            'description' => 'Описание',
            'rule_name' => 'Название правила',
            'data' => 'Дата',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }




}