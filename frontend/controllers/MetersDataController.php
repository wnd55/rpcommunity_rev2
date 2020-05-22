<?php

namespace frontend\controllers;

use common\models\MetersData;
use common\models\User;
use frontend\models\MetersDataSearchForm;
use Yii;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class MetersDataController extends Controller
{


    private $metersData;

    public function __construct($id, $module, MetersData $metersData, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->metersData = $metersData;

    }

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
                        'roles' => ['user', 'moderator', 'admin', 'profile'],
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
     * @return string
     */
    public function actionIndex()
    {
        $counters = $this->metersData->checkCounters();
        $searchModel = new MetersDataSearchForm();
        $provider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['provider' => $provider, 'searchModel' => $searchModel, 'counters' => $counters]);

    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = User::findOne(['id' => Yii::$app->user->id]);

        if(!isset($user->profile)){
            Yii::$app->session->setFlash('warning', 'Необходимо заполнить данные счётчиков воды');
            return $this->redirect(['water-meter/index']);
        }

        $this->metersData->fillData();

        if ($this->metersData->load(Yii::$app->request->post()) && $this->metersData->validate()) {

            try {
                $metersData = MetersData::createMetersData($this->metersData);
                Yii::$app->session->setFlash('success', 'Показания расхода воды успешно добавлены');
                return $this->redirect(['view', 'id' => $metersData->idmetersdata]);

            } catch (ErrorException $exception) {

                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', 'Ошибка сохранения');
            }
        }

        return $this->render('create', ['model' => $this->metersData]);


    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->wmcold3 !== 0 && $model->wmhot3 !== 0) {

            $model->scenario = MetersData::SCENARIO_THIRD_COUNTER;

        } else {

            $model->twoCounters = true;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $this->metersData->edit($model);
                return $this->redirect(['view', 'id' => $id]);

            } catch (ErrorException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', 'Ошибка сохранения');
            }
            if (isset($model->errors)) {

                Yii::$app->session->setFlash('error', 'Ошибка валидации данных');

            }
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * @param $id
     * @return MetersData the loaded model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {

        if (($model = MetersData::findOne($id)) !== null) {

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
        $metersData = $this->findModel($id);

        try {

            $this->metersData->remove($metersData);

        } catch (ErrorException $exception) {

            Yii::$app->session->getFlash('error', 'Ошибка удаления');
            Yii::$app->errorHandler->logException($exception);
        }


        return $this->redirect('index');
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
     * @return string
     */
    public function actionExportExcel()
    {
        $query = MetersData::find()->where(['user_id' => Yii::$app->user->id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'idmetersdata' => SORT_DESC,
                ],
            ]
        ]);


        return $this->render('export-excel', ['provider' => $provider]);

    }

    /**
     * @param $from_date
     * @param $to_date
     * @return string
     */
    public function actionSearchExportExcel($from_date, $to_date)
    {

        $query = MetersData::find()->where(['user_id' => Yii::$app->user->id])
            ->andFilterWhere(['>=', 'created_at', $from_date ? strtotime($from_date . '00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $to_date ? strtotime($to_date . '23:59:59') : null]);


        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'idmetersdata' => SORT_DESC,
                ],
            ]
        ]);
        return $this->render('search-export-excel', ['provider' => $provider, 'from_date' => $from_date, 'to_date' => $to_date]);

    }

    /**
     * @param $id
     * @return mixed|null|string
     * @throws ErrorException
     */
    public function actionMetersDataEmail($id)
    {

        $model = $this->findModel($id);

        $user = User::findOne(['id' => Yii::$app->user->id]);

        $send = Yii::$app->mailer->compose(['html' => 'metersDataEmail-html'], ['model' => $model])
            ->setTo($user->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject('Показания воды')
            ->send();

        if (!$send) {

            throw new ErrorException('Ошибка отправки почты');
        } else {
            Yii::$app->session->setFlash('success', 'Письмо успешно отправлено!');
            return $this->redirect(['view',
                'id' => $id,
                'model' => $model]);
        }
    }

}