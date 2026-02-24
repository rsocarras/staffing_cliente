<?php
use app\models\NovedadTipoCampoOpcion;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoCampoOpcionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Tipo Campo Opcions';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad Tipo Campo Opcion',
    'tableId' => 'novedad-tipo-campo-opcion-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Novedad Tipo Campo ID', 'value' => 'novedad_tipo_campo_id'],
        ['label' => 'Valor', 'value' => 'valor'],
        ['label' => 'Etiqueta', 'value' => 'etiqueta'],
        ['label' => 'Orden', 'value' => 'orden'],
    ],
    'actionParams' => function (NovedadTipoCampoOpcion $model) {
        return ['id' => $model->id];
    },
]);
