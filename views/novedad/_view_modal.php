<?php

use app\models\Novedad;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */

$fmt = Yii::$app->formatter;
$dash = '—';

$formatJsonBlock = static function (?string $raw): string {
    if ($raw === null || $raw === '') {
        return '';
    }
    $decoded = json_decode($raw, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        return (string) json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    return $raw;
};

$tsVal = static function ($v) use ($fmt, $dash) {
    if ($v === null || $v === '') {
        return $dash;
    }
    if (is_numeric($v)) {
        return $fmt->asDatetime((int) $v);
    }

    return $fmt->asDatetime($v);
};

$timeShort = static function (?string $t) use ($dash) {
    if ($t === null || $t === '') {
        return $dash;
    }
    if (preg_match('/^(\d{2}:\d{2})/', $t, $m)) {
        return $m[1];
    }

    return $t;
};

$estadoCargaLabels = [
    Novedad::ESTADO_CARGA_BORRADOR => Yii::t('app', 'Borrador'),
    Novedad::ESTADO_CARGA_CREADA => Yii::t('app', 'Creada'),
];

$periodoLabels = [
    Novedad::PERIODO_MENSUAL => Yii::t('app', 'Mensual'),
    Novedad::PERIODO_QUINCENAL => Yii::t('app', 'Quincenal'),
];

$empresaNombre = $model->empresa
    ? (string) ($model->empresa->name ?? $model->empresa->social_name ?? '')
    : '';
if ($empresaNombre === '' && $model->empresa_id) {
    $empresaNombre = '#' . $model->empresa_id;
}

$p = $model->profile;
$empleadoTxt = '';
if ($p !== null) {
    $empleadoTxt = trim((string) ($p->name ?? ''));
    if ($empleadoTxt === '') {
        $empleadoTxt = Yii::t('app', 'Usuario') . ' #' . $p->user_id;
    }
    if ($p->num_doc !== null && $p->num_doc !== '') {
        $empleadoTxt .= ' · ' . $p->num_doc;
    }
} elseif ($model->profile_id) {
    $empleadoTxt = '#' . $model->profile_id;
}

$creadorTxt = '';
if ($model->creador !== null) {
    $u = $model->creador;
    $creadorTxt = (string) ($u->username ?: $u->email ?: ('#' . $u->id));
} elseif ($model->created_by) {
    $creadorTxt = '#' . $model->created_by;
}

$conceptoNombre = $model->concepto
    ? (string) $model->concepto->nombre
    : (($model->concepto_id ? '#' . $model->concepto_id : '') ?: $dash);

$tipoNombre = $model->novedadTipo
    ? (string) $model->novedadTipo->nombre
    : (($model->novedad_tipo_id ? '#' . $model->novedad_tipo_id : '') ?: $dash);

$flujoNombre = $dash;
if (Novedad::hasNovedadFlujoIdColumn()) {
    $flujoNombre = $model->novedadFlujo
        ? (string) $model->novedadFlujo->nombre
        : (($model->novedad_flujo_id ? '#' . $model->novedad_flujo_id : '') ?: $dash);
}

$pasoNombre = $dash;
if ($model->pasoActual !== null) {
    $pasoNombre = (string) ($model->pasoActual->nombre ?: $model->pasoActual->codigo ?: ('#' . $model->paso_actual_id));
} elseif ($model->paso_actual_id) {
    $pasoNombre = '#' . $model->paso_actual_id;
}

$cc = $model->novedadCentroCosto;
$ccTxt = '';
if ($cc !== null) {
    $ccTxt = trim($cc->codigo . ' — ' . $cc->nombre);
} elseif ($model->novedad_centro_costo_id) {
    $ccTxt = '#' . $model->novedad_centro_costo_id;
}

$cu = $model->novedadCentroUtilidad;
$cuTxt = '';
if ($cu !== null) {
    $cuTxt = trim($cu->codigo . ' — ' . $cu->nombre);
} elseif ($model->novedad_centro_utilidad_id) {
    $cuTxt = '#' . $model->novedad_centro_utilidad_id;
}

$origenTxt = '';
if ($model->novedadOrigen !== null) {
    $origenTxt = Yii::t('app', 'Novedad #{id}', ['id' => $model->novedadOrigen->id]);
} elseif ($model->novedad_origen_id) {
    $origenTxt = Yii::t('app', 'Novedad #{id}', ['id' => $model->novedad_origen_id]);
}

$importeTxt = ($model->importe !== null && $model->importe !== '')
    ? $fmt->asCurrency($model->importe)
    : $dash;

$cantidadTxt = $dash;
if ($model->cantidad !== null && $model->cantidad !== '') {
    $u = trim((string) ($model->unidad ?? ''));
    $cantidadTxt = $fmt->asDecimal($model->cantidad, 2) . ($u !== '' ? ' ' . $u : '');
}

$fechaNovedadTxt = ($model->fecha_novedad !== null && $model->fecha_novedad !== '')
    ? $fmt->asDate($model->fecha_novedad)
    : $dash;

$periodoTxt = $model->periodo_nomina !== null && $model->periodo_nomina !== ''
    ? ($periodoLabels[$model->periodo_nomina] ?? $model->periodo_nomina)
    : $dash;

$anioTxt = $model->anio !== null && $model->anio !== '' ? (string) $model->anio : $dash;

$estadoCargaTxt = $estadoCargaLabels[$model->estado_carga] ?? (string) $model->estado_carga;

$esMasivoTxt = (int) $model->es_masivo === 1 ? Yii::t('app', 'Sí') : Yii::t('app', 'No');

$loteTxt = $model->lote_masivo_id !== null && $model->lote_masivo_id !== ''
    ? (string) $model->lote_masivo_id
    : $dash;

$datosPretty = $formatJsonBlock($model->datos);
$schemaPretty = $formatJsonBlock($model->schema_snapshot);
$alertasPretty = $formatJsonBlock($model->alertas);

$detallesHoras = $model->novedadHorasDetalles;
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-bell me-2 text-primary"></i>
            <?= Html::encode(Yii::t('app', 'Novedad')) ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-12">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Identificación')) ?></small>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('id')) ?></small>
                <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('empresa_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($empresaNombre !== '' ? $empresaNombre : $dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('profile_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($empleadoTxt !== '' ? $empleadoTxt : $dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('created_by')) ?></small>
                <span class="fw-medium"><?= Html::encode($creadorTxt !== '' ? $creadorTxt : $dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('concepto_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($conceptoNombre) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('novedad_tipo_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($tipoNombre) ?></span>
            </div>

            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Estado y flujo')) ?></small>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('estado')) ?></small>
                <span class="fw-medium"><?= Html::encode($model->displayEstado()) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('estado_carga')) ?></small>
                <span class="fw-medium"><?= Html::encode($estadoCargaTxt) ?></span>
            </div>
            <?php if (Novedad::hasNovedadFlujoIdColumn()): ?>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('novedad_flujo_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($flujoNombre) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('paso_actual_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($pasoNombre) ?></span>
            </div>
            <?php elseif ($model->paso_actual_id || $model->pasoActual !== null): ?>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('paso_actual_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($pasoNombre) ?></span>
            </div>
            <?php endif; ?>

            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Fechas y horas')) ?></small>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('fecha_novedad')) ?></small>
                <span class="fw-medium"><?= Html::encode($fechaNovedadTxt) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('hora_inicio')) ?></small>
                <span class="fw-medium"><?= Html::encode($timeShort($model->hora_inicio)) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('hora_fin')) ?></small>
                <span class="fw-medium"><?= Html::encode($timeShort($model->hora_fin)) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('cantidad')) ?> / <?= Html::encode($model->getAttributeLabel('unidad')) ?></small>
                <span class="fw-medium"><?= Html::encode($cantidadTxt) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('periodo_nomina')) ?></small>
                <span class="fw-medium"><?= Html::encode($periodoTxt) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('anio')) ?></small>
                <span class="fw-medium"><?= Html::encode($anioTxt) ?></span>
            </div>

            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Económico y estructura')) ?></small>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('importe')) ?></small>
                <span class="fw-medium"><?= Html::encode($importeTxt) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_unitario')) ?></small>
                <span class="fw-medium"><?= ($model->valor_unitario !== null && $model->valor_unitario !== '') ? Html::encode($fmt->asCurrency($model->valor_unitario)) : Html::encode($dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('batch_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($model->batch_id !== null && $model->batch_id !== '' ? (string) $model->batch_id : $dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('novedad_centro_costo_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($ccTxt !== '' ? $ccTxt : $dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('novedad_centro_utilidad_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($cuTxt !== '' ? $cuTxt : $dash) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('es_masivo')) ?></small>
                <span class="fw-medium"><?= Html::encode($esMasivoTxt) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('lote_masivo_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($loteTxt) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('novedad_origen_id')) ?></small>
                <span class="fw-medium"><?= Html::encode($origenTxt !== '' ? $origenTxt : $dash) ?></span>
            </div>

            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Auditoría')) ?></small>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('created_at')) ?></small>
                <span class="fw-medium"><?= Html::encode($tsVal($model->created_at)) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('updated_at')) ?></small>
                <span class="fw-medium"><?= Html::encode($tsVal($model->updated_at)) ?></span>
            </div>

            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode($model->getAttributeLabel('descripcion')) ?></small>
            </div>
            <div class="col-12">
                <?php if ($model->descripcion !== null && trim((string) $model->descripcion) !== ''): ?>
                    <div class="border rounded p-2 bg-light small"><?= nl2br(Html::encode((string) $model->descripcion)) ?></div>
                <?php else: ?>
                    <span class="text-muted"><?= Html::encode($dash) ?></span>
                <?php endif; ?>
            </div>

            <?php if (!empty($detallesHoras)): ?>
            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Detalle de horas')) ?></small>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th><?= Html::encode(Yii::t('app', 'Fecha acusación')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Horas')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Observación')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detallesHoras as $d): ?>
                                <tr>
                                    <td><?= Html::encode($fmt->asDate($d->fecha_acusacion)) ?></td>
                                    <td><?= Html::encode((string) $d->horas) ?></td>
                                    <td><?= Html::encode((string) ($d->observacion ?? '')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-12 pt-1">
                <small class="text-uppercase text-muted fw-semibold"><?= Html::encode(Yii::t('app', 'Datos técnicos')) ?></small>
            </div>
            <div class="col-12">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('datos')) ?></small>
                <pre class="small bg-light border rounded p-2 mb-0 font-monospace" style="max-height:240px;overflow:auto;"><?= Html::encode($datosPretty !== '' ? $datosPretty : $dash) ?></pre>
            </div>
            <div class="col-12">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('schema_snapshot')) ?></small>
                <pre class="small bg-light border rounded p-2 mb-0 font-monospace" style="max-height:200px;overflow:auto;"><?= Html::encode($schemaPretty !== '' ? $schemaPretty : $dash) ?></pre>
            </div>
            <div class="col-12">
                <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('alertas')) ?></small>
                <pre class="small bg-light border rounded p-2 mb-0 font-monospace" style="max-height:200px;overflow:auto;"><?= Html::encode($alertasPretty !== '' ? $alertasPretty : $dash) ?></pre>
            </div>
        </div>
    </div>
</div>
