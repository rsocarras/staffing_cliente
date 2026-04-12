<?php

use app\models\Novedad;
use app\models\NovedadTipo;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

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

$tieneFlujoAprobacion = false;
$totalImporte = 0.0;
$nSolicitudes = count($novedades);
if ($novedades !== []) {
    $tieneFlujoAprobacion = NovedadTipo::tipoTieneFlujoAprobacion((int) $novedades[0]->novedad_tipo_id);
    foreach ($novedades as $nv) {
        if ($nv->importe !== null && (string) $nv->importe !== '') {
            $totalImporte += (float) $nv->importe;
        }
    }
}

$swalTextoConfirmar = $tieneFlujoAprobacion
    ? Yii::t('app', '¿Enviar estas {n} solicitudes? Pasarán a estado pendiente de aprobación.', ['n' => $nSolicitudes])
    : Yii::t('app', '¿Registrar estas {n} solicitudes? Quedarán aprobadas automáticamente porque este tipo no tiene flujo de aprobación configurado.', ['n' => $nSolicitudes]);
$swalTextoEliminar = Yii::t('app', '¿Eliminar definitivamente estas {n} solicitudes en borrador? Esta acción no se puede deshacer.', ['n' => $nSolicitudes]);

$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => [\yii\web\JqueryAsset::class]]);
$jsResumenSwal = <<<'JS'
(function ($) {
  var tConfirmar = __T_CONFIRMAR__;
  var tTituloConfirmar = __T_TITULO_CONFIRMAR__;
  var btnConfirmar = __T_BTN_CONFIRMAR__;
  var tEliminar = __T_ELIMINAR__;
  var tTituloEliminar = __T_TITULO_ELIMINAR__;
  var btnEliminar = __T_BTN_ELIMINAR__;
  function fireConfirmar() {
    if (typeof Swal === 'undefined') {
      if (window.confirm(tConfirmar)) {
        document.getElementById('form-confirmar-borrador-horas').submit();
      }
      return;
    }
    Swal.fire({
      title: tTituloConfirmar,
      text: tConfirmar,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#6c757d',
      confirmButtonText: btnConfirmar,
      cancelButtonText: __T_CANCELAR__,
      focusCancel: true
    }).then(function (r) {
      if (r.isConfirmed) {
        document.getElementById('form-confirmar-borrador-horas').submit();
      }
    });
  }
  function fireEliminar() {
    if (typeof Swal === 'undefined') {
      if (window.confirm(tEliminar)) {
        document.getElementById('form-eliminar-borrador-horas').submit();
      }
      return;
    }
    Swal.fire({
      title: tTituloEliminar,
      text: tEliminar,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: btnEliminar,
      cancelButtonText: __T_CANCELAR__,
      focusCancel: true
    }).then(function (r) {
      if (r.isConfirmed) {
        document.getElementById('form-eliminar-borrador-horas').submit();
      }
    });
  }
  $(document).on('click', '#btn-resumen-confirmar-envio', function (e) {
    e.preventDefault();
    fireConfirmar();
  });
  $(document).on('click', '#btn-resumen-eliminar-borrador', function (e) {
    e.preventDefault();
    fireEliminar();
  });
})(jQuery);
JS;
$jsResumenSwal = str_replace(
    [
        '__T_CONFIRMAR__',
        '__T_TITULO_CONFIRMAR__',
        '__T_BTN_CONFIRMAR__',
        '__T_ELIMINAR__',
        '__T_TITULO_ELIMINAR__',
        '__T_BTN_ELIMINAR__',
        '__T_CANCELAR__',
    ],
    [
        Json::encode($swalTextoConfirmar),
        Json::encode(Yii::t('app', 'Confirmar envío')),
        Json::encode(Yii::t('app', 'Sí, confirmar envío')),
        Json::encode($swalTextoEliminar),
        Json::encode(Yii::t('app', 'Eliminar borrador')),
        Json::encode(Yii::t('app', 'Sí, eliminar')),
        Json::encode(Yii::t('app', 'Cancelar')),
    ],
    $jsResumenSwal
);
$this->registerJs($jsResumenSwal, View::POS_READY);
?>

