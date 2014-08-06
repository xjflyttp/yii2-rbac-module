<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var backend\models\search\DataSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Rbac';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rbac-default-index">
    <?=
    GridView::widget([
        'dataProvider' => $userDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            $userIdField,
            $userNameField,
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
