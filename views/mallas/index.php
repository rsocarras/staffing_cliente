<?php
use app\models\Mallas;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\MallasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mallas';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Mallas',
    'tableId' => 'mallas-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
        ['label' => 'Tipo', 'value' => 'tipo'],
    ],
    'actionParams' => function (Mallas $model) {
        return ['id' => $model->id];
    },
]);
