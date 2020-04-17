<?php

namespace xj\rbac\controllers;

use Yii;
use xj\rbac\componments\Controller;
use yii\web\NotFoundHttpException;
use xj\rbac\models\ItemForm;

class RuleController extends Controller
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
//            ['label' => '新建', 'url' => ['create']],
        ];
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $auth = $this->getAuth();
        $rules = $auth->getRules();

        return $this->render('index', [
            'rules' => $rules,
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
     * @return Rule
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        $auth = $this->getAuth();
        if (($role = $auth->getRule($name)) !== null) {
            return $role;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
