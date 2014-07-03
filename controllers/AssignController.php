<?php

namespace xj\rbac\controllers;

use Yii;
use xj\rbac\componments\Controller;
use xj\rbac\models\ItemForm;
use yii\helpers\Json;

class AssignController extends Controller {

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
            ['label' => '角色指派', 'url' => ['user']],
            ['label' => '权限指派', 'url' => ['role']],
        ];
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        return $this->redirect(['user']);
    }

    public function actionUser($user = null) {
        $userTableName = $this->module->userTableModelName;
        $userIdField = $this->module->userIdField;
        $userNameField = $this->module->userNameField;
        $userModel = $userTableName::find()->select([$userIdField, $userNameField]);
        $userDataprovider = new \yii\data\ActiveDataProvider([
            'query' => $userModel,
        ]);

        return $this->render('user', [
                    'userDataprovider' => $userDataprovider,
                    'userModels' => \yii\helpers\ArrayHelper::map($userDataprovider->getModels(), $userIdField, $userNameField),
        ]);
    }

    public function actionRole() {
        $roles = [];
        foreach ($this->getAuth()->getRoles() as $name => $role) {
            $roles[$name] = $name;
        }

        return $this->render('role', [
                    'roleModels' => $roles,
        ]);
    }

    /**
     * 取得用户 已授权 和 未授权 的角色
     * @param int $uid 用户ID
     * @return string JSON字串
     */
    public function actionGetUserAssignList($uid) {
        $auth = $this->getAuth();
        $assignRoles = $this->rolesToArray($auth->getRolesByUser($uid));
        $allRoles = $this->rolesToArray($auth->getRoles());
        $unassignRoles = array_diff($allRoles, $assignRoles); //未分配的

        return Json::encode([
                    'unassign' => $unassignRoles,
                    'assign' => $assignRoles,
                        ], JSON_FORCE_OBJECT);
    }
    
    /**
     * 取得角色 已分配 和 未分配 的权限
     * @param string $role 角色名
     * @return string JSON字串
     */
    public function actionGetRoleAssignList($role) {
        $auth = $this->getAuth();
        $assignPerms = $this->rolesToArray($auth->getPermissionsByRole($role));
        $allPerms = $this->rolesToArray($auth->getPermissions());
        $unassignRoles = array_diff($allPerms, $assignPerms);
        return Json::encode([
                    'unassign' => $unassignRoles,
                    'assign' => $assignPerms,
                        ], JSON_FORCE_OBJECT);
    }

    /**
     * 添加用户角色
     * @return boolean
     */
    public function actionGrantRoles() {
        $roles = Yii::$app->request->post('roles');
        $uid = Yii::$app->request->post('uid');
        if (empty($roles) || empty($uid)) {
            return false;
        }
        $auth = $this->getAuth();
        foreach ($roles as $roleName) {
            $role = $auth->getRole($roleName);
            $auth->assign($role, $uid);
        }
        return true;
    }

    /**
     * 删除用户角色
     * @return boolean
     */
    public function actionRevokeRoles() {
        $roles = Yii::$app->request->post('roles');
        $uid = Yii::$app->request->post('uid');
        if (empty($roles) || empty($uid)) {
            return false;
        }
        $auth = $this->getAuth();
        foreach ($roles as $roleName) {
            $role = $auth->getRole($roleName);
            $auth->revoke($role, $uid);
        }
        return true;
    }
    
    /**
     * 添加角色权限
     * @return boolean
     */
    public function actionGrantPerms() {
        $perms = Yii::$app->request->post('perms');
        $roleName = Yii::$app->request->post('role');
        if (empty($perms) || empty($roleName)) {
            return false;
        }
        $auth = $this->getAuth();
        $role = $auth->getRole($roleName);
        foreach ($perms as $permName) {
            $perm = $auth->getPermission($permName);
            $auth->addChild($role, $perm);
        }
        return true;
    }
    /**
     * 删除角色权限
     * @return boolean
     */
    public function actionRevokePerms() {
        $perms = Yii::$app->request->post('perms');
        $roleName = Yii::$app->request->post('role');
        if (empty($perms) || empty($roleName)) {
            return false;
        }
        $auth = $this->getAuth();
        $role = $auth->getRole($roleName);
        foreach ($perms as $permName) {
            $perm = $auth->getPermission($permName);
            $auth->removeChild($role, $perm);
        }
        return true;
    }
    
    /**
     * Role Perm Name字段转换成Array 
     * @param [] $roles
     * @return []
     */
    private function rolesToArray($roles) {
        $rolesBuff = [];
        foreach ($roles as $roleName => $role) {
            $rolesBuff[] = $roleName;
        }
        return $rolesBuff;
    }

}
