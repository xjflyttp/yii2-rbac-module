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
                    <td>CreatedAt</td>
                    <td>UpdatedAt</td>
                    <td>Operation</td>
                </tr>
                <?php foreach ($rules as $rule) : ?>
                    <?php /* @var $rule \yii\rbac\Rule */ ?>
                    <tr>
                        <td><?= Html::encode($rule->name); ?></td>
                        <td><?= \Yii::$app->formatter->asDate($rule->createdAt); ?></td>
                        <td><?= \Yii::$app->formatter->asDate($rule->updatedAt); ?></td>
                        <td>
                            <?=
                            Html::a('删除', ['delete', 'name' => $rule->name], [
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
