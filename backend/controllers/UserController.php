<?php

namespace backend\controllers;

use backend\models\SystemLog;
use backend\modules\rbac\entities\AuthAssignment;
use Yii;
use common\models\User;
use backend\models\UsersSearchForm;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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

                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-selected' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UsersSearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'sort' => $sort
        ]);
    }

    /**
     * Displays a single User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $roleUser = $auth->getRolesByUser($id);

        if (isset($roleUser['moderator']) || isset($roleUser['admin'])) {

            Yii::$app->session->setFlash('warning', 'Администратора удалить нельзя');

            return $this->redirect(['index']);
        }

        if (!isset($user->profile)) {

            $authAssignment = AuthAssignment::findOne(['user_id' => $user->id]);

            if (isset($authAssignment)) {
                $authAssignment->delete();
                $user->delete();
            } else {

                $user->delete();
            }
            Yii::$app->session->setFlash('success', 'Регистрация удалена');
            return $this->redirect(['index']);

        } else {

            Yii::$app->session->setFlash('error', 'Регистрация содержит активный профиль, необходимо удалить профиль');
            return $this->redirect(['index']);
        }


    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionDeleteSelected()
    {
        if (!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException(400, 'Only ajax request is allowed.');
        }

        $users = User::find()->where(['in', 'id', Yii::$app->request->post('id')])->joinWith('profile')->all();


        foreach ($users as $user) {

            if (!isset($user->profile)) {

                $auth = Yii::$app->authManager;
                $roleUser = $auth->getRolesByUser($user->id);

                if (isset($roleUser['moderator']) || isset($roleUser['admin'])) {

                    Yii::$app->session->setFlash('warning', 'Администратора удалить нельзя');

                    return $this->redirect(['index']);
                }

                $authAssignment = AuthAssignment::findOne(['user_id' => $user->id]);

                if (isset($authAssignment)) {
                    $authAssignment->delete();
                    $user->delete();
                } else {

                    $user->delete();
                }


            } else {

                return 'Error';
            }
        }

        $data = 'User deleted';
        return $data;

    }


}
