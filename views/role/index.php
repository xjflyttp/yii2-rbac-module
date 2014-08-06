<?php
/**
 * Roles List
 */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = ['label' => 'Rbac', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Roles</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Data</td>
                    <td>CreatedAt</td>
                    <td>UpdatedAt</td>
                    <td>Operation</td>
                </tr>
                <?php foreach ($roles as $role) : ?>
                    <?php /* @var $role \yii\rbac\Role */ ?>
                    <tr>
                        <td><?= Html::encode($role->name); ?></td>
                        <td><?= Html::encode($role->description); ?></td>
                        <td><?= Html::encode($role->data); ?></td>
                        <td><?= \Yii::$app->formatter->asDate($role->createdAt); ?></td>
                        <td><?= \Yii::$app->formatter->asDate($role->updatedAt); ?></td>
                        <td>
                            <?=
                            Html::a('编辑', ['update', 'name' => $role->name], [
                                'class' => 'btn btn-warning',
                            ])
                            ?>
                            <?=
                            Html::a('删除', ['delete', 'name' => $role->name], [
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
