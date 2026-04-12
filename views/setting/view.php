<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Setting $model */

$this->title = Yii::t('app', 'Setting #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parámetros laborales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Confirma eliminar este registro?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'year',
            [
                'attribute' => 'location_country_id',
                'value' => $model->locationCountry ? $model->locationCountry->name : null,
                'label' => $model->getAttributeLabel('location_country_id'),
            ],
            'hora_inicio_nocturna',
            'fin_hora_nocturna',
            'salario_minimo',
            'salario_minimo_integral',
            'porcentaje_salud',
            'porcentaje_pension',
            'porcentaje_cajas',
            'provision_prima_anual',
            'provision_cesantias',
            'provision_vacaciones',
            'max_horas_extra_dia',
            'max_horas_extra_semana',
            'max_horas_extra_mes',
            'recargo_dominical_festivo',
            'recargo_nocturno',
            'recargo_nocturno_dominical_festivo',
            'valor_hora_extra_diurna',
            'valor_hora_extra_nocturna',
            'valor_hora_extra_dia_festivo',
            'valor_hora_extra_nocturno_festivo',
            'valor_dominical_compensatorio',
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy ? $model->createdBy->username : null,
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy ? $model->updatedBy->username : null,
            ],
        ],
    ]) ?>

</div>
