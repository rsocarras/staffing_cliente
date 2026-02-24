<?php
use app\models\Setting;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\SettingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Setting',
    'tableId' => 'setting-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Key', 'value' => 'key'],
        ['label' => 'Value Json', 'value' => 'value_json'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
        ['label' => 'Created At', 'value' => 'created_at'],
    ],
    'actionParams' => function (Setting $model) {
        return ['id' => $model->id];
    },
]);
