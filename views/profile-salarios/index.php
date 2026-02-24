<?php
use app\models\ProfileSalarios;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileSalariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Profile Salarios';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'breadcrumbParent' => 'Profile',
    'createLabel' => 'Create Profile Salarios',
    'tableId' => 'profile-salarios-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => 'Empresa ID', 'value' => 'empresa_id'],
        ['label' => 'Profile ID', 'value' => 'profile_id'],
        ['label' => 'Fecha Efectiva', 'value' => 'fecha_efectiva'],
        ['label' => 'Salario Base', 'value' => 'salario_base'],
    ],
    'actionParams' => function (ProfileSalarios $model) {
        return ['id' => $model->id];
    },
]);
