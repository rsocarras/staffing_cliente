<?php
use app\models\IntegrationLog;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\IntegrationLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Integration Logs';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Integration Log',
    'tableId' => 'integration-log-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Empresa Integration ID', 'value' => 'empresa_integration_id'],
        ['label' => 'Request ID', 'value' => 'request_id'],
        ['label' => 'Endpoint', 'value' => 'endpoint'],
    ],
    'actionParams' => function (IntegrationLog $model) {
        return ['id' => $model->id];
    },
]);
