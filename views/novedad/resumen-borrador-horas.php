<?php

use app\models\Novedad;
use app\models\NovedadTipo;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var Novedad[] $novedades */
/** @var string $batchId */
/** @var array{nombre: string, documento: string, cargo: string, organizacion: string, empresaCliente: string} $resumenContexto */

$batchId = $batchId ?? '';
$resumenContexto = $resumenContexto ?? [
    'nombre' => '—',
    'documento' => '—',
    'cargo' => '—',
    'organizacion' => '—',
    'empresaCliente' => '—',
];

$this->title = Yii::t('app', 'Revisar solicitudes (borrador)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Solicitudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$empleadoNombre = '';
$tieneFlujoAprobacion = false;
$totalImporte = 0.0;
if ($novedades !== []) {
    $p = $novedades[0]->profile;
    $empleadoNombre = $p && trim((string) $p->name) !== '' ? (string) $p->name : '';
    $tieneFlujoAprobacion = NovedadTipo::tipoTieneFlujoAprobacion((int) $novedades[0]->novedad_tipo_id);
    foreach ($novedades as $nv) {
        if ($nv->importe !== null && (string) $nv->importe !== '') {
            $totalImporte += (float) $nv->importe;
        }
    }
}
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
                <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
            </ol>
        </nav>
    </div>
    <?= Html::a(Yii::t('app', 'Volver al listado'), ['index'], ['class' => 'btn btn-light']) ?>
</div>

<div class="alert alert-info">
    <?= Html::encode(Yii::t('app', 'Se crearon {n} solicitudes en borrador. Revise los datos y confirme el envío o elimine el borrador.', ['n' => count($novedades)])) ?>
    <?php if ($empleadoNombre !== ''): ?>
        <br><strong><?= Html::encode(Yii::t('app', 'Empleado: {n}', ['n' => $empleadoNombre])) ?></strong>
    <?php endif; ?>
    <?php if ($batchId !== ''): ?>
        <br><span class="text-muted small"><?= Html::encode(Yii::t('app', 'Lote:')) ?> <?= Html::encode($batchId) ?></span>
    <?php endif; ?>
    <br><strong><?= Html::encode(Yii::t('app', 'Total importe:')) ?></strong>
    <?= Html::encode(Yii::$app->formatter->asCurrency($totalImporte)) ?>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body py-3">
        <div class="row g-3 small">
            <div class="col-md-4">
                <div class="text-muted text-uppercase fw-semibold mb-1"><?= Html::encode(Yii::t('app', 'Empleado')) ?></div>
                <div class="fw-medium"><?= Html::encode($resumenContexto['nombre']) ?></div>
                <div class="text-muted"><?= Html::encode($resumenContexto['documento']) ?></div>
            </div>
            <div class="col-md-4">
                <div class="text-muted text-uppercase fw-semibold mb-1"><?= Html::encode(Yii::t('app', 'Cargo')) ?></div>
                <div><?= Html::encode($resumenContexto['cargo']) ?></div>
            </div>
            <div class="col-md-4">
                <div class="text-muted text-uppercase fw-semibold mb-1"><?= Html::encode(Yii::t('app', 'Organización')) ?></div>
                <div><?= Html::encode($resumenContexto['organizacion']) ?></div>
                <div class="mt-2 text-muted text-uppercase fw-semibold mb-1"><?= Html::encode(Yii::t('app', 'Empresa cliente')) ?></div>
                <div><?= Html::encode($resumenContexto['empresaCliente']) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <h5 class="mb-0"><?= Html::encode(Yii::t('app', 'Detalle del troceo')) ?></h5>
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConfirmarBorradorHoras">
                <?= Html::encode(Yii::t('app', 'Confirmar envío')) ?>
            </button>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminarBorradorHoras">
                <?= Html::encode(Yii::t('app', 'Eliminar borrador')) ?>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="custom-datatable-filter">
            <?= $this->render('_tabla_novedades_borrador_horas', [
                'novedades' => $novedades,
                'tableClass' => 'table table-hover mb-0 align-middle',
                'compact' => false,
            ]) ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfirmarBorradorHoras" tabindex="-1" aria-labelledby="modalConfirmarBorradorHorasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmarBorradorHorasLabel"><?= Html::encode(Yii::t('app', 'Confirmar envío')) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Html::encode(Yii::t('app', 'Cerrar')) ?>"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3"><?= Html::encode($tieneFlujoAprobacion
                    ? Yii::t('app', '¿Enviar estas {n} solicitudes? Pasarán a estado pendiente de aprobación.', ['n' => count($novedades)])
                    : Yii::t('app', '¿Registrar estas {n} solicitudes? Quedarán aprobadas automáticamente porque este tipo no tiene flujo de aprobación configurado.', ['n' => count($novedades)])) ?></p>
                <?= $this->render('_tabla_novedades_borrador_horas', [
                    'novedades' => $novedades,
                    'tableClass' => 'table table-sm table-hover mb-0 align-middle border',
                    'compact' => true,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?= Html::encode(Yii::t('app', 'Cancelar')) ?></button>
                <?= Html::beginForm(['confirmar-borrador-horas'], 'post') ?>
                <?= Html::submitButton(Yii::t('app', 'Sí, confirmar envío'), ['class' => 'btn btn-primary']) ?>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEliminarBorradorHoras" tabindex="-1" aria-labelledby="modalEliminarBorradorHorasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarBorradorHorasLabel"><?= Html::encode(Yii::t('app', 'Eliminar borrador')) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Html::encode(Yii::t('app', 'Cerrar')) ?>"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger mb-3"><?= Html::encode(Yii::t('app', '¿Eliminar definitivamente estas {n} solicitudes en borrador? Esta acción no se puede deshacer.', ['n' => count($novedades)])) ?></p>
                <?= $this->render('_tabla_novedades_borrador_horas', [
                    'novedades' => $novedades,
                    'tableClass' => 'table table-sm table-hover mb-0 align-middle border',
                    'compact' => true,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?= Html::encode(Yii::t('app', 'Cancelar')) ?></button>
                <?= Html::beginForm(['eliminar-borrador-horas'], 'post') ?>
                <?= Html::submitButton(Yii::t('app', 'Sí, eliminar'), ['class' => 'btn btn-danger']) ?>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->render('/layouts/partials/footer') ?>
