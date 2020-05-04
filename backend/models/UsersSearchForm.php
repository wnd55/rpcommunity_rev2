<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * Class UsersSearchForm
 * @package backend\models
 */
class UsersSearchForm extends Model
{

    public $id;
    public $status;
    public $username;
    public $email;
    public $role;
    public $profile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'profile'], 'integer'],
            [['username', 'role'], 'string'],
            [['email',], 'email'],
        ];
    }


    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }


    /**
     *
     * /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->joinWith(['authAssignment', 'profile']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,

                ]
            ],
        ]);

        $dataProvider->setSort([
            'attributes' => array_merge(
                $dataProvider->getSort()->attributes,
                [
                    'role' => [
                        'asc' => ['auth_assignment.item_name' => SORT_ASC],
                        'desc' => ['auth_assignment.item_name' => SORT_DESC],

                    ],
                    'profile'=>[

                        'asc' => ['profile.idprofile' => SORT_ASC],
                        'desc' => ['profile.idprofile' => SORT_DESC],
                    ]
                ]
            ),
        ]);


        $this->load($params);

        if (!$this->validate()) {

            $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,

        ]);


        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);


        if (!empty($this->role)) {

            $query->andFilterWhere(['auth_assignment.item_name' => $this->role]);
        }

        if (!empty($this->profile)) {

            $query->andFilterWhere(['profile.idprofile' => $this->profile]);
        }

        return $dataProvider;
    }


    public function rolesList()
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'name');
    }

    public function getProfileFilter()
    {

        return ArrayHelper::map(Profile::find()->all(), 'idprofile', 'account');
    }
}


