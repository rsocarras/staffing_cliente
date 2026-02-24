<?php
use app\models\ContabilidadCentroUtilidad;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ContabilidadCentroUtilidadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contabilidad Centro Utilidads';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Contabilidad Centro Utilidad',
    'tableId' => 'contabilidad-centro-utilidad-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Codigo', 'value' => 'codigo'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Activo', 'value' => 'activo'],
    ],
    'actionParams' => function (ContabilidadCentroUtilidad $model) {
        return ['id' => $model->id];
    },
]);
