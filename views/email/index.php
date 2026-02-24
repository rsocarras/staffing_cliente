<?php
use app\models\Email;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\EmailSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Emails';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Email',
    'tableId' => 'email-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'To Email', 'value' => 'to_email'],
        ['label' => 'Cc Email', 'value' => 'cc_email'],
        ['label' => 'Bcc Email', 'value' => 'bcc_email'],
    ],
    'actionParams' => function (Email $model) {
        return ['id' => $model->id];
    },
]);
