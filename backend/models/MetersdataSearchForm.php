<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Metersdata;

/**
 * MetersdataSearchForm represents the model behind the search form of `backend\models\Metersdata`.
 */
class MetersdataSearchForm extends Metersdata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmetersdata', 'user_id', 'watermeter_id', 'cold1', 'wmcold2', 'cold2', 'wmcold3', 'cold3', 'wmhot1', 'hot1', 'wmhot2', 'hot2', 'wmhot3', 'hot3', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['date'], 'safe'],
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
        $query = Metersdata::find();

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
            'idmetersdata' => $this->idmetersdata,
            'user_id' => $this->user_id,
            'watermeter_id' => $this->watermeter_id,
            'cold1' => $this->cold1,
            'wmcold2' => $this->wmcold2,
            'cold2' => $this->cold2,
            'wmcold3' => $this->wmcold3,
            'cold3' => $this->cold3,
            'wmhot1' => $this->wmhot1,
            'hot1' => $this->hot1,
            'wmhot2' => $this->wmhot2,
            'hot2' => $this->hot2,
            'wmhot3' => $this->wmhot3,
            'hot3' => $this->hot3,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
