<?php

namespace backend\controllers;

use backend\models\HostSettings;
use backend\models\LogsSearchForm;
use backend\models\SystemLog;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'host-settings',
                            'delete-setting', 'logs', 'view-log', 'delete-log', 'delete-all-logs'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete-setting' => ['post'],
                    'delete-log' => ['post'],
                    'delete-all-logs' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout = 'backendLogin';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string
     */
    public function actionHostSettings()
    {
        $settings = HostSettings::find()->all();

        $hostSettings = [new HostSettings()];

        if (Model::loadMultiple($hostSettings, Yii::$app->request->post()) && Model::validateMultiple($hostSettings)) {

            foreach ($hostSettings as $setting) {

                $setting->save(false);
            }
            return $this->redirect('host-settings');
        }

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {

            foreach ($settings as $setting) {

                $setting->save(false);
            }
            return $this->redirect('host-settings');
        }


        return $this->render('host-settings', ['hostSettings' => $hostSettings, 'settings' => $settings]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \ErrorException
     */
    public function actionDeleteSetting($id)
    {
        $setting = HostSettings::findOne($id);
        if (!$setting->delete()) {

            throw new \ErrorException('Ошибка удаления');
        }

        return $this->redirect('host-settings');
    }


    /**
     * @return string
     */
    public function actionLogs()
    {
        $logsSearch = new LogsSearchForm();

        $dataProvider = $logsSearch->search(Yii::$app->request->queryParams);

        return $this->render('logs', [

            'dataProvider' => $dataProvider,
            'logsSearch' => $logsSearch
        ]);

    }

    /**
     * @param $id
     * @return string
     */
    public function actionViewLog($id)
    {

        $log = SystemLog::findOne($id);

        return $this->render('view-log', ['model' => $log]);

    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDeleteLog($id)
    {

        $log = SystemLog::findOne($id);

         $log->delete();

       return $this->redirect(['logs']);

    }

    public function actionDeleteAllLogs()
    {
        SystemLog::deleteAll();

        return $this->redirect(['index']);
    }
}
