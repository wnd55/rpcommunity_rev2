<?php

namespace backend\helpers;

use \common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelper
{
    /**
     * @param $status
     * @return mixed
     */
    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @return array
     */
    public static function statusList()
    {
        return [
            User::STATUS_INACTIVE => 'Неактивный',
            User::STATUS_ACTIVE => 'Активный',
            User::STATUS_DELETED_PROFILE => 'Профиль удалён'

        ];
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusLabel($status)
    {
        switch ($status) {
            case User::STATUS_INACTIVE:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case User::STATUS_DELETED_PROFILE:
                $class = 'label label-warning';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}