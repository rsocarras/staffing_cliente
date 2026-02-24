<?php
use app\models\NovedadOpcionesDependientes;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadOpcionesDependientesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Opciones Dependientes';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad Opciones Dependientes',
    'tableId' => 'novedad-opciones-dependientes-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Campo Hijo', 'value' => 'campo_hijo'],
        ['label' => 'Campo Padre', 'value' => 'campo_padre'],
        ['label' => 'Valor Padre', 'value' => 'valor_padre'],
        ['label' => 'Valor', 'value' => 'valor'],
    ],
    'actionParams' => function (NovedadOpcionesDependientes $model) {
        return ['id' => $model->id];
    },
]);
