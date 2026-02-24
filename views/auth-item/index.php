<?php
use app\models\AuthItem;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\AuthItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Auth',
    'createLabel' => 'Create Auth Item',
    'tableId' => 'auth-item-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Type', 'value' => 'type'],
        ['label' => 'Description', 'value' => 'description'],
        ['label' => 'Rule Name', 'value' => 'rule_name'],
        ['label' => 'Data', 'value' => 'data'],
    ],
    'actionParams' => function (AuthItem $model) {
        return ['name' => $model->name];
    },
]);
