<?php

namespace backend\models;

use common\models\User;
use SebastianBergmann\Type\RuntimeException;
use yii\base\ErrorException;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "profile".
 *
 * @property int $idprofile
 * @property int $user_id
 * @property int $account
 * @property int $homeowners_id
 * @property int $address_id
 * @property int $apartment
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $check1
 * @property int|null $check2
 *
 * @property User
 * @property Address $address
 * @property Homeowners $homeowners
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

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
            [['user_id', 'account', 'homeowners_id', 'address_id', 'apartment', 'surname', 'name', 'patronymic',], 'required'],
            [['user_id', 'account', 'homeowners_id', 'address_id', 'apartment',], 'integer'],
            [['surname', 'patronymic'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 45],
            [['check1', 'check2'], 'boolean'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id'],],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::class, 'targetAttribute' => ['address_id' => 'idaddress',]],
            [['homeowners_id'], 'exist', 'skipOnError' => true, 'targetClass' => Homeowners::class, 'targetAttribute' => ['homeowners_id' => 'idhomeowners',]],
        ];
    }


    /**
     * @param $model
     * @return static
     * @throws ErrorException
     */
    public static function createProfile(ProfileCreateForm $model)
    {

        $profile = new static();

        $profile->user_id = $model->user_id;
        $profile->account = $model->account;
        $profile->apartment = $model->apartment;
        $profile->homeowners_id = $model->homeowners_id;
        $profile->address_id = $model->address_id;
        $profile->surname = $model->surname;
        $profile->name = $model->name;
        $profile->patronymic = $model->patronymic;
        $profile->check1 = $model->check1 ? $model->check1 : 0;
        $profile->check2 = $model->check2 ? $model->check2 : 0;

        if (!$profile->save()) {


            throw new ErrorException('Ошибка сохранения');
        }

        $user = User::findOne(['id' => $profile->user_id]);
        $user->status = User::STATUS_ACTIVE;
        $user->update(false);

        $auth = Yii::$app->authManager;
        $roleUser = $auth->getRolesByUser($profile->user_id);

        if ($roleUser['user']->name === 'user' || $roleUser == null) {

            $authRoleUser = $auth->getRole('user');
            $auth->revoke($authRoleUser, $profile->user_id);
            $authRole = $auth->getRole('profile');
            $auth->assign($authRole, $profile->user_id);
        }


        return $profile;

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprofile' => 'id',
            'user_id' => 'User ID',
            'account' => 'Лицевой счет',
            'homeowners_id' => 'Homeowners ID',
            'address_id' => 'Address ID',
            'apartment' => 'Квартира',
            'surname' => 'Отчество',
            'name' => 'Имя',
            'patronymic' => 'Фамилия',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Создано',
            'updated_by' => 'Изменено',
            'check1' => 'Check1',
            'check2' => 'Check2',
        ];
    }

    /**
     * @param Profile $profile
     * @throws ErrorException
     */
    public function remove(Profile $profile)
    {
        $userId = $profile->user_id;


        if (!$profile->delete()) {

            throw new ErrorException('Ошибка удаления');
        }

        $user = User::findOne(['id' => $userId]);
        $user->status = User::STATUS_DELETED_PROFILE;
        $user->update(false);

        $auth = Yii::$app->authManager;
        $roleUser = $auth->getRolesByUser($userId);


        if ($roleUser['profile']->name === 'profile') {

            $authRoleProfile = $auth->getRole('profile');
            $auth->revoke($authRoleProfile, $userId);
            $authRoleUser = $auth->getRole('user');
            $auth->assign($authRoleUser, $userId);
        }

    }

    /**
     * @param ProfileCreateForm $model
     * @param Profile $profile
     * @throws ErrorException
     */
    public function edit(ProfileCreateForm $model, Profile $profile)
    {

        $profile->user_id = $model->user_id;
        $profile->account = $model->account;
        $profile->apartment = $model->apartment;
        $profile->homeowners_id = $model->homeowners_id;
        $profile->address_id = $model->address_id;
        $profile->surname = $model->surname;
        $profile->name = $model->name;
        $profile->patronymic = $model->patronymic;
        $profile->check1 = $model->check1 ? $model->check1 : 0;
        $profile->check2 = $model->check2 ? $model->check2 : 0;

        if (!$profile->save()) {

            throw new ErrorException('Ошибка сохранения');

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

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['idaddress' => 'address_id']);
    }

    /**
     * Gets query for [[Homeowners]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomeowners()
    {
        return $this->hasOne(Homeowners::className(), ['idhomeowners' => 'homeowners_id']);
    }
}
