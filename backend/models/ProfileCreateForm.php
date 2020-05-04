<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;
use yii\helpers\ArrayHelper;


class ProfileCreateForm extends Model
{

    public $user_id;
    public $account;
    public $homeowners_id;
    public $address_id;
    public $apartment;
    public $surname;
    public $name;
    public $patronymic;
    public $check1;
    public $check2;

    private $profile;


    public function __construct(Profile $profile = null, array $config = [])
    {
        if (isset($profile)) {

            $this->user_id = $profile->user_id;
            $this->account = $profile->account;
            $this->apartment = $profile->apartment;
            $this->homeowners_id = $profile->homeowners_id;
            $this->address_id = $profile->address_id;
            $this->surname = $profile->surname;
            $this->name = $profile->name;
            $this->patronymic = $profile->patronymic;
            $this->check1 = $profile->check1;
            $this->check1 = $profile->check2;

            $this->profile = $profile;
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'account', 'homeowners_id', 'address_id', 'apartment', 'surname', 'name', 'patronymic',], 'required'],
            [['user_id', 'homeowners_id', 'address_id', 'apartment',], 'integer'],
            [['surname', 'patronymic', 'account',], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 45],
            [['account', 'apartment'], 'string',],
            [['check1', 'check2'], 'boolean'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id'],],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::class, 'targetAttribute' => ['address_id' => 'idaddress']],
            [['homeowners_id'], 'exist', 'skipOnError' => true, 'targetClass' => Homeowners::class, 'targetAttribute' => ['homeowners_id' => 'idhomeowners']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprofile' => 'id',
            'user_id' => 'Email',
            'account' => 'Лицевой счет',
            'homeowners_id' => 'ТСЖ',
            'address_id' => 'Адрес',
            'apartment' => 'Квартира',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'created_by' => 'Создано',
            'updated_by' => 'Изменено',
            'check1' => 'Средний расход воды',
            'check2' => 'Нет расхода воды',
        ];
    }

    /**
     * @return array
     */
    public function getUserList()
    {
        $query = Profile::find()->select('user_id');

        return ArrayHelper::map(User::find()->where(['not in', 'id', $query])->orWhere(['=', 'id', isset($this->profile) ? $this->profile->user_id : ''])->orderBy('email ASC')->asArray()->all(), 'id', 'email');
    }

    /**
     * @return array
     */
    public function getHomeownersList()
    {
        return ArrayHelper::map(Homeowners::find()->all(), 'idhomeowners', 'homeowners');

    }

    /**
     * @return array
     */
    public function getAddressList()
    {

        return ArrayHelper::map(Address::find()->all(), 'idaddress', 'address');
    }


}