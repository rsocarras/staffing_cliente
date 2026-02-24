<?php
use app\models\MaestrosConceptos;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\MaestrosConceptosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Maestros Conceptos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Maestros Conceptos',
    'tableId' => 'maestros-conceptos-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Code', 'value' => 'code'],
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Category', 'value' => 'category'],
    ],
    'actionParams' => function (MaestrosConceptos $model) {
        return ['id' => $model->id];
    },
]);
