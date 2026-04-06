<?php

use Yii;
use app\models\Setting;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\SettingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Parámetros laborales (setting)');
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('//layouts/_datatable_index', [
    'title' => $this->title,
    'createLabel' => Yii::t('app', 'Crear registro'),
    'tableId' => 'setting-table',
    'dataProvider' => $dataProvider,
    'columns' => [
        ['label' => 'ID', 'value' => 'id'],
        ['label' => Yii::t('app', 'Año'), 'value' => 'year'],
        [
            'label' => Yii::t('app', 'País'),
            'value' => static function (Setting $model) {
                return $model->locationCountry ? $model->locationCountry->name : '';
            },
        ],
        ['label' => Yii::t('app', 'Salario mínimo'), 'value' => 'salario_minimo'],
        ['label' => Yii::t('app', 'Actualizado el'), 'value' => 'updated_at'],
    ],
    'actionParams' => function (Setting $model) {
        return ['id' => $model->id];
    },
]);
