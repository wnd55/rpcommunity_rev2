<?php

namespace backend\modules\rbac\controllers;

use backend\models\AddressSearchForm;
use backend\modules\rbac\entities\AuthAssignment;
use common\models\User;
use yii\helpers\VarDumper;
use yii\web\Controller;
use backend\modules\rbac\forms\AuthAssignmentsSearch;
use backend\modules\rbac\forms\ItemChildrenSearch;
use backend\modules\rbac\forms\AuthAssignmentForm;
use backend\modules\rbac\forms\ItemChildrenForm;
use backend\modules\rbac\forms\PermissionCreateForm;
use backend\modules\rbac\RoleManager;
use Yii;
use backend\modules\rbac\forms\RoleSearch;
use yii\filters\VerbFilter;
use backend\modules\rbac\forms\RoleCreateForm;
use backend\modules\rbac\forms\RoleEditForm;
use yii\web\NotFoundHttpException;
use backend\modules\rbac\entities\AuthItem;
use yii\filters\AccessControl;

/**
 * Default controller for the `rbac` module
 */
class DefaultController extends Controller
{

    /**
     * @var RoleManager
     */
    public $roleManager;

    /**
     * RoleController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param RoleManager $roleManager
     * @param array $config
     */
    public function __construct($id, $module, RoleManager $roleManager, array $config = [])
    {

        parent::__construct($id, $module, $config);

        $this->roleManager = $roleManager;

    }

    /**
     * @inheritdoc
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete-role' => ['POST'],
                    'delete-item-children' => ['POST'],
                    'delete-auth-assignment' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * @return string
     */
    public function actionRole()
    {
        $searchAuthItem = new RoleSearch();
        $providerAuthItem = $searchAuthItem->search(Yii::$app->request->queryParams);

        $searchItemChildren = new ItemChildrenSearch();
        $providerItemChildren = $searchItemChildren->search(Yii::$app->request->queryParams);

        $searchAuthAssignments = new AuthAssignmentsSearch();
        $providerAuthAssignments = $searchAuthAssignments->search(Yii::$app->request->queryParams);

        return $this->render('role', [
            'providerAuthItem' => $providerAuthItem,
            'searchAuthItem' => $searchAuthItem,
            'providerItemChildren' => $providerItemChildren,
            'searchItemChildren' => $searchItemChildren,
            'providerAuthAssignments' => $providerAuthAssignments,
            'searchAuthAssignments' => $searchAuthAssignments
        ]);

    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreateRole()
    {

        $form = new RoleCreateForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->roleManager->createRole($form->name, $form->description);
                return $this->redirect('role');
            } catch (\DomainException $e) {

                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create-role', ['model' => $form]);

    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreatePermission()
    {
        $form = new PermissionCreateForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->roleManager->createPermission($form->name, $form->description);
                return $this->redirect('role');
            } catch (\DomainException $e) {

                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create-permission', ['model' => $form]);

    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreateItemChildren()
    {
        $form = new ItemChildrenForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->roleManager->createItemChildren($form->parent, $form->child);
                return $this->redirect('role');
            } catch (\DomainException $e) {

                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create-item-children', ['model' => $form]);


    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreateAuthAssignment()
    {

        $form = new AuthAssignmentForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {

            try {
                $this->roleManager->createAuthAssignment($form->role, $form->userId);
                return $this->redirect('role');

            } catch (\DomainException $exception) {

                Yii::$app->errorHandler->logException($exception);
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }

        }
        return $this->render('create-auth-assignment', ['model' => $form]);

    }

    /**
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDeleteRole($name)
    {

        $this->roleManager->deleteRoleOrPermission($name);

        return $this->redirect('role');

    }

    /**
     * @param $name
     * @return string
     */
    public function actionViewRole($name)
    {

        return $this->render('view-role', [
            'model' => $this->findRole($name),
        ]);

    }

    /**
     * @param $name
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function findRole($name)
    {
        if (($model = AuthItem::findOne($name)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    /**
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionUpdateRole($name)
    {
        $role = $this->findRole($name);

        $form = new RoleEditForm($role);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $role = $this->roleManager->updateRoleOrPermission($form, $role->name);
                return $this->redirect(['view-role', 'name' => $role->name]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update-role', [
            'model' => $form,
            'role' => $role

        ]);

    }

    /**
     * @param $parent
     * @param $child
     * @return \yii\web\Response
     */
    public function actionDeleteItemChildren($parent, $child)
    {
        $this->roleManager->deleteItemChildren($parent, $child);
        return $this->redirect('role');
    }

    /**
     * @param $item_name
     * @param $userId
     * @return \yii\web\Response
     */
    public function actionDeleteAuthAssignment($item_name, $userId)
    {
        $this->roleManager->deleteAuthAssignment($item_name, $userId);
        return $this->redirect('role');

    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
