<?php

namespace backend\modules\rbac\forms;


use \backend\modules\rbac\entities\AuthItem;
use \common\models\User;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class AuthAssignmentForm
 * @package backend\modules\rbac\forms
 */
class AuthAssignmentForm extends Model
{

    /**
     * @var
     */
    public $role;
    public $userId;

    /**
     * @return array
     */
    public function rules()
    {

        return [

            [['role', 'userId'], 'required'],
            [['role',], 'string'],
            [['userId'], 'integer'],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Роль',
            'user_id' => 'Пользователь ID',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return array
     */
    public function getRole()
    {
        return ArrayHelper::map(AuthItem::find()->where(['type' => 1])->all(), 'name', 'name');

    }

    /**
     * @return array
     */
    public function getUser()
    {

        return ArrayHelper::map(User::find()->orderBy('email ASC')->all(), 'id', 'email');
    }
}
