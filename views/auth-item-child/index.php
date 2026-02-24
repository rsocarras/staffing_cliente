<?php
use app\models\AuthItemChild;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\AuthItemChildSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Auth Item Children';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Auth',
    'createLabel' => 'Create Auth Item Child',
    'tableId' => 'auth-item-child-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'Parent', 'value' => 'parent'],
        ['label' => 'Child', 'value' => 'child'],
    ],
    'actionParams' => function (AuthItemChild $model) {
        return ['parent' => $model->parent, 'child' => $model->child];
    },
]);
