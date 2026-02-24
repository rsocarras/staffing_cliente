<?php
use app\models\Empresas;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\EmpresasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empresas';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Empresas',
    'tableId' => 'empresas-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Social Name', 'value' => 'social_name'],
        ['label' => 'Entity', 'value' => 'entity'],
        ['label' => 'Ref Int', 'value' => 'ref_int'],
    ],
    'actionParams' => function (Empresas $model) {
        return ['id' => $model->id];
    },
]);
