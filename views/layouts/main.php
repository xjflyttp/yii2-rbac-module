<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$asset = xj\rbac\RbacAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'RBAC',
            'brandUrl' => ['default/index'],
            'options' => ['class' => 'navbar-inverse'],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar-right'],
            'items' => [
                ['label' => '角色管理', 'url' => ['role/index']],
                ['label' => '权限管理', 'url' => ['perm/index']],
                ['label' => '规则管理', 'url' => ['rule/index']],
                ['label' => '权限指派', 'url' => ['assign/index']],
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container rbac">
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

        <footer class="footer">
            <div class="container">
                <p class="pull-left">A Product of <a href="http://www.yiisoft.com/">Yii Software LLC</a></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
