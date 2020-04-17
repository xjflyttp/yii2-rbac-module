<?php
/**
 * Roles List
 */

$this->title = '权限管理';
$this->params['breadcrumbs'][] = ['label' => 'Rbac', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Permissions</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>RuleName</td>
                    <td>Data</td>
                    <td>CreatedAt</td>
                    <td>UpdatedAt</td>
                    <td>Operation</td>
                </tr>
                <?php foreach ($perms as $perm) : ?>
                    <?php /* @var $perm \yii\rbac\Permission */ ?>
                    <tr>
                        <td><?= Html::encode($perm->name); ?></td>
                        <td><?= Html::encode($perm->description); ?></td>
                        <td><?= Html::encode($perm->ruleName); ?></td>
                        <td><?= Html::encode($perm->data); ?></td>
                        <td><?= \Yii::$app->formatter->asDate($perm->createdAt); ?></td>
                        <td><?= \Yii::$app->formatter->asDate($perm->updatedAt); ?></td>
                        <td>
                            <?=
                            Html::a('编辑', ['update', 'name' => $perm->name], [
                                'class' => 'btn btn-warning',
                            ])
                            ?>
                            <?=
                            Html::a('删除', ['delete', 'name' => $perm->name], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => '确认删除？',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
