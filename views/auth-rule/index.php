<?php
use app\models\AuthRule;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\AuthRuleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Auth Rules';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Auth',
    'createLabel' => 'Create Auth Rule',
    'tableId' => 'auth-rule-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Data', 'value' => 'data'],
        ['label' => 'Created At', 'value' => 'created_at'],
        ['label' => 'Updated At', 'value' => 'updated_at'],
    ],
    'actionParams' => function (AuthRule $model) {
        return ['name' => $model->name];
    },
]);
