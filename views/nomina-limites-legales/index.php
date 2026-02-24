<?php
use app\models\NominaLimitesLegales;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NominaLimitesLegalesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Nomina Limites Legales';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Nomina Limites Legales',
    'tableId' => 'nomina-limites-legales-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Year', 'value' => 'year'],
        ['label' => 'Config Json', 'value' => 'config_json'],
        ['label' => 'Created At', 'value' => 'created_at'],
    ],
    'actionParams' => function (NominaLimitesLegales $model) {
        return ['id' => $model->id];
    },
]);
