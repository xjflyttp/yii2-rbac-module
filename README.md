# yii2-rbac-module


## composer.json
```json
"xj/yii2-rbac-module": "~1.0.0",
```

### config
---
```php
'components' => [
    'authManager' => [
        'class' => 'yii\rbac\PhpManager',
        'itemFile' => '@common/rbac/items.php',
        'assignmentFile' => '@common/rbac/assignments.php',
        'ruleFile' => '@common/rbac/rules.php',
    ],
],
```

#### IP & Roles
---
```php
'modules' => [
    'rbac' => [
        'class' => 'xj\rbac\Module',
        'userIdField' => 'id',
        'userNameField' => 'username',
        'userTableModelName' => '\common\models\Admin',
        'allowedIPs' => ['127.0.0.1', '::1'],
        'roles' => ['admin'],
    ]
],
```
#### IP Only
---
```php
'modules' => [
    'rbac' => [
        'class' => 'xj\rbac\Module',
        'userIdField' => 'id',
        'userNameField' => 'username',
        'userTableModelName' => '\common\models\Admin',
        'layout' => 'main', //optional
        'allowedIPs' => ['127.0.0.1', '::1'],
        'roles' => ['*'],
    ]
],
```
#### Role Only
---
```php
'modules' => [
    'rbac' => [
        'class' => 'xj\rbac\Module',
        'userIdField' => 'id',
        'userNameField' => 'username',
        'userTableModelName' => '\common\models\Admin',
        'allowedIPs' => ['*'],
        'roles' => ['admin'],
    ]
],
```
### access
---
```
http://project/index.php?r=rbac
```
