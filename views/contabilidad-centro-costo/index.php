<?php
use app\models\ContabilidadCentroCosto;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ContabilidadCentroCostoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contabilidad Centro Costos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Contabilidad Centro Costo',
    'tableId' => 'contabilidad-centro-costo-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Codigo', 'value' => 'codigo'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Activo', 'value' => 'activo'],
    ],
    'actionParams' => function (ContabilidadCentroCosto $model) {
        return ['id' => $model->id];
    },
]);
