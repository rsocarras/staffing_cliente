<?php
use app\models\LocationSedes;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\LocationSedesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Location Sedes';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Location',
    'createLabel' => 'Create Location Sedes',
    'tableId' => 'location-sedes-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Codigo', 'value' => 'codigo'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Direccion', 'value' => 'direccion'],
    ],
    'actionParams' => function (LocationSedes $model) {
        return ['id' => $model->id];
    },
]);
