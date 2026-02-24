<?php
use app\models\ProfileEventosLog;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileEventosLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Profile Eventos Logs';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Profile',
    'createLabel' => 'Create Profile Eventos Log',
    'tableId' => 'profile-eventos-log-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Profile ID', 'value' => 'profile_id'],
        ['label' => 'Event Type', 'value' => 'event_type'],
        ['label' => 'Entity Type', 'value' => 'entity_type'],
    ],
    'actionParams' => function (ProfileEventosLog $model) {
        return ['id' => $model->id];
    },
]);
