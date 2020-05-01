<?php

namespace backend\modules\rbac\forms;


use \backend\modules\rbac\entities\AuthItem;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class RoleSearch
 * @package backend\forms
 */
class RoleSearch extends Model
{

    /**
     * @var
     */
    public $name;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name',], 'string'],

        ];
    }


    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {

        $query = AuthItem::find();

        $provider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {

            $query->where('98=34');
            return $provider;

        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $provider;

    }


}