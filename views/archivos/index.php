<?php
use app\models\Archivos;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ArchivosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Archivos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Archivos',
    'tableId' => 'archivos-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Storage', 'value' => 'storage'],
        ['label' => 'Path', 'value' => 'path'],
        ['label' => 'Filename', 'value' => 'filename'],
    ],
    'actionParams' => function (Archivos $model) {
        return ['id' => $model->id];
    },
]);
