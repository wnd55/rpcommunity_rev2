<?php

namespace backend\controllers;

use Yii;
use backend\models\MetersData;
use backend\models\MetersDataSearchForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MetersDataController implements the CRUD actions for MetersData model.
 */
class MetersDataController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MetersData models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MetersDataSearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MetersData model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing MetersData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idmetersdata]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MetersData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionExportExcel()
    {
        $query = MetersData::find();

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

        $query = MetersData::find()
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
     * Finds the MetersData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MetersData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MetersData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
