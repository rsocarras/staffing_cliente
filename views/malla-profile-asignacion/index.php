<?php
use app\models\MallaProfileAsignacion;

/** @var yii\web\View $this */
/** @var app\models\search\MallaProfileAsignacionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Asignación malla por empleado';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Nueva asignación',
    'tableId' => 'malla-profile-asignacion-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empleado', 'value' => function (MallaProfileAsignacion $model) {
            return $model->profile ? $model->profile->name : $model->profile_id;
        }],
        ['label' => 'Malla', 'value' => function (MallaProfileAsignacion $model) {
            return $model->malla ? $model->malla->nombre : $model->malla_id;
        }],
        ['label' => 'Estado', 'value' => function (MallaProfileAsignacion $model) {
            return $model->displayEstadoAprobacion();
        }],
        ['label' => 'Actual', 'value' => function (MallaProfileAsignacion $model) {
            return (int) $model->es_actual === 1 ? 'Sí' : 'No';
        }],
    ],
    'actionParams' => function (MallaProfileAsignacion $model) {
        return ['id' => $model->id];
    },
]);
