<?php
use app\models\NovedadFlujoPaso;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadFlujoPasoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Flujo Pasos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad Flujo Paso',
    'tableId' => 'novedad-flujo-paso-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Novedad Tipo ID', 'value' => 'novedad_tipo_id'],
        ['label' => 'Nombre', 'value' => 'nombre'],
        ['label' => 'Tipo Paso', 'value' => 'tipo_paso'],
        ['label' => 'Rol', 'value' => 'rol'],
    ],
    'actionParams' => function (NovedadFlujoPaso $model) {
        return ['id' => $model->id];
    },
]);
