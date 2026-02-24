<?php
use app\models\NovedadConcepto;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadConceptoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Conceptos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad Concepto',
    'tableId' => 'novedad-concepto-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Novedad Tipo ID', 'value' => 'novedad_tipo_id'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
        ['label' => 'Icono', 'value' => 'icono'],
    ],
    'actionParams' => function (NovedadConcepto $model) {
        return ['id' => $model->id];
    },
]);
