<?php

namespace backend\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ProfileSearchForm extends Model
{

    public $surname;
    public $email;
    public $account;
    public $homeowners_id;
    public $address_id;
    public $role;

    /**
     * @return array
     */
    public function rules()
    {
        return [

            [['surname', 'role'], 'string'],
            [['email'], 'email'],
            [['account', 'homeowners_id', 'address_id'], 'integer']


        ];
    }

    public function search(array $params)
    {

        $query = Profile::find()->joinWith(['user', 'address', 'homeowners', 'user.authAssignment']);

        $provider = new ActiveDataProvider([

            'query' => $query

        ]);

        $provider->setSort([
            'attributes' => array_merge(
                $provider->getSort()->attributes,
                [
                    'role' => [
                        'asc' => ['auth_assignment.item_name' => SORT_ASC],
                        'desc' => ['auth_assignment.item_name' => SORT_DESC],

                    ],

                ]
            ),
        ]);



        $this->load($params);

        if (!$this->validate()) {

            $query->where('1=99');

            return $provider;
        }


        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'account', $this->account]);


        $query->andFilterWhere(['user.email' => $this->email]);

        if (!empty($this->homeowners_id)) {

            $query->andFilterWhere(['homeowners.idhomeowners' => $this->homeowners_id]);

        }

        if (!empty($this->address_id)) {

            $query->andFilterWhere(['address.idaddress' => $this->address_id]);

        }

        if (!empty($this->role)) {

        $query->andFilterWhere(['auth_assignment.item_name' => $this->role]);

    }



        return $provider;
    }


    public function getHomeownersFilter()
    {
        return ArrayHelper::map(Homeowners::find()->asArray()->all(), 'idhomeowners', 'homeowners');

    }

    public function getAddressFilter()
    {

        return ArrayHelper::map(Address::find()->asArray()->all(), 'idaddress', 'address');
    }

}