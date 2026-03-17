<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\MallaCargoAsignacion $model */

$this->title = 'Asignación #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Asignación malla por cargo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malla-cargo-asignacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('malla.asignacion_cargo.aprobar') && $model->estado_aprobacion === \app\models\MallaCargoAsignacion::ESTADO_PENDIENTE): ?>
            <?= Html::beginForm(['approve', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                <?= Html::submitButton('Aprobar', ['class' => 'btn btn-success']) ?>
            <?= Html::endForm() ?>
            <?= Html::beginForm(['reject', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                <?= Html::hiddenInput('motivo_rechazo', 'Rechazada por RRHH') ?>
                <?= Html::submitButton('Rechazar', ['class' => 'btn btn-warning']) ?>
            <?= Html::endForm() ?>
        <?php endif; ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres eliminar esta asignación?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa_id',
            [
                'label' => 'Cargo',
                'value' => $model->cargo ? $model->cargo->nombre : $model->cargo_id,
            ],
            [
                'label' => 'Malla',
                'value' => $model->malla ? $model->malla->nombre : $model->malla_id,
            ],
            [
                'attribute' => 'estado_aprobacion',
                'value' => $model->displayEstadoAprobacion(),
            ],
            'motivo_rechazo',
            'solicitado_por',
            'solicitado_at',
            'aprobado_por',
            'aprobado_at',
            'activo:boolean',
        ],
    ]) ?>

</div>
