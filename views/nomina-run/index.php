<?php
use app\models\NominaRun;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NominaRunSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Nomina Runs';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Nomina Run',
    'tableId' => 'nomina-run-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Payroll Period ID', 'value' => 'payroll_period_id'],
        ['label' => 'Status', 'value' => 'status'],
        ['label' => 'Input Params Json', 'value' => 'input_params_json'],
    ],
    'actionParams' => function (NominaRun $model) {
        return ['id' => $model->id];
    },
]);
