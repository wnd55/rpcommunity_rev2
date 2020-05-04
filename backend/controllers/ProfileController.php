<?php

namespace backend\controllers;


use backend\models\Profile;
use backend\models\ProfileCreateForm;
use Yii;
use backend\models\ProfileSearchForm;
use yii\base\ErrorException;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{

    private $profile;

    public function __construct($id, $module, Profile $profile, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->profile = $profile;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST']
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $profileSearch = new ProfileSearchForm();

        $provider = $profileSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', ['provider' => $provider, 'profileSearch' => $profileSearch]);


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
                return $this->redirect(['index']);

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
                $this->profile->edit($model, $profile);
                Yii::$app->session->setFlash('success', 'Профиль успешно создан');
                return $this->redirect(['index']);

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
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $profile = $this->findModel($id);
        try {

            $this->profile->remove($profile);

            //TODO вернуть роль user

        } catch (ErrorException $exception) {

            Yii::$app->errorHandler->logException($exception);
            Yii::$app->session->getFlash('error', 'Ошибка удаления');

        }

        return $this->redirect('index');
    }
}

