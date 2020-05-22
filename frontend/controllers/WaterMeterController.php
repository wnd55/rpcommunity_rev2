<?php
namespace frontend\controllers;

use common\models\User;
use common\models\WaterMeter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii;
use yii\widgets\ActiveForm;
use yii\base\ErrorException;
use yii\filters\VerbFilter;


class WaterMeterController extends Controller
{
    /**
     * @var WaterMeter
     */
    private $waterMeter;

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
                    'delete' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * WaterMeterController constructor.
     * @param string $id
     * @param yii\base\Module $module
     * @param WaterMeter $waterMeter
     * @param array $config
     */
    public function __construct($id, $module, WaterMeter $waterMeter, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->waterMeter = $waterMeter;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $waterMeter = WaterMeter::find()->where(['user_id' => \Yii::$app->user->id]);
        $provider = new ActiveDataProvider(['query' => $waterMeter]);

        return $this->render('index', ['provider' => $provider]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

       $user = User::findOne(['id' => Yii::$app->user->id]);

       if(!isset($user->profile)){
           Yii::$app->session->setFlash('warning', 'Необходимо заполнитиь данные профиля');
           return $this->redirect(['profile/create']);
       }
        $model = new WaterMeter();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $waterMeter = Watermeter::createWatermeter($model);
                Yii::$app->session->setFlash('success', 'Счётчики воды успешно добавлены');
                return $this->redirect(['view', 'id' => $waterMeter->idwatermeter]);

            } catch (ErrorException $exception) {
                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', 'Ошибка сохранения');


            }
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * @param $id
     * @return string|yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(yii::$app->request->post()) && $model->validate()) {

            try {
                $this->waterMeter->edit($id, $model);
                return $this->redirect(['view', 'id' => $id]);
            } catch (ErrorException $exception) {

                //yii::$app->session->getFlash('error', 'Ошибка сохранения');
                yii::$app->errorHandler->logException($exception);
            }

        }

        return $this->render('update', ['id' => $id, 'model' => $model]);
    }

    /**
     * @param $id
     * @return yii\web\Response
     */
    public function actionDelete($id)
    {
        $waterMeter = $this->findModel($id);
        try {
            $this->waterMeter->remove($waterMeter);

        } catch (ErrorException $exception) {

            yii::$app->session->getFlash('error', 'Ошибка удаления');
            yii::$app->errorHandler->logException($exception);
        }

        return $this->redirect('index');
    }



    /**
     * Displays a single WaterMeter model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Watermeter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WaterMeter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WaterMeter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }


}