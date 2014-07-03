<?php

/**
 * rbac模块
 * 
 * @example
 * 
 * //config
 * 
 $config['components']['authManager'] => [
    'class' => 'yii\rbac\PhpManager',
    'itemFile' => '@common/rbac/items.php',
    'assignmentFile' => '@common/rbac/assignments.php',
    'ruleFile' => '@common/rbac/rules.php',
];
 * 
$config['modules']['rbac'] = [
    'class' => 'xj\rbac\Module',
    'userIdField' => 'uid',
    'userNameField' => 'username',
    'userTableModelName' => '\common\models\Members',
];
 */

namespace xj\rbac;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'xj\rbac\controllers';
    public $userIdField = 'id';
    public $userNameField = 'name';
    public $userTableModelName = '\common\models\Members';
    public $layout;

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

}
