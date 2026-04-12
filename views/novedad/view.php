<?php

use app\models\City;
use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\Novedad;
use app\models\NovedadCentroCosto;
use app\models\NovedadTipo;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var Novedad $model */
/** @var bool $puedeEditarSolicitud Permite editar / confirmar / eliminar según estado de carga en borrador (portal cliente). */

$puedeEditarSolicitud = $puedeEditarSolicitud ?? false;

$this->title = Yii::t('app', 'Solicitud #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Solicitudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$estado = (string) $model->estado;
$estadoBadge = 'badge-soft-secondary';
if ($estado === Novedad::ESTADO_PENDIENTE) {
    $estadoBadge = 'badge-soft-warning';
}
if ($estado === Novedad::ESTADO_APROBADA) {
    $estadoBadge = 'badge-soft-success';
}
if ($estado === Novedad::ESTADO_RECHAZADA) {
    $estadoBadge = 'badge-soft-danger';
}
$estadoLabel = Novedad::optsEstado()[$estado] ?? $estado;

$esBorrador = $estado === Novedad::ESTADO_BORRADOR;

$p = $model->profile;
$nombreEmpleado = $p && trim((string) $p->name) !== '' ? (string) $p->name : ('#' . (string) $model->profile_id);

$empresaNombre = $model->empresa ? trim((string) ($model->empresa->name ?? $model->empresa->social_name ?? '')) : '';
if ($empresaNombre === '') {
    $empresaNombre = $model->empresa ? ('#' . $model->empresa->id) : '—';
}

$conceptoTxt = $model->concepto ? (string) $model->concepto->nombre : '—';
$tipoTxt = $model->novedadTipo ? (string) $model->novedadTipo->nombre : '—';
$conceptoConAgrupador = '—';
if ($model->concepto !== null) {
    $conceptoConAgrupador = (string) $model->concepto->nombre;
    if ($model->novedadTipo !== null) {
        $conceptoConAgrupador .= ' — ' . (string) $model->novedadTipo->nombre;
    }
}

$hIni = $model->hora_inicio ? substr((string) $model->hora_inicio, 0, 5) : '—';
$hFin = $model->hora_fin ? substr((string) $model->hora_fin, 0, 5) : '—';
$horasTxt = $model->cantidad !== null
    ? Yii::$app->formatter->asDecimal((float) $model->cantidad, 2)
    : '—';

$tieneFlujoAprobacion = NovedadTipo::tipoTieneFlujoAprobacion((int) $model->novedad_tipo_id);

$batchIdTxt = trim((string) ($model->batch_id ?? ''));
$importeTxt = '—';
if ($model->importe !== null && $model->importe !== '') {
    $importeTxt = Yii::$app->formatter->asCurrency((float) $model->importe);
}
$valorUnitarioTxt = '—';
if ($model->valor_unitario !== null && $model->valor_unitario !== '') {
    $valorUnitarioTxt = Yii::$app->formatter->asCurrency((float) $model->valor_unitario);
}
$unidadTxt = trim((string) ($model->unidad ?? ''));
$unidadTxt = $unidadTxt !== '' ? $unidadTxt : '—';

$ccosto = $model->novedadCentroCosto;
$centroCostoTxt = $ccosto ? trim((string) ($ccosto->nombre ?? '')) : '';
if ($centroCostoTxt === '' && $ccosto) {
    $centroCostoTxt = trim((string) ($ccosto->codigo ?? ''));
}
$centroCostoTxt = $centroCostoTxt !== '' ? $centroCostoTxt : '—';

$datosDecoded = [];
try {
    if ($model->datos !== null && (string) $model->datos !== '' && (string) $model->datos !== '{}') {
        $tmp = json_decode((string) $model->datos, true, 512, JSON_THROW_ON_ERROR);
        $datosDecoded = is_array($tmp) ? $tmp : [];
    }
} catch (\JsonException $e) {
    $datosDecoded = [];
}

/** Valores planos para el detalle (portal cliente guarda solicitud + campos_dinamicos anidados). */
$datosFlat = [];
$solicitud = $datosDecoded['solicitud'] ?? null;
$camposDin = $datosDecoded['campos_dinamicos'] ?? null;
if (is_array($solicitud)) {
    foreach ($solicitud as $k => $v) {
        $datosFlat[(string) $k] = $v;
    }
}
if (is_array($camposDin)) {
    foreach ($camposDin as $k => $v) {
        $datosFlat[(string) $k] = $v;
    }
}
if ($datosFlat === [] && $datosDecoded !== []) {
    foreach ($datosDecoded as $k => $v) {
        if ($k === 'solicitud' || $k === 'campos_dinamicos') {
            continue;
        }
        $datosFlat[(string) $k] = $v;
    }
}

$fechaFinalTxt = '—';
$fechaFinalRaw = isset($datosFlat['fecha_final']) ? trim((string) $datosFlat['fecha_final']) : '';
if ($fechaFinalRaw !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaFinalRaw)) {
    $fechaFinalTxt = Html::encode(Yii::$app->formatter->asDate($fechaFinalRaw));
}

