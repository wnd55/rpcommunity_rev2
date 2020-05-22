<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "meters-data".
 *
 * @property int $idmetersdata
 * @property int $user_id
 * @property int $watermeter_id
 * @property int $cold1
 * @property int $wmcold2
 * @property int $cold2
 * @property int|null $wmcold3
 * @property int|null $cold3
 * @property int $wmhot1
 * @property int $hot1
 * @property int $wmhot2
 * @property int $hot2
 * @property int|null $wmhot3
 * @property int|null $hot3
 * @property string $date
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $user
 */
class MetersData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metersdata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'watermeter_id', 'cold1', 'wmcold2', 'cold2', 'wmhot1', 'hot1', 'wmhot2', 'hot2', 'date', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['user_id', 'watermeter_id', 'cold1', 'wmcold2', 'cold2', 'wmcold3', 'cold3', 'wmhot1', 'hot1', 'wmhot2', 'hot2', 'wmhot3', 'hot3', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['date'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmetersdata' => 'Idmetersdata',
            'user_id' => 'User ID',
            'watermeter_id' => 'ХВС1',
            'cold1' => 'Показания',
            'wmcold2' => 'ХВС2',
            'cold2' => 'Показания',
            'wmcold3' => 'ХВС3',
            'cold3' => 'Показания',
            'wmhot1' => 'ГВС1',
            'hot1' => 'Показания',
            'wmhot2' => 'ГВС2',
            'hot2' => 'Показания',
            'wmhot3' => 'ГВС3',
            'hot3' => 'Показания',
            'date' => 'Дата ',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Создано',
            'updated_by' => 'Изменено',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


}
