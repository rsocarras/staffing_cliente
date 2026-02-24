<?php
use app\models\MallaDistribucionHoras;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\MallaDistribucionHorasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Malla Distribucion Horas';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Mallas',
    'createLabel' => 'Create Malla Distribucion Horas',
    'tableId' => 'malla-distribucion-horas-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Payroll Period ID', 'value' => 'payroll_period_id'],
        ['label' => 'Profile ID', 'value' => 'profile_id'],
        ['label' => 'Sede ID', 'value' => 'sede_id'],
    ],
    'actionParams' => function (MallaDistribucionHoras $model) {
        return ['id' => $model->id];
    },
]);