$datosJsonPretty = $datosDecoded !== []
    ? json_encode($datosDecoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    : '';

$confirmarFechaTxt = '—';
if ($model->fecha_novedad !== null && trim((string) $model->fecha_novedad) !== '') {
    $confirmarFechaTxt = Yii::$app->formatter->asDate($model->fecha_novedad);
}

$confirmarTieneHorarioEnModelo = ($model->hora_inicio !== null && trim((string) $model->hora_inicio) !== '')
    || ($model->hora_fin !== null && trim((string) $model->hora_fin) !== '')
    || ($model->cantidad !== null && $model->cantidad !== '' && (float) $model->cantidad > 0);

$confirmarPeriodoDesdeDatos = '';
$fiModal = isset($datosFlat['fecha_inicial']) ? trim((string) $datosFlat['fecha_inicial']) : '';
$ffModal = isset($datosFlat['fecha_final']) ? trim((string) $datosFlat['fecha_final']) : '';
if ($fiModal !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fiModal)) {
    $confirmarPeriodoDesdeDatos = Yii::$app->formatter->asDate($fiModal);
}
if ($ffModal !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $ffModal)) {
    $ffFmt = Yii::$app->formatter->asDate($ffModal);
    $confirmarPeriodoDesdeDatos = $confirmarPeriodoDesdeDatos !== ''
        ? $confirmarPeriodoDesdeDatos . ' → ' . $ffFmt
        : $ffFmt;
}

$confirmarTextoHorario = '';
if ($confirmarTieneHorarioEnModelo) {
    $rangoH = array_filter(
        [$hIni !== '—' ? $hIni : null, $hFin !== '—' ? $hFin : null],
        static fn(?string $x): bool => $x !== null
    );
    $confirmarTextoHorario = $rangoH !== [] ? implode(' — ', $rangoH) : '';
    if ($horasTxt !== '—') {
        $confirmarTextoHorario .= ($confirmarTextoHorario !== '' ? ' · ' : '')
            . $horasTxt . ' ' . Yii::t('app', 'h');
    }
    if ($confirmarTextoHorario === '') {
        $confirmarTextoHorario = '—';
    }
}

$etiquetaDatosClave = [
    'centro_costo' => Yii::t('app', 'Centro de costo'),
    'cantidad' => Yii::t('app', 'Cantidad'),
    'fecha_inicial' => Yii::t('app', 'Fecha inicial'),
    'fecha_final' => Yii::t('app', 'Fecha final'),
    'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
    'ciudad_id' => Yii::t('app', 'Ciudad'),
    'sede_id' => Yii::t('app', 'Sede'),
    'adjunto_pdf' => Yii::t('app', 'Documento adjunto (PDF)'),
    'adjuntos_pdf' => Yii::t('app', 'Documentos soporte (PDF)'),
    'horas_cantidad' => Yii::t('app', 'Cantidad (horas)'),
    'fecha_novedad' => Yii::t('app', 'Fecha de aplicación (datos)'),
];

