yii2-rbac-module
=======================


composer.json
===================
````````
"require": {
    "yii2-rbac-module": "*"
},
````````

### config
`````````````````````php
 $config['components']['authManager'] => [
    'class' => 'yii\rbac\PhpManager',
    'itemFile' => '@common/rbac/items.php',
    'assignmentFile' => '@common/rbac/assignments.php',
    'ruleFile' => '@common/rbac/rules.php',
];

$config['modules']['rbac'] = [
    'class' => 'xj\rbac\Module',
    'userIdField' => 'uid',
    'userNameField' => 'username',
    'userTableModelName' => '\common\models\Members',
    'allowedIPs' => ['127.0.0.1', '::1'], //dump from yii\gii
    'layout' => 'main',  //main-parent=use app main | main=rbac layout
];
`````````````````````

### access
```````````
http://project/index.php?r=rbac
````````````