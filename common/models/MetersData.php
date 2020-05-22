<?php

namespace common\models;

use yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

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
 * @property User $user
 */
class MetersData extends \yii\db\ActiveRecord
{
    const SCENARIO_THIRD_COUNTER = 'thirdCounter';
    public $twoCounters = null; //Два счётчика

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metersdata';
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
            [['watermeter_id', 'cold1', 'wmcold2', 'cold2', 'wmhot1', 'hot1', 'wmhot2', 'hot2',], 'required'],
            [['watermeter_id', 'cold1', 'wmcold2', 'cold2', 'wmhot1', 'hot1', 'wmhot2', 'hot2',], 'integer'],
            [['wmcold3', 'cold3', 'wmhot3', 'hot3',], 'required', 'on' => self::SCENARIO_THIRD_COUNTER],
            [['wmcold3', 'cold3', 'wmhot3', 'hot3'], 'integer', 'on' => self::SCENARIO_THIRD_COUNTER],


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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return $this
     */
    public function fillData()
    {

        $waterMeters = WaterMeter::find()->where(['user_id' => \Yii::$app->user->id])->asArray()->all();
        $waterMetersCold = ArrayHelper::getColumn($waterMeters, 'wmcold');
        $waterMetersHot = ArrayHelper::getColumn($waterMeters, 'wmhot');

        if (isset($waterMetersCold[2]) && isset($waterMetersHot[2])) {

            $this->scenario = MetersData::SCENARIO_THIRD_COUNTER;

        } else {

            $this->twoCounters = true;
        }

        $this->setAttributes([
            'watermeter_id' => $waterMetersCold[0],
            'wmcold2' => $waterMetersCold[1],
            'wmcold3' => isset($waterMetersCold[2]) ? $waterMetersCold[2] : 0,
            'wmhot1' => $waterMetersHot[0],
            'wmhot2' => $waterMetersHot[1],
            'wmhot3' => isset($waterMetersHot[2]) ? $waterMetersHot[2] : 0
        ]);

        return $this;

    }

    /**
     * @return bool
     */
    public function checkCounters()
    {
        $waterMeters = WaterMeter::find()->where(['user_id' => \Yii::$app->user->id])->asArray()->all();
        $waterMetersCold = ArrayHelper::getColumn($waterMeters, 'wmcold');
        $waterMetersHot = ArrayHelper::getColumn($waterMeters, 'wmhot');

        if (isset($waterMetersCold[2]) && isset($waterMetersHot[2])) {

            return $this->twoCounters = false;

        } else {

            return $this->twoCounters = true;
        }



    }

    /**
     * @param $model
     * @return static
     * @throws ErrorException
     */
    public static function createMetersData($model)
    {
        $meterData = new static();

        $meterData->user_id = Yii::$app->user->id;
        $meterData->watermeter_id = $model->watermeter_id;
        $meterData->cold1 = $model->cold1;
        $meterData->wmcold2 = $model->wmcold2;
        $meterData->cold2 = $model->cold2;
        $meterData->wmcold3 = isset($model->wmcold3) ? $model->wmcold3 : 0;
        $meterData->cold3 = isset($model->cold3) ? $model->cold3 : 0;
        $meterData->wmhot1 = $model->wmhot1;
        $meterData->hot1 = $model->hot1;
        $meterData->wmhot2 = $model->wmhot2;
        $meterData->hot2 = $model->hot2;
        $meterData->wmhot3 = isset($model->wmhot3) ? $model->wmhot3 : 0;
        $meterData->hot3 = isset($model->hot3) ? $model->hot3 : 0;
        $meterData->date = date('Y-m-d h:i:s');

        if (!$meterData->save()) {

            throw new ErrorException('Ошибка сохранения');
        }

        return $meterData;
    }

    /**
     * @param MetersData $model
     * @throws ErrorException
     */
    public function edit(MetersData $model)
    {

        $this->cold1 = $model->cold1;
        $this->cold2 = $model->cold2;
        $this->cold3 = $model->cold3;

        $this->hot1 = $model->hot1;
        $this->hot2 = $model->hot2;
        $this->hot3 = $model->hot3;

        if (!$model->save()) {

            throw new ErrorException('Ошибка сохранения');

        }

    }

    /**
     * @param MetersData $model
     * @throws ErrorException
     */
    public function remove(MetersData $model)
    {

        if (!$model->delete()) {

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
