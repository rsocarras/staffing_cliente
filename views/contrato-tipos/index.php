<?php
use app\models\ContratoTipos;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ContratoTiposSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contrato Tipos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Contrato Tipos',
    'tableId' => 'contrato-tipos-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Code', 'value' => 'code'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
    ],
    'actionParams' => function (ContratoTipos $model) {
        return ['id' => $model->id];
    },
]);
