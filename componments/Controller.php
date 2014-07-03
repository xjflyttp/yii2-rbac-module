<?php

namespace xj\rbac\componments;
use yii\rbac\BaseManager;

class Controller extends \yii\web\Controller {

    public $layout = 'main';
    public $rbacMenu = [];

    /**
     * @return BaseManager
     */
    public function getAuth() {
        return \Yii::$app->authManager;
    }
    
}
