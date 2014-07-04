<?php

namespace xj\rbac\componments;
use yii\rbac\BaseManager;

class Controller extends \yii\web\Controller {

    public $rbacMenu = [];

    public function init() {
        $this->layout = $this->module->layout;
        return parent::init();
    }


    /**
     * @return BaseManager
     */
    public function getAuth() {
        return \Yii::$app->authManager;
    }
    
}
