<?php


namespace backend\modules\rbac\forms;


use backend\modules\rbac\entities\AuthItem;
use yii\base\Model;


class RoleCreateForm extends Model
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
                ['name', 'unique', 'targetClass' => AuthItem::className(), 'targetAttribute' =>'name'],
                [['name', 'description'], 'string'],
                [['name',], 'string', 'max' => 64],

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