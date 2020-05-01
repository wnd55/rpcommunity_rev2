<?php

namespace backend\modules\rbac\forms;


use \backend\modules\rbac\entities\AuthAssignment;
use backend\modules\rbac\entities\AuthItem;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Class AuthAssignmentsSearch
 * @package backend\modules\rbac\forms
 */
class AuthAssignmentsSearch extends Model
{

    public $item_name;
    public $email;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['item_name', 'email'], 'string'],

        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {
        $query = AuthAssignment::find()->joinWith('user');

        $provider = new ActiveDataProvider(['query' => $query]);


        $provider->setSort([
            'attributes' => array_merge(
                $provider->getSort()->attributes,
                [
                    'email' => [
                        'asc' => ['user.email' => SORT_ASC],
                        'desc' => ['user.email' => SORT_DESC],

                    ],

                ]
            ),
        ]);


        $this->load($params);

        if (!$this->validate()) {

            $query->where('98=34');

            return $provider;

        }

        $query->andFilterWhere(['like', 'item_name', $this->item_name]);

        if (!empty($this->email)) {

            $query->andFilterWhere(['user.email' => $this->email]);

        }


        return $provider;


    }

    /**
     * @return array
     */
    public function getFilterAuthItems()
    {

        return ArrayHelper::map(AuthItem::find()->all(), 'name', 'name');
    }


}