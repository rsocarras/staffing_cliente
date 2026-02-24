<?php
use app\models\Area;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\AreaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Area',
    'tableId' => 'area-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Uuid', 'value' => 'uuid'],
        ['label' => 'User Create', 'value' => 'user_create'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Descripcion', 'value' => 'descripcion'],
    ],
    'actionParams' => function (Area $model) {
        return ['id' => $model->id];
    },
]);
