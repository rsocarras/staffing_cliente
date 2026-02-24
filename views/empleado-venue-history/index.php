<?php
use app\models\EmpleadoVenueHistory;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\EmpleadoVenueHistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empleado Venue Histories';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Empleado Venue History',
    'tableId' => 'empleado-venue-history-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Profile ID', 'value' => 'profile_id'],
        ['label' => 'Fecha Efectiva', 'value' => 'fecha_efectiva'],
        ['label' => 'Sede ID', 'value' => 'sede_id'],
    ],
    'actionParams' => function (EmpleadoVenueHistory $model) {
        return ['id' => $model->id];
    },
]);
