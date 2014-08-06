<?php

namespace xj\rbac\controllers;

use Yii;
use xj\rbac\componments\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        return $this->redirect(['perm/index']);
    }

}
