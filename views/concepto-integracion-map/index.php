<?php
use app\models\ConceptoIntegracionMap;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ConceptoIntegracionMapSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Concepto Integracion Maps';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Concepto Integracion Map',
    'tableId' => 'concepto-integracion-map-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Provider', 'value' => 'provider'],
        ['label' => 'Concepto ID', 'value' => 'concepto_id'],
        ['label' => 'Remote Code', 'value' => 'remote_code'],
    ],
    'actionParams' => function (ConceptoIntegracionMap $model) {
        return ['id' => $model->id];
    },
]);
