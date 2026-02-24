<?php
use app\models\Profile;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => 'Create Profile',
    'tableId' => 'profile-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'User ID', 'value' => 'user_id'],
        ['label' => 'Tipo Doc', 'value' => 'tipo_doc'],
        ['label' => 'Num Doc', 'value' => 'num_doc'],
        ['label' => 'Name', 'value' => 'name'],
        ['label' => 'Public Email', 'value' => 'public_email'],
    ],
    'actionParams' => function (Profile $model) {
        return ['user_id' => $model->user_id];
    },
]);
