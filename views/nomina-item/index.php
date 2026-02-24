<?php
use app\models\NominaItem;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NominaItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Nomina Items';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Nomina Item',
    'tableId' => 'nomina-item-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Nomina Run ID', 'value' => 'nomina_run_id'],
        ['label' => 'Profile ID', 'value' => 'profile_id'],
        ['label' => 'Concepto ID', 'value' => 'concepto_id'],
    ],
    'actionParams' => function (NominaItem $model) {
        return ['id' => $model->id];
    },
]);
