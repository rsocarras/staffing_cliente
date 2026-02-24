<?php
use app\models\EmpresaWebhook;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\EmpresaWebhookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empresa Webhooks';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Empresa Webhook',
    'tableId' => 'empresa-webhook-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Event Name', 'value' => 'event_name'],
        ['label' => 'Url', 'value' => 'url'],
        ['label' => 'Secret', 'value' => 'secret'],
    ],
    'actionParams' => function (EmpresaWebhook $model) {
        return ['id' => $model->id];
    },
]);
