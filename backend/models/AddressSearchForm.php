<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * Class AddressSearchForm
 * @package backend\models
 */
class AddressSearchForm extends Model
{

   public $idaddress;
   public $address;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idaddress'], 'integer'],
            [['address'], 'string'],
        ];
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Address::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

             $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'idaddress' => $this->idaddress,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
