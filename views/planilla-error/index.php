<?php
use app\models\PlanillaError;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\PlanillaErrorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Planilla Errors';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Planilla Error',
    'tableId' => 'planilla-error-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Import ID', 'value' => 'import_id'],
        ['label' => 'Row Number', 'value' => 'row_number'],
        ['label' => 'Col Name', 'value' => 'col_name'],
    ],
    'actionParams' => function (PlanillaError $model) {
        return ['id' => $model->id];
    },
]);
