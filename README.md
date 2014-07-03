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
];
`````````````````````

### access
```````````
http://project/index.php?r=rbac
````````````