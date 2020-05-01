<?php
namespace backend\modules\rbac\forms;


use \backend\modules\rbac\entities\AuthItem;
use yii\base\Model;

class RoleEditForm extends Model
{

    public $name;
    public $type;
    public $description;
    public $rule_name;
    public $data;


    public function __construct(AuthItem $role, $config = [])
    {
        $this->name = $role->name;
        $this->type = $role->type;
        $this->description = $role->description;
        $this->rule_name = $role->rule_name;
        $this->data = $role->data;


        parent::__construct($config);
    }


    public function rules()
    {

        return
            [
                [['name', 'description'], 'required'],
                [['name'], 'unique', 'targetClass' => AuthItem::className(),'filter' => ['<>', 'name', $this->name] ],
                [['name','description', 'data'], 'string'],
                [['type',], 'integer'],
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