<?php

namespace xj\rbac\controllers;

use Yii;
use xj\rbac\componments\Controller;
use yii\web\NotFoundHttpException;
use xj\rbac\models\ItemForm;
use yii\rbac\Permission;

class PermController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->rbacMenu = [
            ['label' => '新建', 'url' => ['create']],
        ];
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $request = Yii::$app->request;
        $user = $request->getQueryParam('user');
        $role = $request->getQueryParam('role');

        $auth = $this->getAuth();
        if ($user) {
            $perms = $auth->getPermissionsByUser($user);
        } elseif ($role) {
            $perms = $auth->getPermissionsByRole($role);
        } else {
            $perms = $auth->getPermissions();
        }

        return $this->render('index', [
                    'perms' => $perms,
        ]);
    }

    public function actionCreate() {
        $model = new ItemForm(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $auth = $this->getAuth();
            $perm = $auth->createPermission($model->name);
            $perm->description = $model->desc;
            $perm->data = $model->data;
            $perm->ruleName = $model->ruleName;
            $perm->createdAt = $perm->updatedAt = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
            $auth->add($perm);

            return $this->redirect(['index']);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($name) {
        $model = new ItemForm();
        $model->setScenario('update');

        $role = $this->findModel($name);
        $model->name = $role->name;
        $model->ruleName = $role->ruleName;
        $model->data = $role->data;
        $model->desc = $role->description;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = $this->getAuth();
            $role->ruleName = $model->ruleName;
            $role->description = $model->desc;
            $role->data = $model->data;
            $role->updatedAt = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : \time();
            $auth->update($name, $role);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * 删除Role
     * @param string $admin
     * @return mixed
     */
    public function actionDelete($name) {
        $this->getAuth()->remove($this->findModel($name));
        return $this->redirect(['index']);
    }

    /**
     * find role
     * @param string $name
     * @return Permission
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name) {
        $auth = $this->getAuth();
        if (($role = $auth->getPermission($name)) !== null) {
            return $role;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
