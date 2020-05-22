<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MetersData;

/**
 * MetersDataSearchForm represents the model behind the search form of `backend\models\MetersData`.
 */
class MetersDataSearchForm extends MetersData
{
    public $from_date;
    public $to_date;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmetersdata', 'user_id', 'watermeter_id', 'cold1', 'wmcold2', 'cold2', 'wmcold3', 'cold3', 'wmhot1', 'hot1', 'wmhot2', 'hot2', 'wmhot3', 'hot3', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['from_date', 'to_date'], 'date', 'format' => 'Y/m/d',],
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
        $query = MetersData::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [

                    'date' => SORT_DESC,
                ],
            ]
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

        ]);

        $query->andFilterWhere(['>=', 'created_at', $this->from_date ? strtotime($this->from_date.'00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->to_date ? strtotime($this->to_date .'23:59:59') : null]);


        return $dataProvider;
    }
}
