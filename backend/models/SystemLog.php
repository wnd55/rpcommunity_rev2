<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property int $id
 * @property int|null $level
 * @property string|null $category
 * @property float|null $log_time
 * @property string|null $prefix
 * @property string|null $message
 */
class SystemLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Уровень',
            'category' => 'Категория',
            'log_time' => 'Время',
            'prefix' => 'Префикс',
            'message' => 'Сообщение',
        ];
    }
}
