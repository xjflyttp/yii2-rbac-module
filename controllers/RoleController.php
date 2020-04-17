<?php

namespace xj\rbac\controllers;

use Yii;
use xj\rbac\componments\Controller;
use yii\web\NotFoundHttpException;
use xj\rbac\models\ItemForm;

class RoleController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->rbacMenu = [
            ['label' => '新建', 'url' => ['create']],
        ];
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $auth = $this->getAuth();
        $roles = $auth->getRoles();

        return $this->render('index', [
            'roles' => $roles,
        ]);
    }

    public function actionCreate()
    {
        $model = new ItemForm(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $auth = $this->getAuth();
            $role = $auth->createRole($model->name);
            $role->description = $model->desc;
            $role->data = $model->data;
            $role->createdAt = $role->updatedAt = isset($_SERVER['REQUEST_TIME']) ? $_SERVER['REQUEST_TIME'] : time();
            $auth->add($role);

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($name)
    {
        $model = new ItemForm();
        $model->setScenario('update');

        $role = $this->findModel($name);
        $model->name = $role->name;
        $model->data = $role->data;
        $model->desc = $role->description;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $auth = $this->getAuth();
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
    public function actionDelete($name)
    {
        $this->getAuth()->remove($this->findModel($name));
        return $this->redirect(['index']);
    }

    /**
     * find role
     * @param string $name
     * @return Role
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        $auth = $this->getAuth();
        if (($role = $auth->getRole($name)) !== null) {
            return $role;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
