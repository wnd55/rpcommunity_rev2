<?php

namespace backend\modules\rbac\widgets\grid;

use backend\modules\rbac\access\Rbac;
use Yii;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\rbac\Item;

/**
 * Class RoleColumn
 * @package backend\widgets\grid
 */
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
        $class = '';

        switch ($role->name) {

            case Rbac::ROLE_USER :
                $class = 'primary';
                break;

            case Rbac::ROLE_MODERATOR :
                $class = 'warning';
                break;

            case Rbac::ROLE_ADMIN :
                $class = 'danger';
                break;
            default :
                $class = 'default';

        }

        return Html::tag('span', Html::encode($role->description), ['class' => 'label label-' . $class]);
    }
}