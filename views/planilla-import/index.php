<?php
use app\models\PlanillaImport;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\PlanillaImportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Planilla Imports';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Planilla Import',
    'tableId' => 'planilla-import-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Payroll Period ID', 'value' => 'payroll_period_id'],
        ['label' => 'Template ID', 'value' => 'template_id'],
        ['label' => 'Archivo ID', 'value' => 'archivo_id'],
    ],
    'actionParams' => function (PlanillaImport $model) {
        return ['id' => $model->id];
    },
]);
