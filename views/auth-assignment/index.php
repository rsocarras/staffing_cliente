<?php
use app\models\AuthAssignment;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\AuthAssignmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Auth Assignments';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Auth',
    'createLabel' => 'Create Auth Assignment',
    'tableId' => 'auth-assignment-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'Item Name', 'value' => 'item_name'],
        ['label' => 'User ID', 'value' => 'user_id'],
        ['label' => 'Created At', 'value' => 'created_at'],
    ],
    'actionParams' => function (AuthAssignment $model) {
        return ['item_name' => $model->item_name, 'user_id' => $model->user_id];
    },
]);
