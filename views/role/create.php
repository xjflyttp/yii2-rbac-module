<?php

use yii\helpers\Html;
use common\rbac\models\RoleForm;

/**
 * @var yii\web\View $this
 * @var RoleForm $model
 */
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
    
</div>
