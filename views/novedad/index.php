<?php
use app\models\Novedad;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedads';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad',
    'tableId' => 'novedad-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Profile ID', 'value' => 'profile_id'],
        ['label' => 'Concepto ID', 'value' => 'concepto_id'],
        ['label' => 'Novedad Tipo ID', 'value' => 'novedad_tipo_id'],
    ],
    'actionParams' => function (Novedad $model) {
        return ['id' => $model->id];
    },
]);
