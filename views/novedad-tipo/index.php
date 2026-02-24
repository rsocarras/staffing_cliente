<?php
use app\models\NovedadTipo;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Tipos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad Tipo',
    'tableId' => 'novedad-tipo-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
        ['label' => 'Icono', 'value' => 'icono'],
    ],
    'actionParams' => function (NovedadTipo $model) {
        return ['id' => $model->id];
    },
]);
