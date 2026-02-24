<?php
use app\models\Cargos;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\CargosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cargos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Cargos',
    'tableId' => 'cargos-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Codigo', 'value' => 'codigo'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
    ],
    'actionParams' => function (Cargos $model) {
        return ['id' => $model->id];
    },
]);
