<?php
use app\models\City;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\CitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Location',
    'createLabel' => 'Create City',
    'tableId' => 'city-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Country ID', 'value' => 'country_id'],
        ['label' => 'Region ID', 'value' => 'region_id'],
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Is Capital', 'value' => 'is_capital'],
    ],
    'actionParams' => function (City $model) {
        return ['id' => $model->id];
    },
]);
