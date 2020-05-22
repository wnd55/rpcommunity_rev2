<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;



    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
            'verifyCode' => 'Код проверки',
        ];

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже занято.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже занят.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha'],

        ];
    }

    /**
     * @param SignupForm $form
     */

    public function signup(SignupForm $form)
    {
        
        $user = new User();
        $user->username = $form->username;
        $user->email = $form->email;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($form->password);
        $user->generateAuthKey();
        $user->save();

        $auth = \Yii::$app->authManager;
        $authRole = $auth->getRole('user');
        $auth->assign($authRole, $user->getId());

        $this->sendEmail($user);


    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['text' => 'EmailSignupNotification-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Регистрация на ' . Yii::$app->name)
            ->send();
    }
}
