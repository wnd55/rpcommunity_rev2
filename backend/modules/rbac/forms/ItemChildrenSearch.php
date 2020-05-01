<?php
namespace backend\modules\rbac\forms;


use \backend\modules\rbac\entities\AuthItemChild;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ItemChildrenSearch extends Model
{
    /**
     * @var
     */
    public $parent;
    public $child;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'string'],

        ];
    }


    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {

        $query = AuthItemChild::find();

        $provider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {

            $query->where('98=34');
            return $provider;

        }

        $query->andFilterWhere(['like', 'parent', $this->parent]);
        $query->andFilterWhere(['like', 'child', $this->child]);

        return $provider;

    }





}