$ordenDatosClaves = [
    'centro_costo',
    'cantidad',
    'fecha_inicial',
    'fecha_final',
    'empresa_cliente_id',
    'ciudad_id',
    'sede_id',
    'adjunto_pdf',
    'adjuntos_pdf',
    'horas_cantidad',
    'fecha_novedad',
];

$absolutizarRutaWeb = static function (string $ruta): string {
    $ruta = trim($ruta);

    return $ruta === '' ? '#' : (str_starts_with($ruta, '/') ? $ruta : '/' . $ruta);
};

$htmlValorDatoDetalle = static function (string $clave, mixed $valor) use ($absolutizarRutaWeb): string {
    if ($clave === 'adjunto_pdf') {
        if (!is_string($valor) || trim($valor) === '') {
            return '—';
        }
        $url = $absolutizarRutaWeb($valor);
        $nombre = basename(str_replace('\\', '/', $valor));

        return (string) Html::a(
            Html::encode($nombre),
            $url,
            [
                'class' => 'link-primary text-decoration-none',
                'target' => '_blank',
                'rel' => 'noopener noreferrer',
                'download' => '',
            ]
        ) . ' <span class="text-muted small">(' . Html::encode(Yii::t('app', 'descargar / abrir')) . ')</span>';
    }

    if ($clave === 'adjuntos_pdf') {
        if (!is_array($valor) || $valor === []) {
            return '—';
        }
        $partes = [];
        foreach ($valor as $item) {
            if (!is_string($item) || trim($item) === '') {
                continue;
            }
            $url = $absolutizarRutaWeb($item);
            $nombre = basename(str_replace('\\', '/', $item));
            $partes[] = (string) Html::a(
                Html::encode($nombre),
                $url,
                [
                    'class' => 'link-primary text-decoration-none d-inline-flex align-items-center gap-1',
                    'target' => '_blank',
                    'rel' => 'noopener noreferrer',
                    'download' => '',
                ]
            ) . ' <i class="ti ti-download fs-16" aria-hidden="true"></i>';
        }

        return $partes !== [] ? implode('<br>', $partes) : '—';
    }

    if ($clave === 'centro_costo') {
        $id = is_numeric($valor) ? (int) $valor : 0;
        if ($id <= 0) {
            return '—';
        }
        $ncc = NovedadCentroCosto::findOne($id);
        if ($ncc === null) {
            return Html::encode('#' . $id);
        }

        $txt = trim((string) $ncc->codigo . ' — ' . (string) $ncc->nombre);

        return Html::encode($txt);
    }

    if ($clave === 'empresa_cliente_id') {
        $id = is_numeric($valor) ? (int) $valor : 0;
        if ($id <= 0) {
            return '—';
        }
        $ec = EmpresaCliente::findOne($id);

        return $ec !== null ? Html::encode((string) $ec->nombre) : Html::encode('#' . $id);
    }

    if ($clave === 'ciudad_id') {
        $id = is_numeric($valor) ? (int) $valor : 0;
        if ($id <= 0) {
            return '—';
        }
        $c = City::findOne($id);

        return $c !== null ? Html::encode((string) $c->name) : Html::encode('#' . $id);
    }

    if ($clave === 'sede_id') {
        $id = is_numeric($valor) ? (int) $valor : 0;
        if ($id <= 0) {
            return '—';
        }
        $s = LocationSedes::findOne($id);
        if ($s === null) {
            return Html::encode('#' . $id);
        }

        return Html::encode(trim((string) $s->nombre . (isset($s->codigo) && $s->codigo !== null && $s->codigo !== ''
            ? ' (' . $s->codigo . ')'
            : '')));
    }

    if (is_bool($valor)) {
        return $valor ? Yii::t('app', 'Sí') : Yii::t('app', 'No');
    }

    if (is_array($valor)) {
        $json = json_encode($valor, JSON_UNESCAPED_UNICODE);

        return Html::encode($json !== false ? $json : '[]');
    }

    if (is_scalar($valor)) {
        $s = trim((string) $valor);
        if ($s === '') {
            return '—';
        }
        if (
            in_array($clave, ['fecha_inicial', 'fecha_final', 'fecha_novedad'], true)
            && preg_match('/^\d{4}-\d{2}-\d{2}$/', $s)
        ) {
            return Html::encode(Yii::$app->formatter->asDate($s));
        }

        return Html::encode($s);
    }

    return '—';
};
?>

