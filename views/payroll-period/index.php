<?php
use app\models\PayrollPeriod;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\PayrollPeriodSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Payroll Periods';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Payroll Period',
    'tableId' => 'payroll-period-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Year', 'value' => 'year'],
        ['label' => 'Month', 'value' => 'month'],
        ['label' => 'Start Date', 'value' => 'start_date'],
    ],
    'actionParams' => function (PayrollPeriod $model) {
        return ['id' => $model->id];
    },
]);
