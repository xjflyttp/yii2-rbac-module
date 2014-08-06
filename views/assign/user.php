<?php

/**
 * Roles List
 */
use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$urlGetUserAssign = Url::to(['get-user-assign-list']);
$urlGrant = Url::to(['grant-roles']);
$urlRevoke = Url::to(['revoke-roles']);

$this->registerJs(<<<EOF
rbacRoleAssign.urlGetAssign = '{$urlGetUserAssign}';
rbacRoleAssign.urlGrant = '{$urlGrant}';
rbacRoleAssign.urlRevoke = '{$urlRevoke}';
rbacRoleAssign.bind('ColA','ColB','ColC', 'btnGrant', 'btnRevoke');
EOF
        , View::POS_READY);

$this->title = '角色指派';
$this->params['breadcrumbs'][] = ['label' => 'Rbac', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default rbac">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title); ?></h3>
    </div>
    <div class="panel-body">
        <?=
        $this->render('_form', [
            'field1Text' => '用户',
            'field2Text' => '已授予',
            'field3Text' => '未授予',
            'btn1Label' => '授予',
            'btn2Label' => '撤销',
            'models' => $userModels
        ])
        ?>
    </div>
</div>
