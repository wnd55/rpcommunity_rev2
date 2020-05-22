<?php

namespace frontend\controllers;

use frontend\models\ProfileCreateForm;
use Yii;
use common\models\Profile;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['user', 'moder', 'admin', 'profile'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],

                ],
            ],

        ];
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionView()
    {
        $id = Yii::$app->user->id;

        if (($model = Profile::findOne(['user_id' => $id])) !== null) {

            $this->layout = 'cabinet';
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {

            return $this->redirect('create');
        }

    }

    /**
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {


        //TODO  убрать email

        $model = new ProfileCreateForm(null);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                Profile::createProfile($model);
                Yii::$app->session->setFlash('success', 'Профиль успешно создан');
                return $this->redirect(['view']);

            } catch (ErrorException $exception) {

                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', 'Ошибка');

            }
        }

        return $this->render('create', ['model' => $model]);


    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $profile = $this->findModel($id);
        $model = new ProfileCreateForm($profile);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $profile->edit($model, $profile);
                Yii::$app->session->setFlash('success', 'Профиль успешно изменён');
                return $this->redirect(['view']);

            } catch (ErrorException $exception) {

                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', 'Ошибка');

            }
        }

        return $this->render('update', ['model' => $model, 'profile' => $profile]);

    }

    /**
     * @param $id
     * @return Profile $model
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');

        }


    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $profile = $this->findModel($id);
        try {

            //Профиль удаляется, в регистрации меняется роль c profile на user

            $profile->remove($profile);


        } catch (ErrorException $exception) {

            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->getFlash('error', 'Ошибка удаления');

        }

        Yii::$app->session->setFlash('success', 'Профиль успешно удалён');
        return $this->goHome();
    }


}