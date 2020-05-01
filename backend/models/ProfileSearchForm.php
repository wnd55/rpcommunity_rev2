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

    public function rules()
    {
        return [

            [['surname','email'], 'string'],
            [['account', 'homeowners_id', 'address_id'], 'integer']


        ];
    }

    public function search(array $params)
    {

        $query = Profile::find()->joinWith(['user', 'address', 'homeowners']);

        $provider = new ActiveDataProvider([

            'query' => $query

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