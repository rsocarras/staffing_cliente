<?php
use app\models\NominaRetencionImpuesto;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NominaRetencionImpuestoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Nomina Retencion Impuestos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Nomina Retencion Impuesto',
    'tableId' => 'nomina-retencion-impuesto-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Year', 'value' => 'year'],
        ['label' => 'Key', 'value' => 'key'],
        ['label' => 'Config Json', 'value' => 'config_json'],
    ],
    'actionParams' => function (NominaRetencionImpuesto $model) {
        return ['id' => $model->id];
    },
]);
