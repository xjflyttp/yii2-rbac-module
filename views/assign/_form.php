<?php

/**
 * 授权表单
 */
/* @var $field1Text string */
/* @var $field2Text string */
/* @var $field3Text string */
/* @var $btn1Label string */
/* @var $btn2Label string */
use yii\helpers\Html;
?>
<div class="table-responsive">
    <table class="table table-bordered assign-form">
        <tr>
            <td class="header-name"><?= Html::encode($field1Text) ?></td>
            <td><?= Html::encode($field2Text) ?></td>
            <td class="operation">操作</td>
            <td><?= Html::encode($field3Text) ?></td>
        </tr>
        <tr>
            <td>
                <?= Html::dropDownList('ColA', [], $models, ['multiple' => true, 'id' => 'ColA']) ?>
            </td>
            <td><?= Html::dropDownList('ColB', [], [], ['multiple' => true, 'id' => 'ColB']) ?></td>
            <td>
                <?=
                \yii\bootstrap\ButtonGroup::widget([
                    'options' => ['class' => 'btn-group-vertical'],
                    'buttons' => [
                        ['label' => $btn1Label, 'options' => ['class' => 'btn-success', 'id' => 'btnGrant']],
                        ['label' => $btn2Label, 'options' => ['class' => 'btn-warning', 'id' => 'btnRevoke']],
                    ]
                ]);
                ?>
            </td>
            <td><?= Html::dropDownList('ColC', [], [], ['multiple' => true, 'id' => 'ColC']) ?></td>
        </tr>
    </table>
</div>