<?php foreach (['success', 'error', 'warning', 'info'] as $flash): ?>
    <?php if (Yii::$app->session->hasFlash($flash)): ?>
        <div class="alert alert-<?= $flash === 'error' ? 'danger' : ($flash === 'success' ? 'success' : ($flash === 'warning' ? 'warning' : 'info')) ?> alert-dismissible fade show mb-3">
            <?= Html::encode(Yii::$app->session->getFlash($flash)) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?= Html::encode(Yii::t('app', 'Cerrar')) ?>"></button>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<?php
$this->registerCss(<<<'CSS'
/* Detalle novedad: fondo blanco + bloques como solicitud (punteado, panel #f7f9fc — ver _forms.scss) */
.novedad-detalle-vista {
    background-color: #fff !important;
}
.novedad-detalle-vista .novedad-solicitud-seccion,
#modalConfirmarNovedad .novedad-solicitud-seccion {
    background-color: #f7f9fc !important;
    border-color: #d8dee8 !important;
}
.novedad-detalle-vista .novedad-solicitud-seccion .form-label,
.novedad-detalle-vista .novedad-solicitud-seccion h6,
#modalConfirmarNovedad .novedad-solicitud-seccion .form-label,
#modalConfirmarNovedad .novedad-solicitud-seccion h6 {
    color: #1f2937 !important;
}
.novedad-detalle-vista .novedad-solicitud-seccion .text-muted,
#modalConfirmarNovedad .novedad-solicitud-seccion .text-muted {
    color: #4b5563 !important;
}
/* Tabla en modal eliminar */
.novedad-view-field--tabla {
    background-color: #fff !important;
    border: 1px solid #dee2e6 !important;
}
.novedad-view-json-pre {
    border: 1px solid #ced4da !important;
    background-color: #fff !important;
    box-shadow: 0 0.125rem 0.25rem rgba(33, 37, 41, 0.08);
}
CSS);
?>

