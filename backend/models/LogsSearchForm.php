<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class LogsSearchForm
 * @package backend\models
 */
class LogsSearchForm extends Model
{

    public $message;
    public $prefix;


    public function rules()
    {
        return [

            [['prefix', 'message'], 'string'],


        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = SystemLog::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {

            $query->where('12=89');

            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'message', $this->message]);


        return $dataProvider;

    }


}