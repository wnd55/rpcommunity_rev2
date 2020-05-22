<?php

namespace backend\widgets\grid;


use backend\modules\rbac\access\Rbac;
use Yii;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\rbac\Item;

class RoleColumn extends DataColumn
{

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return string
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $roles = Yii::$app->authManager->getRolesByUser($model->id);
        return $roles === [] ? $this->grid->emptyCell : implode(', ', array_map(function (Item $role) {
            return $this->getRoleLabel($role);
        }, $roles));
    }

    /**
     * @param Item $role
     * @return string
     */
    private function getRoleLabel(Item $role)
    {
        $class = $role->name;
        if ($role->name === Rbac::ROLE_USER) {
            $class = 'info';

        } elseif ($role->name === Rbac::ROLE_PROFILE) {
            $class = 'primary';
        } elseif ($role->name === Rbac::ROLE_MODERATOR) {

            $class = 'warning';
        } else {

            $class = 'danger';
        }


        return Html::tag('span', Html::encode($role->name), ['class' => 'label label-' . $class]);
    }
}