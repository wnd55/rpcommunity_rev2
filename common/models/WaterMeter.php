<?php

namespace common\models;

use Yii;
use yii\base\ErrorException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "watermeter".
 *
 * @property int $idwatermeter
 * @property int $user_id
 * @property string $wmcold
 * @property string $wmhot
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property User $user
 */
class WaterMeter extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'watermeter';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [

            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wmcold', 'wmhot',], 'required'],
            [['user_id',], 'integer'],
            [['wmcold', 'wmhot'], 'string', 'min' => '9', 'max' => '10', 'message' => 'Укажите не менее 9 цифр'],
            [['wmcold'], 'unique',],
            [['wmhot'], 'unique', ],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idwatermeter' => 'Idwatermeter',
            'user_id' => 'User ID',
            'wmcold' => 'Счётчик холодной воды',
            'wmhot' => 'Счётчик горячей воды',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Создан',
            'updated_by' => 'Изменён'
        ];
    }

    /**
     * @param $model
     * @return static
     * @throws ErrorException
     */
    public static function createWaterMeter($model)
    {
        $waterMeter = new static();

        $waterMeter->wmcold = $model->wmcold;
        $waterMeter->wmhot = $model->wmhot;
        $waterMeter->user_id = Yii::$app->user->id;

        if (!$waterMeter->save()) {

            throw new ErrorException('Ошибка сохранения');

        }

        return $waterMeter;
    }

    /**
     * @param $id
     * @param WaterMeter $model
     * @throws ErrorException
     */
    public function edit($id, WaterMeter $model)
    {
        $waterMeter = WaterMeter::findOne($id);

        $waterMeter->wmcold = $model->wmcold;
        $waterMeter->wmhot = $model->wmhot;

        if (!$waterMeter->save()) {

            throw new ErrorException('Ошибка сохранения');

        }

    }

    /**
     * @param WaterMeter $waterMeter
     * @throws ErrorException
     */
    public function remove(WaterMeter $waterMeter)
    {

        if(!$waterMeter->delete()){

            throw new ErrorException('Ошибка удаления');

        }

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
