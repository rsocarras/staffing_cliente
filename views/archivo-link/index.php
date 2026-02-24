<?php
use app\models\ArchivoLink;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ArchivoLinkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Archivo Links';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Archivo Link',
    'tableId' => 'archivo-link-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Archivo ID', 'value' => 'archivo_id'],
        ['label' => 'Entidad Type', 'value' => 'entidad_type'],
        ['label' => 'Entidad ID', 'value' => 'entidad_id'],
    ],
    'actionParams' => function (ArchivoLink $model) {
        return ['id' => $model->id];
    },
]);
