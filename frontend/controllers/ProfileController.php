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
                        'roles' => ['user', 'moder', 'admin'],
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

    public function actionCreate()
    {

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
     * @return string
     */
    public function actionView()
    {
        $id = Yii::$app->user->id;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * @param $id
     * @return null|\yii\web\Response|static
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne(['user_id' => $id])) !== null) {
            return $model;
        } else {

            return $this->redirect('create', ['userId' => $id]);
        }
    }


}