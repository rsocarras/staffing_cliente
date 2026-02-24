<?php
use app\models\PlanillaTemplate;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\PlanillaTemplateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Planilla Templates';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Planilla Template',
    'tableId' => 'planilla-template-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Version', 'value' => 'version'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Columnas Json', 'value' => 'columnas_json'],
    ],
    'actionParams' => function (PlanillaTemplate $model) {
        return ['id' => $model->id];
    },
]);
