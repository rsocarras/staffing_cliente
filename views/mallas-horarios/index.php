<?php
use app\models\MallasHorarios;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\MallasHorariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mallas Horarios';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Mallas',
    'createLabel' => 'Create Mallas Horarios',
    'tableId' => 'mallas-horarios-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Malla ID', 'value' => 'malla_id'],
        ['label' => 'Dia Semana', 'value' => 'dia_semana'],
        ['label' => 'Hora Inicio', 'value' => 'hora_inicio'],
        ['label' => 'Hora Fin', 'value' => 'hora_fin'],
    ],
    'actionParams' => function (MallasHorarios $model) {
        return ['id' => $model->id];
    },
]);
