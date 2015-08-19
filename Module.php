<?php

/**
 * rbac模块
 *
 * @example
 *
 * //config
 *
 * $config['components']['authManager'] => [
 * 'class' => 'yii\rbac\PhpManager',
 * 'itemFile' => '@common/rbac/items.php',
 * 'assignmentFile' => '@common/rbac/assignments.php',
 * 'ruleFile' => '@common/rbac/rules.php',
 * ];
 *
 * $config['modules']['rbac'] = [
 * 'class' => 'xj\rbac\Module',
 * 'userIdField' => 'uid',
 * 'userNameField' => 'username',
 * 'userTableModelName' => '\common\models\Members',
 * 'allowedIPs' => ['127.0.0.1', '::1'],
 * 'layout' => 'main-parent',
 * ];
 */

namespace xj\rbac;

use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'xj\rbac\controllers';
    public $userIdField = 'id';
    public $userNameField = 'name';
    public $userTableModelName = '\common\models\Members';
    public $allowedIPs = ['127.0.0.1', '::1'];
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app instanceof \yii\web\Application && !$this->checkAccess()) {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }

        return true;
    }

    /**
     * @return boolean whether the module can be accessed by the current user
     */
    protected function checkAccess()
    {
        $ip = Yii::$app->getRequest()->getUserIP();
        foreach ($this->allowedIPs as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                return true;
            }
        }
        Yii::warning('Access to Rbac is denied due to IP address restriction. The requested IP is ' . $ip, __METHOD__);

        return false;
    }
}
