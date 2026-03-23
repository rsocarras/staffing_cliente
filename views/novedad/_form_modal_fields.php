<?php

use app\models\Novedad;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */
/** @var ActiveForm $form */
/** @var app\models\NovedadConcepto[] $conceptos */
/** @var app\models\NovedadTipo[] $tipos */
/** @var app\models\NovedadFlujo[] $flujos */

$estadoOpts = [
    Novedad::ESTADO_BORRADOR => 'Borrador',
    Novedad::ESTADO_PENDIENTE => 'Pendiente',
    Novedad::ESTADO_APROBADA => 'Aprobada',
    Novedad::ESTADO_RECHAZADA => 'Rechazada',
];
?>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-medium">Tipo de novedad</label>
        <select name="Novedad[novedad_tipo_id]" id="novedad-edit-tipo" class="form-select" required>
            <?php foreach ($tipos as $t): ?>
                <option value="<?= (int) $t->id ?>" <?= (int) $model->novedad_tipo_id === (int) $t->id ? 'selected' : '' ?>><?= Html::encode($t->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">Concepto</label>
        <select name="Novedad[concepto_id]" id="novedad-edit-concepto" class="form-select" required>
            <?php foreach ($conceptos as $c): ?>
                <option value="<?= (int) $c->id ?>" <?= (int) $model->concepto_id === (int) $c->id ? 'selected' : '' ?>><?= Html::encode($c->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php if (Novedad::hasNovedadFlujoIdColumn()): ?>
    <div class="col-md-6">
        <label class="form-label fw-medium">Flujo</label>
        <select name="Novedad[novedad_flujo_id]" id="novedad-edit-flujo" class="form-select">
            <option value="">Sin flujo</option>
            <?php foreach ($flujos as $f): ?>
                <option value="<?= (int) $f->id ?>" <?= (int) ($model->getAttribute('novedad_flujo_id') ?: 0) === (int) $f->id ? 'selected' : '' ?>><?= Html::encode($f->nombre) ?></option>
            <?php endforeach; ?>
        </select>
        <p class="text-muted small mb-0 mt-1">El paso actual se cambia solo desde el tablero (Flujo).</p>
    </div>
    <?php endif; ?>

    <div class="col-md-6">
        <?= $form->field($model, 'estado')->dropDownList($estadoOpts, [
            'class' => 'form-select',
        ])->label('Estado') ?>
    </div>

    <div class="col-12">
        <label class="form-label fw-medium">Datos (JSON)</label>
        <?= Html::activeTextarea($model, 'datos', [
            'class' => 'form-control font-monospace small',
            'rows' => 5,
        ]) ?>
    </div>
</div>
