<?php

/**
 * Roles List
 */
use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$urlGetRoleAssign = Url::to(['get-role-assign-list']);
$urlGrant = Url::to(['grant-perms']);
$urlRevoke = Url::to(['revoke-perms']);

$this->registerJs(<<<EOF
rbacPermAssign.urlGetAssign = '{$urlGetRoleAssign}';
rbacPermAssign.urlGrant = '{$urlGrant}';
rbacPermAssign.urlRevoke = '{$urlRevoke}';
rbacPermAssign.bind('ColA','ColB','ColC', 'btnGrant', 'btnRevoke');
EOF
        , View::POS_READY);

$this->title = '权限指派';
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
            'field1Text' => '角色',
            'field2Text' => '已分配',
            'field3Text' => '未分配',
            'btn1Label' => '分配',
            'btn2Label' => '撤销',
            'models' => $roleModels
        ])
        ?>
    </div>
</div>