<div class="page-wrapper">
    <div class="content">
        <!-- Encabezado (mismo patrón que index / create) -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 justify-content-between">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                        <ol class="breadcrumb mb-0 mt-2">
                            <li class="breadcrumb-item">
                                <a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><?= Html::encode(Yii::t('app', 'Novedades')) ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                    <?= Html::a(
                        '<i class="ti ti-arrow-left me-1"></i>' . Yii::t('app', 'Volver al listado'),
                        ['index'],
                        ['class' => 'btn btn-light', 'encode' => false]
                    ) ?>
                </div>
            </div>
        </div>

        <!-- Contexto compacto -->
        <div class="rounded border border-dashed bg-light p-2 p-md-3 mb-3 novedad-solicitud-seccion">
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3 mb-2">
                <span class="avatar avatar-sm bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="ti ti-user fs-16"></i>
                </span>
                <div class="flex-grow-1 min-w-0">
                    <h6 class="fw-semibold mb-0 fs-14"><?= Html::encode(Yii::t('app', 'Contexto de la solicitud')) ?></h6>
                </div>
                <div class="text-muted small ms-md-auto">
                    <?= Html::encode(
                        $nSolicitudes === 1
                            ? Yii::t('app', '1 solicitud')
                            : Yii::t('app', '{n} solicitudes', ['n' => $nSolicitudes])
                    ) ?>
                    <?php if ($batchId !== ''): ?>
                        <span class="text-body-secondary"> · </span><?= Html::encode(Yii::t('app', 'Lote')) ?>: <?= Html::encode($batchId) ?>
                    <?php endif; ?>
                    <span class="text-body-secondary"> · </span><?= Html::encode(Yii::t('app', 'Total')) ?>: <?= Html::encode(Yii::$app->formatter->asCurrency($totalImporte)) ?>
                </div>
            </div>
            <div class="table-responsive rounded border bg-white">
                <table class="table table-sm table-borderless mb-0 align-middle">
                    <thead class="table-light">
                        <tr class="text-muted text-uppercase small">
                            <th class="py-2 px-3 fw-semibold border-end"><?= Html::encode(Yii::t('app', 'Nombre')) ?></th>
                            <th class="py-2 px-3 fw-semibold border-end"><?= Html::encode(Yii::t('app', 'Documento')) ?></th>
                            <th class="py-2 px-3 fw-semibold border-end"><?= Html::encode(Yii::t('app', 'Cargo')) ?></th>
                            <th class="py-2 px-3 fw-semibold border-end"><?= Html::encode(Yii::t('app', 'Organización')) ?></th>
                            <th class="py-2 px-3 fw-semibold"><?= Html::encode(Yii::t('app', 'Empresa cliente')) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-3 text-dark border-end"><?= Html::encode($resumenContexto['nombre']) ?></td>
                            <td class="py-2 px-3 text-dark border-end"><?= Html::encode($resumenContexto['documento']) ?></td>
                            <td class="py-2 px-3 text-dark border-end"><?= Html::encode($resumenContexto['cargo']) ?></td>
                            <td class="py-2 px-3 text-dark border-end"><?= Html::encode($resumenContexto['organizacion']) ?></td>
                            <td class="py-2 px-3 text-dark"><?= Html::encode($resumenContexto['empresaCliente']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-0">
            <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <h5 class="mb-0"><?= Html::encode(Yii::t('app', 'Resumen de solicitudes')) ?></h5>
                <div class="d-flex flex-wrap gap-2">
                    <button
                        type="button"
                        class="btn btn-primary"
                        id="btn-resumen-confirmar-envio"
                    >
                        <i class="ti ti-send me-1" aria-hidden="true"></i><?= Html::encode(Yii::t('app', 'Confirmar envío')) ?>
                    </button>
                    <button
                        type="button"
                        class="btn btn-outline-danger"
                        id="btn-resumen-eliminar-borrador"
                    >
                        <i class="ti ti-trash me-1" aria-hidden="true"></i><?= Html::encode(Yii::t('app', 'Eliminar borrador')) ?>
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
    </div>
</div>

<?= Html::beginForm(['confirmar-borrador-horas'], 'post', ['id' => 'form-confirmar-borrador-horas', 'class' => 'd-none']) ?>
<?= Html::endForm() ?>
<?= Html::beginForm(['eliminar-borrador-horas'], 'post', ['id' => 'form-eliminar-borrador-horas', 'class' => 'd-none']) ?>
<?= Html::endForm() ?>
