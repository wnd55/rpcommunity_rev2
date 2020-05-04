<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "homeowners".
 *
 * @property int $idhomeowners
 * @property string $homeowners
 *
 * @property Profile[] $profiles
 */
class Homeowners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'homeowners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['homeowners'], 'required'],
            [['homeowners'], 'string', 'max' => 75],
            ['homeowners', 'unique']

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idhomeowners' => 'id',
            'homeowners' => 'ТСЖ',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['homeowners_id' => 'idhomeowners']);
    }
}
