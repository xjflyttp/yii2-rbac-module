<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\rbac\models\RoleForm;

/* @var $this yii\web\View */
/* @var $model RoleForm  */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 24, 'disabled' => ($model->scenario == 'update') ? true : false]) ?>
    <?= $form->field($model, 'desc')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'data')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
