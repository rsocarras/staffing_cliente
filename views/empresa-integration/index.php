<?php
use app\models\EmpresaIntegration;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\EmpresaIntegrationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empresa Integrations';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Empresa Integration',
    'tableId' => 'empresa-integration-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Provider', 'value' => 'provider'],
        ['label' => 'Base Url', 'value' => 'base_url'],
        ['label' => 'Username', 'value' => 'username'],
    ],
    'actionParams' => function (EmpresaIntegration $model) {
        return ['id' => $model->id];
    },
]);
