<?php
use app\models\NovedadTipoCampo;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoCampoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Tipo Campos';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Novedad',
    'createLabel' => 'Create Novedad Tipo Campo',
    'tableId' => 'novedad-tipo-campo-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Novedad Tipo ID', 'value' => 'novedad_tipo_id'],
        ['label' => 'Orden', 'value' => 'orden'],
        ['label' => 'Campo ID', 'value' => 'campo_id'],
        ['label' => 'Label', 'value' => 'label'],
    ],
    'actionParams' => function (NovedadTipoCampo $model) {
        return ['id' => $model->id];
    },
]);
