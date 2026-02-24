<?php
use app\models\Region;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\RegionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Location',
    'createLabel' => 'Create Region',
    'tableId' => 'region-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Country ID', 'value' => 'country_id'],
        ['label' => 'Code', 'value' => 'code'],
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Type', 'value' => 'type'],
    ],
    'actionParams' => function (Region $model) {
        return ['id' => $model->id];
    },
]);
