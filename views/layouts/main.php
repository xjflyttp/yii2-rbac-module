<?php
/* @var $this \yii\web\View */
use yii\widgets\Breadcrumbs;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\helpers\Html;
use xj\rbac\RbacAsset;

?><?php $this->beginContent('@app/views/layouts/main.php'); ?>

<?php RbacAsset::register($this); ?>
<div class="rbac">
    <div class="well">
        <?= Html::a('角色管理', ['role/index'], ['class' => 'btn btn-primary btn-default', 'role' => 'button']) ?>
        <?= Html::a('权限管理', ['perm/index'], ['class' => 'btn btn-info btn-default', 'role' => 'button']) ?>
        <?= Html::a('权限指派', ['assign/index'], ['class' => 'btn btn-warning btn-default', 'role' => 'button']) ?>
    </div>
    <div class="row">
        <div class="col-md-10">
            <?= $content; ?>
        </div>
        <div class="col-md-2">
            <?php foreach ($this->context->rbacMenu as $menu): ?>
                <p><?= Html::a($menu['label'], $menu['url'], ['class' => 'btn btn-success btn-default', 'role' => 'button']) ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>

