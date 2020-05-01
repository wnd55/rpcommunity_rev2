<?php

namespace frontend\models;


use common\models\MetersData;
use yii\base\Model;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class MetersDataSearchForm
 * @package frontend\models
 */
class MetersDataSearchForm extends Model
{

    public $from_date;
    public $to_date;

    /**
     * @return array
     */
    public function rules()
    {
        return [

            [['from_date', 'to_date'], 'date', 'format' => 'Y/m/d',],

        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {

        $query = MetersData::find()->where(['user_id' => Yii::$app->user->id]);

        $provider = new ActiveDataProvider([

            'query' => $query,
            'sort' => [
                'defaultOrder' => [

                    'idmetersdata' => SORT_DESC,
                ],
            ]

        ]);

        $this->load($params);

        if (!$this->validate()) {

            $query->where('1=99');

            return $provider;
        }


        $query->andFilterWhere(['>=', 'created_at', $this->from_date ? strtotime($this->from_date.'00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->to_date ? strtotime($this->to_date .'23:59:59') : null]);

        return $provider;

    }

}