<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1"><?= Html::encode($this->title) ?></h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= Url::to(['/']) ?>"><i class="ti ti-smart-home"></i></a>
                </li>
                <li class="breadcrumb-item"><?= Html::encode(Yii::t('app', 'Novedades')) ?></li>
                <li class="breadcrumb-item">
                    <?= Html::a(Yii::t('app', 'Solicitudes'), ['index']) ?>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?= Html::encode(Yii::t('app', 'Detalle')) ?></li>
            </ol>
        </nav>
    </div>
    <?= Html::a(
        '<i class="ti ti-arrow-left me-1" aria-hidden="true"></i>' . Html::encode(Yii::t('app', 'Volver al listado')),
        ['index'],
        ['class' => 'btn btn-light']
    ) ?>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom d-flex flex-wrap gap-2 justify-content-between align-items-center py-3">
        <h5 class="card-title mb-0 text-dark"><?= Html::encode(Yii::t('app', 'Detalle de la solicitud')) ?></h5>
        <div class="d-flex flex-wrap gap-2">
            <?php if ($esBorrador && $puedeEditarSolicitud): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConfirmarNovedad">
                    <i class="ti ti-send me-1" aria-hidden="true"></i><?= Html::encode(Yii::t('app', 'Confirmar envío')) ?>
                </button>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarNovedad">
                    <i class="ti ti-trash me-1" aria-hidden="true"></i><?= Html::encode(Yii::t('app', 'Eliminar solicitud')) ?>
                </button>
            <?php endif; ?>
            <?php if ($puedeEditarSolicitud): ?>
                <?= Html::a(
                    '<i class="ti ti-edit me-1" aria-hidden="true"></i>' . Html::encode(Yii::t('app', 'Editar')),
                    ['update', 'id' => $model->id],
                    ['class' => 'btn btn-outline-secondary']
                ) ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body p-4 novedad-detalle-vista">
        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-id fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Identificación y estado')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Número interno, estado del flujo y lote si aplica.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'ID')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode((string) $model->id) ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Estado')) ?></div>
                        <p class="mb-0">
                            <span class="badge <?= Html::encode($estadoBadge) ?> d-inline-flex align-items-center badge-xs">
                                <i class="ti ti-point-filled me-1" aria-hidden="true"></i><?= Html::encode($estadoLabel) ?>
                            </span>
                        </p>
                    </div>
                </div>
                <?php if ($batchIdTxt !== ''): ?>
                    <div class="col-md-4">
                        <div class="mb-3 mb-lg-0">
                            <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Lote (batch)')) ?></div>
                            <p class="mb-0 text-dark small font-monospace text-break user-select-all"><?= Html::encode($batchIdTxt) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-building fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Organización y colaborador')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Empresa y persona asociada a la novedad.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Organización')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($empresaNombre) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Empleado')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($nombreEmpleado) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-category fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Concepto y agrupador')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Clasificación de la solicitud en el catálogo.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Concepto')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($conceptoTxt) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Agrupador')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($tipoTxt) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-danger text-danger rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-calendar-event fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Fecha y horario')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Fecha de la novedad y, si aplica, rango horario y cantidad.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Fecha novedad')) ?></div>
                        <p class="mb-0 text-dark"><?= $model->fecha_novedad ? Html::encode(Yii::$app->formatter->asDate($model->fecha_novedad)) : '—' ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Fecha final')) ?></div>
                        <p class="mb-0 text-dark"><?= $fechaFinalTxt ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Centro de costo')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($centroCostoTxt) ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Hora inicial')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($hIni) ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Hora final')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($hFin) ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Cantidad')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($horasTxt) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-currency-dollar fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Importe, valor unitario y unidad')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Valores monetarios o unidad de medida registrada.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Valor unitario')) ?></div>
                        <p class="mb-0 text-dark fw-medium"><?= Html::encode($valorUnitarioTxt) ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Importe')) ?></div>
                        <p class="mb-0 text-dark fw-medium"><?= Html::encode($importeTxt) ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Unidad')) ?></div>
                        <p class="mb-0 text-dark"><?= Html::encode($unidadTxt) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($model->novedad_origen_id !== null && (int) $model->novedad_origen_id > 0): ?>
            <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-secondary text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-link fs-20" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Origen (troceo)')) ?></h6>
                        <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Solicitud generada a partir de otra en el mismo troceo.')) ?></p>
                    </div>
                </div>
                <div class="d-inline-block">
                    <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Solicitud origen')) ?></div>
                    <p class="mb-0">
                        <?= Html::a(
                            '#' . (int) $model->novedad_origen_id,
                            ['view', 'id' => (int) $model->novedad_origen_id],
                            ['class' => 'fw-medium']
                        ) ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-dark text-dark rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-notes fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Descripción')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Texto libre asociado a la solicitud.')) ?></p>
                </div>
            </div>
            <p class="mb-0 text-dark"><?php
                if ($model->descripcion !== null && trim((string) $model->descripcion) !== '') {
                    echo nl2br(Html::encode((string) $model->descripcion));
                } else {
                    echo '—';
                }
                ?></p>
        </div>

        <?php if ($datosFlat !== []): ?>
            <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-4 novedad-solicitud-seccion">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-forms fs-20" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Datos adicionales')) ?></h6>
                        <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Campos capturados en el formulario del concepto.')) ?></p>
                    </div>
                </div>
                <div class="row g-3">
                    <?php
                    $vistosDatos = [];
                    foreach ($ordenDatosClaves as $claveDato) {
                        if (!array_key_exists($claveDato, $datosFlat)) {
                            continue;
                        }
                        $vistosDatos[$claveDato] = true;
                        $etiq = $etiquetaDatosClave[$claveDato] ?? str_replace('_', ' ', $claveDato);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="mb-3 mb-lg-0">
                                <div class="form-label fw-semibold mb-2 text-dark small"><?= Html::encode($etiq) ?></div>
                                <div class="mb-0 text-dark small"><?= $htmlValorDatoDetalle($claveDato, $datosFlat[$claveDato]) ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    foreach ($datosFlat as $claveDato => $valorDato) {
                        if (isset($vistosDatos[$claveDato])) {
                            continue;
                        }
                        $etiq = $etiquetaDatosClave[$claveDato] ?? str_replace('_', ' ', (string) $claveDato);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="mb-3 mb-lg-0">
                                <div class="form-label fw-semibold mb-2 text-dark small"><?= Html::encode($etiq) ?></div>
                                <div class="mb-0 text-dark small"><?= $htmlValorDatoDetalle((string) $claveDato, $valorDato) ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php if ($datosJsonPretty !== ''): ?>
                    <details class="mt-3 small">
                        <summary class="small text-muted user-select-none" style="cursor: pointer;"><?= Html::encode(Yii::t('app', 'Ver JSON (técnico)')) ?></summary>
                        <pre class="novedad-view-json-pre small mb-0 mt-2 rounded p-3 text-dark overflow-auto" style="max-height: 240px;"><?= Html::encode($datosJsonPretty) ?></pre>
                    </details>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-0 novedad-solicitud-seccion">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-secondary text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-history fs-20" aria-hidden="true"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1 text-dark"><?= Html::encode(Yii::t('app', 'Auditoría')) ?></h6>
                    <p class="small text-muted mb-0"><?= Html::encode(Yii::t('app', 'Fechas de creación y última actualización.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Creado')) ?></div>
                        <p class="mb-0 text-dark small"><?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at)) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mb-lg-0">
                        <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Actualizado')) ?></div>
                        <p class="mb-0 text-dark small"><?= Html::encode(Yii::$app->formatter->asDatetime($model->updated_at)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($esBorrador && $puedeEditarSolicitud): ?>
<!-- Modal confirmar -->
<div class="modal fade" id="modalConfirmarNovedad" tabindex="-1" aria-labelledby="modalConfirmarNovedadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-semibold text-dark" id="modalConfirmarNovedadLabel"><?= Html::encode(Yii::t('app', 'Confirmar envío')) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Html::encode(Yii::t('app', 'Cerrar')) ?>"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="text-dark mb-3"><?= Html::encode($tieneFlujoAprobacion
                    ? Yii::t('app', '¿Enviar esta solicitud? Pasará a estado pendiente de aprobación.')
                    : Yii::t('app', '¿Registrar esta solicitud? Quedará aprobada automáticamente porque este tipo no tiene flujo de aprobación configurado.')) ?></p>
                <p class="small text-secondary text-uppercase fw-semibold mb-2" style="letter-spacing: 0.05em;"><?= Html::encode(Yii::t('app', 'Resumen')) ?></p>
                <div class="rounded border border-dashed bg-light p-3 p-md-4 mb-0 novedad-solicitud-seccion">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Concepto')) ?></div>
                                <p class="mb-0 text-dark"><?= Html::encode($conceptoConAgrupador) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Empleado')) ?></div>
                                <p class="mb-0 text-dark"><?= Html::encode($nombreEmpleado) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Fecha de aplicación')) ?></div>
                                <p class="mb-0 text-dark"><?= Html::encode($confirmarFechaTxt) ?></p>
                            </div>
                        </div>
                        <?php if ($confirmarTieneHorarioEnModelo): ?>
                            <div class="col-md-6">
                                <div class="mb-3 mb-lg-0">
                                    <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Horario / cantidad')) ?></div>
                                    <p class="mb-0 text-dark"><?= Html::encode($confirmarTextoHorario) ?></p>
                                </div>
                            </div>
                        <?php elseif ($confirmarPeriodoDesdeDatos !== ''): ?>
                            <div class="col-md-6">
                                <div class="mb-3 mb-lg-0">
                                    <div class="form-label fw-semibold mb-2 text-dark"><?= Html::encode(Yii::t('app', 'Periodo')) ?></div>
                                    <p class="mb-0 text-dark"><?= Html::encode($confirmarPeriodoDesdeDatos) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?= Html::encode(Yii::t('app', 'Cancelar')) ?></button>
                <?= Html::beginForm(['confirmar-novedad', 'id' => $model->id], 'post') ?>
                <?= Html::submitButton(Yii::t('app', 'Sí, confirmar envío'), ['class' => 'btn btn-primary']) ?>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal eliminar -->
