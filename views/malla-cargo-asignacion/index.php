<?php
use app\models\MallaCargoAsignacion;

/** @var yii\web\View $this */
/** @var app\models\search\MallaCargoAsignacionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Asignación malla por cargo';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Nueva asignación',
    'tableId' => 'malla-cargo-asignacion-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Cargo', 'value' => function (MallaCargoAsignacion $model) {
            return $model->cargo ? $model->cargo->nombre : $model->cargo_id;
        }],
        ['label' => 'Malla', 'value' => function (MallaCargoAsignacion $model) {
            return $model->malla ? $model->malla->nombre : $model->malla_id;
        }],
        ['label' => 'Estado', 'value' => function (MallaCargoAsignacion $model) {
            return $model->displayEstadoAprobacion();
        }],
    ],
    'actionParams' => function (MallaCargoAsignacion $model) {
        return ['id' => $model->id];
    },
]);
