<?php
use app\models\CompanySetting;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\CompanySettingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Company Settings';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Company Setting',
    'tableId' => 'company-setting-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Key', 'value' => 'key'],
        ['label' => 'Value Json', 'value' => 'value_json'],
        ['label' => 'Created At', 'value' => 'created_at'],
    ],
    'actionParams' => function (CompanySetting $model) {
        return ['id' => $model->id];
    },
]);