<div class="modal fade" id="modalEliminarNovedad" tabindex="-1" aria-labelledby="modalEliminarNovedadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-semibold text-danger" id="modalEliminarNovedadLabel"><?= Html::encode(Yii::t('app', 'Eliminar solicitud')) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Html::encode(Yii::t('app', 'Cerrar')) ?>"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="text-danger mb-3"><?= Html::encode(Yii::t('app', '¿Eliminar definitivamente esta solicitud? Esta acción no se puede deshacer.')) ?></p>
                <?php
                $hijas = Novedad::find()
                    ->where([
                        'novedad_origen_id' => (int) $model->id,
                        'empresa_id' => (int) $model->empresa_id,
                    ])
                    ->with(['concepto'])
                    ->orderBy(['fecha_novedad' => SORT_ASC, 'hora_inicio' => SORT_ASC])
                    ->all();
                $filasModal = array_merge([$model], $hijas);
                ?>
                <?php if ($hijas !== []): ?>
                    <p class="small text-muted mb-3"><?= Html::encode(Yii::t('app', 'Se eliminarán también las solicitudes vinculadas al mismo troceo (origen #{id}).', ['id' => (int) $model->id])) ?></p>
                <?php endif; ?>
                <div class="novedad-view-field--tabla rounded-3 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0 align-middle">
                            <thead class="bg-light">
                            <tr>
                                <th class="form-label fw-semibold text-dark py-3 px-3 border-bottom"><?= Html::encode(Yii::t('app', 'ID')) ?></th>
                                <th class="form-label fw-semibold text-dark py-3 px-3 border-bottom"><?= Html::encode(Yii::t('app', 'Concepto')) ?></th>
                                <th class="form-label fw-semibold text-dark py-3 px-3 border-bottom"><?= Html::encode(Yii::t('app', 'Fecha')) ?></th>
                                <th class="form-label fw-semibold text-dark py-3 px-3 border-bottom"><?= Html::encode(Yii::t('app', 'Horario')) ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($filasModal as $row): ?>
                                <?php
                                /** @var Novedad $row */
                                $c = $row->concepto;
                                if ($c) {
                                    $tipoC = $c->novedadTipo;
                                    $cn = (string) $c->nombre . ($tipoC ? ' — ' . (string) $tipoC->nombre : '');
                                } else {
                                    $cn = '#' . $row->concepto_id;
                                }
                                $hi = $row->hora_inicio ? substr((string) $row->hora_inicio, 0, 5) : '—';
                                $hf = $row->hora_fin ? substr((string) $row->hora_fin, 0, 5) : '—';
                                ?>
                                <tr>
                                    <td class="px-3 py-2 text-dark"><?= (int) $row->id ?></td>
                                    <td class="px-3 py-2 text-dark"><?= Html::encode($cn) ?></td>
                                    <td class="px-3 py-2 text-dark"><?= Html::encode($row->fecha_novedad ?? '—') ?></td>
                                    <td class="px-3 py-2 text-dark"><?= Html::encode($hi) ?> — <?= Html::encode($hf) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?= Html::encode(Yii::t('app', 'Cancelar')) ?></button>
                <?= Html::beginForm(['delete', 'id' => $model->id], 'post') ?>
                <?= Html::submitButton(Yii::t('app', 'Sí, eliminar'), ['class' => 'btn btn-danger']) ?>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
