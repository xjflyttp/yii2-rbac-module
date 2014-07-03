<?php

use yii\helpers\Html;
use common\rbac\models\RoleForm;

/**
 * @var yii\web\View $this
 * @var RoleForm $model
 */
$this->title = 'Edit. ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rbac', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
