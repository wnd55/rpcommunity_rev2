<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Homeowners;

/**
 * HomeownersSearchForm represents the model behind the search form of `backend\models\Homeowners`.
 */
class HomeownersSearchForm extends Homeowners
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idhomeowners'], 'integer'],
            [['homeowners'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Homeowners::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idhomeowners' => $this->idhomeowners,
        ]);

        $query->andFilterWhere(['like', 'homeowners', $this->homeowners]);

        return $dataProvider;
    }
}
