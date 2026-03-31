<?php

use app\models\Novedad;
use app\models\NovedadConcepto;
use app\models\NovedadFlujo;
use app\models\NovedadTipo;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var NovedadTipo[] $tipos */
/** @var NovedadFlujo[] $flujos */
/** @var app\models\Profile[] $profiles */
/** @var NovedadConcepto[] $conceptosFiltro */

$hasFlujoCol = Novedad::hasNovedadFlujoIdColumn();
$conceptosFiltro = $conceptosFiltro ?? [];
/** @var array $summaryCounts */

$canAddNovedad = $tipos !== [] && $flujos !== [] && $profiles !== [];

$this->title = 'Novedades';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$dataUrl = Url::to(['/novedad/data']);
$viewAjaxUrl = Url::to(['/novedad/view-ajax']);
$formAjaxUrl = Url::to(['/novedad/form-ajax']);
$updateAjaxUrl = Url::to(['/novedad/update-ajax']);
$flujoAjaxUrl = Url::to(['/novedad/flujo-ajax']);
$deleteUrl = Url::to(['/novedad/delete']);
$conceptosUrl = Url::to(['/novedad/conceptos-por-tipo']);
$kanbanDataNovedadUrl = Url::to(['/novedad/kanban-data-novedad']);
$moveStepUrl = Url::to(['/novedad/move-step']);
$solicitudWebUrl = Url::to(['/novedad/create']);

$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$this->registerCss('
#modal-flujo-novedad.modal { overflow: visible !important; }
#modal-flujo-novedad .modal-dialog,
#modal-flujo-novedad .modal-content { overflow: visible !important; }
#modal-flujo-novedad .modal-body { overflow: visible !important; max-height: none; padding-top: 0.5rem; }
.novedad-flujo-kanban { overflow-x: auto !important; overflow-y: visible !important; -webkit-overflow-scrolling: touch; }
.novedad-flujo-kanban .kanban-card.kanban-card-locked {
    opacity: 0.48;
    filter: grayscale(0.4);
    box-shadow: none !important;
}
.novedad-flujo-kanban .kanban-card.kanban-card-minimal {
    background: transparent;
    border: none;
    box-shadow: none !important;
    padding: 0;
}
.novedad-flujo-kanban .kanban-card.kanban-card-minimal .kanban-card-swatch {
    height: 40px;
    min-width: 100%;
    border-radius: 0.375rem;
}
.novedad-flujo-kanban .kanban-step-action:disabled {
    opacity: 0.55;
}
');
?>

<div class="page-wrapper">
    <div class="content">
        <!-- 1. Encabezado -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                        <p class="text-muted small mb-0 mt-1">
                            <?= Html::encode(Yii::t('app', 'Alta, edición y seguimiento del flujo de cada novedad.')) ?>
                            <a href="<?= Html::encode($solicitudWebUrl) ?>" class="text-primary text-decoration-none fw-medium ms-1">
                                <i class="ti ti-file-plus fs-14 align-middle"></i>
                                <?= Html::encode(Yii::t('app', 'Nueva solicitud (formulario web)')) ?>
                            </a>
                        </p>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item">Sistema</li>
                            <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Cards resumen -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row row-gap-4">
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-building fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Total novedades</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['total'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-info flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-clock fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">En curso</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['en_curso'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-success flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-check fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Resueltas</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['resueltas'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Contenido: alertas, acciones y tabla -->
        <div class="card mb-0">
            <div class="card-body py-3">
                <?php if ($tipos === []): ?>
                    <div class="alert alert-info mb-4">
                        No hay tipos de novedad para su empresa. Definí tipos en <strong>Sistema → Tipo de Novedad</strong> antes de crear novedades.
                    </div>
                <?php endif; ?>
                <?php if ($tipos !== [] && $flujos !== [] && $profiles === []): ?>
                    <div class="alert alert-warning mb-4">
                        No hay colaboradores activos en su empresa para asociar a la novedad. Verificá empleados / perfiles.
                    </div>
                <?php endif; ?>
                <?php if ($hasFlujoCol && $tipos !== [] && $flujos === []): ?>
                    <div class="alert alert-warning mb-4">
                        No hay <strong>flujos de novedad activos</strong> en el sistema. Algunas columnas y el tablero Kanban pueden no estar disponibles. Contactá al administrador.
                    </div>
                <?php endif; ?>

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                    <div class="input-group w-auto input-group-flat" style="min-width: 220px;">
                        <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control form-control-sm" id="novedad-search" placeholder="<?= Html::encode(Yii::t('app', 'Buscar en tabla…')) ?>">
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="<?= Html::encode($solicitudWebUrl) ?>" class="btn btn-outline-primary">
                            <i class="ti ti-file-plus me-1"></i><?= Html::encode(Yii::t('app', 'Nueva solicitud')) ?>
                        </a>
                    </div>
                </div>

                <div class="card border rounded-3 mb-4 bg-light bg-opacity-25">
                    <div class="card-body py-3">
                        <div class="row g-2 align-items-end">
                            <div class="col-6 col-md-4 col-lg-2">
                                <label class="form-label small text-muted mb-1" for="novedad-filter-estado"><?= Html::encode(Yii::t('app', 'Estado')) ?></label>
                                <select class="form-select form-select-sm novedad-list-filter" id="novedad-filter-estado">
                                    <option value=""><?= Html::encode(Yii::t('app', 'Todos')) ?></option>
                                    <option value="<?= Html::encode(Novedad::ESTADO_BORRADOR) ?>"><?= Html::encode(Yii::t('app', 'Borrador')) ?></option>
                                    <option value="<?= Html::encode(Novedad::ESTADO_PENDIENTE) ?>"><?= Html::encode(Yii::t('app', 'Pendiente')) ?></option>
                                    <option value="<?= Html::encode(Novedad::ESTADO_APROBADA) ?>"><?= Html::encode(Yii::t('app', 'Aprobada')) ?></option>
                                    <option value="<?= Html::encode(Novedad::ESTADO_RECHAZADA) ?>"><?= Html::encode(Yii::t('app', 'Rechazada')) ?></option>
                                </select>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2">
                                <label class="form-label small text-muted mb-1" for="novedad-filter-tipo"><?= Html::encode(Yii::t('app', 'Tipo')) ?></label>
                                <select class="form-select form-select-sm novedad-list-filter" id="novedad-filter-tipo">
                                    <option value=""><?= Html::encode(Yii::t('app', 'Todos')) ?></option>
                                    <?php foreach ($tipos as $t): ?>
                                        <option value="<?= (int) $t->id ?>"><?= Html::encode($t->nombre) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2">
                                <label class="form-label small text-muted mb-1" for="novedad-filter-concepto"><?= Html::encode(Yii::t('app', 'Concepto')) ?></label>
                                <select class="form-select form-select-sm novedad-list-filter" id="novedad-filter-concepto">
                                    <option value=""><?= Html::encode(Yii::t('app', 'Todos')) ?></option>
                                    <?php foreach ($conceptosFiltro as $conc): ?>
                                        <option value="<?= (int) $conc->id ?>"><?= Html::encode($conc->nombre) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2">
                                <label class="form-label small text-muted mb-1" for="novedad-filter-profile"><?= Html::encode(Yii::t('app', 'Persona')) ?></label>
                                <select class="form-select form-select-sm novedad-list-filter" id="novedad-filter-profile">
                                    <option value=""><?= Html::encode(Yii::t('app', 'Todas')) ?></option>
                                    <?php foreach ($profiles as $pf): ?>
                                        <option value="<?= (int) $pf->user_id ?>"><?= Html::encode(trim((string) ($pf->name ?: $pf->num_doc ?: '#' . $pf->user_id))) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2">
                                <label class="form-label small text-muted mb-1" for="novedad-filter-fecha-desde"><?= Html::encode(Yii::t('app', 'Fecha desde')) ?></label>
                                <input type="date" class="form-control form-control-sm novedad-list-filter" id="novedad-filter-fecha-desde">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2">
                                <label class="form-label small text-muted mb-1" for="novedad-filter-fecha-hasta"><?= Html::encode(Yii::t('app', 'Fecha hasta')) ?></label>
                                <input type="date" class="form-control form-control-sm novedad-list-filter" id="novedad-filter-fecha-hasta">
                            </div>
                            <div class="col-12 col-lg-auto ms-lg-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="novedad-filter-clear">
                                    <i class="ti ti-filter-off me-1"></i><?= Html::encode(Yii::t('app', 'Limpiar filtros')) ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="novedad-table">
                        <thead>
                            <tr>
                                <th><?= Html::encode(Yii::t('app', 'ID')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Organización')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Persona')) ?></th>
                                <th class="text-end"><?= Html::encode(Yii::t('app', 'Importe')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Concepto')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Tipo')) ?></th>
                                <?php if ($hasFlujoCol): ?>
                                    <th><?= Html::encode(Yii::t('app', 'Flujo')) ?></th>
                                <?php endif; ?>
                                <th><?= Html::encode(Yii::t('app', 'Estado')) ?></th>
                                <?php if ($hasFlujoCol): ?>
                                    <th><?= Html::encode(Yii::t('app', 'Paso actual')) ?></th>
                                <?php endif; ?>
                                <th class="text-end"><?= Html::encode(Yii::t('app', 'Acciones')) ?></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver -->
<div class="modal fade" id="modal-view-novedad">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-view-novedad-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modal-edit-novedad">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar novedad</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Tipo, concepto, estado, datos y paso en el flujo.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-novedad-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-novedad">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Flujo (Kanban): sin modal-dialog-scrollable para mejor visualización del tablero -->
<div class="modal fade" id="modal-flujo-novedad">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content position-relative border-0 shadow">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-flujo-novedad-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Motivo al retroceder paso en Kanban (encima del modal Flujo) -->
<div class="modal fade" id="modal-motivo-retro-kanban" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold"><i class="ti ti-arrow-back-up me-2 text-warning"></i>Motivo del retroceso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="text-muted small mb-2">Al volver a un paso anterior del flujo se requiere un motivo para dejar constancia en el historial.</p>
                <label class="form-label fw-medium" for="motivo-retro-kanban-input">Motivo</label>
                <textarea id="motivo-retro-kanban-input" class="form-control" rows="3" placeholder="Ej. corrección de datos, pedido del área…" required></textarea>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-motivo-retro-kanban-confirm">Confirmar movimiento</button>
            </div>
        </div>
    </div>
</div>

<?php
$hasFlujoJs = $hasFlujoCol ? 'true' : 'false';
if ($hasFlujoCol) {
    $columnsJs = <<<'COLS'
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, className: 'text-end', render: function(d) { return d || ''; } },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5, render: function(d) { return d || ''; } },
            { data: 6, render: function(d) { return d || ''; } },
            { data: 7, render: function(d) { return d || ''; } },
            { data: 8, render: function(d) { return d || ''; } },
            { data: 9, className: 'text-end', orderable: false, render: function(d) { return d || ''; } }
COLS;
} else {
    $columnsJs = <<<'COLS'
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, className: 'text-end', render: function(d) { return d || ''; } },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5, render: function(d) { return d || ''; } },
            { data: 6, render: function(d) { return d || ''; } },
            { data: 7, className: 'text-end', orderable: false, render: function(d) { return d || ''; } }
COLS;
}

$js = <<<JS
$(document).ready(function() {
    var hasFlujoCol = {$hasFlujoJs};

    var table = $('#novedad-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{$dataUrl}',
            data: function (d) {
                d.filter_estado = $('#novedad-filter-estado').val() || '';
                d.filter_novedad_tipo_id = $('#novedad-filter-tipo').val() || '';
                d.filter_concepto_id = $('#novedad-filter-concepto').val() || '';
                d.filter_profile_id = $('#novedad-filter-profile').val() || '';
                d.filter_fecha_desde = $('#novedad-filter-fecha-desde').val() || '';
                d.filter_fecha_hasta = $('#novedad-filter-fecha-hasta').val() || '';
            }
        },
        columns: [
{$columnsJs}
        ],
        order: [[0, 'desc']],
        pageLength: 10,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" },
            zeroRecords: "No se encontraron registros",
            processing: "Procesando..."
        }
    });

    $(document).on('change', '.novedad-list-filter', function () {
        table.draw();
    });
    $('#novedad-filter-clear').on('click', function () {
        $('#novedad-filter-estado, #novedad-filter-tipo, #novedad-filter-concepto, #novedad-filter-profile').val('');
        $('#novedad-filter-fecha-desde, #novedad-filter-fecha-hasta').val('');
        table.draw();
    });

    $('#novedad-search').on('keyup', function() {
        table.search(this.value).draw();
    });

    function escapeHtml(s) {
        if (!s) { return ''; }
        return String(s).replace(/[&<>\"']/g, function (ch) {
            return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '\"': '&quot;', "'": '&#39;' })[ch];
        });
    }

    $(document).on('click', '.btn-novedad-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-novedad'));
        $('#modal-view-novedad-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-novedad-body').html(html);
        }).fail(function() {
            $('#modal-view-novedad-body').html('<div class="alert alert-danger">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-novedad-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-novedad'));
        $('#modal-edit-novedad-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-novedad').data('id', id).removeClass('d-none');
        modal.show();
        $.ajax({
            url: '{$formAjaxUrl}',
            data: { id: id },
            type: 'GET',
            dataType: 'html'
        }).done(function(html) {
            $('#modal-edit-novedad-body').html(html);
            $('#btn-save-edit-novedad').removeClass('d-none');
        }).fail(function(xhr) {
            if (xhr.status === 403 && xhr.responseText) {
                $('#modal-edit-novedad-body').html(xhr.responseText);
                $('#btn-save-edit-novedad').addClass('d-none');
                return;
            }
            $('#modal-edit-novedad-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#modal-flujo-novedad').on('hidden.bs.modal', function() {
        var \$b = $('#novedad-flujo-kanban-banner');
        if (\$b.length) { \$b.empty(); }
        var \$h = $('#novedad-flujo-kanban-hint');
        if (\$h.length) { \$h.show(); }
    });

    function postMoveData(extra) {
        var o = { '{$csrfParam}': '{$csrfToken}' };
        if (extra) { for (var k in extra) { o[k] = extra[k]; } }
        return o;
    }

    var motivoRetroConfirmed = false;
    var pendingRetroKanban = null;

    function submitKanbanMove(novedadId, rawStepId, motivo) {
        var payload = postMoveData({
            novedad_id: novedadId,
            novedad_step_id: rawStepId === undefined || rawStepId === null || rawStepId === '' ? '' : String(rawStepId),
            motivo: motivo || ''
        });
        $.ajax({
            url: '{$moveStepUrl}',
            type: 'POST',
            data: payload,
            dataType: 'json'
        }).fail(function (xhr) {
            var msg = 'No se pudo guardar el movimiento.';
            if (xhr.responseJSON && xhr.responseJSON.message) { msg = xhr.responseJSON.message; }
            alert(msg);
            loadFlujoKanbanForNovedad(novedadId);
        }).done(function (res) {
            if (res && res.requires_motivo) {
                pendingRetroKanban = { novedadId: novedadId, rawStepId: rawStepId };
                motivoRetroConfirmed = false;
                $('#motivo-retro-kanban-input').val('');
                bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-motivo-retro-kanban')).show();
                return;
            }
            if (res && res.success) {
                table.ajax.reload(null, false);
                if (res.readonly) { return; }
                loadFlujoKanbanForNovedad(novedadId);
            } else {
                alert((res && res.message) ? res.message : 'No se pudo actualizar.');
                loadFlujoKanbanForNovedad(novedadId);
            }
        });
    }

    $(document).on('click', '#btn-motivo-retro-kanban-confirm', function() {
        if (!pendingRetroKanban) { return; }
        var mot = $('#motivo-retro-kanban-input').val().trim();
        if (!mot) {
            alert('Indique el motivo para volver al paso anterior.');
            return;
        }
        motivoRetroConfirmed = true;
        var p = pendingRetroKanban;
        pendingRetroKanban = null;
        var inst = bootstrap.Modal.getInstance(document.getElementById('modal-motivo-retro-kanban'));
        if (inst) { inst.hide(); }
        submitKanbanMove(p.novedadId, p.rawStepId, mot);
    });

    $('#modal-motivo-retro-kanban').on('hidden.bs.modal', function() {
        if (!motivoRetroConfirmed && pendingRetroKanban) {
            var nid = pendingRetroKanban.novedadId;
            pendingRetroKanban = null;
            loadFlujoKanbanForNovedad(nid);
        }
        motivoRetroConfirmed = false;
    });

    function pasoStepEstadoColorClass(estado) {
        if (estado === 'pendiente') { return 'bg-warning'; }
        if (estado === 'en_curso') { return 'bg-primary'; }
        if (estado === 'completado') { return 'bg-success'; }
        if (estado === 'omitido') { return 'bg-secondary'; }
        if (estado === 'devuelto') { return 'bg-danger'; }
        return 'bg-secondary';
    }

    function pasoStepEstadoBadgeClass(estado) {
        if (estado === 'pendiente') { return 'bg-warning text-dark'; }
        if (estado === 'en_curso') { return 'bg-primary'; }
        if (estado === 'completado') { return 'bg-success'; }
        if (estado === 'omitido') { return 'bg-secondary'; }
        if (estado === 'devuelto') { return 'bg-danger'; }
        return 'bg-secondary';
    }

    function renderKanbanCard(c, readonly, locked) {
        var roClass = readonly ? ' kanban-readonly' : '';
        var lockClass = locked ? ' kanban-card-locked' : '';
        var titleAttr = locked ? ' title="Este paso está asignado a otro responsable; no podés cambiar de paso."' : '';
        var sw = pasoStepEstadoColorClass(c.paso_step_estado || '');
        var label = escapeHtml(c.paso_step_estado_label || '—');
        var sel = '';
        if (!readonly && !locked) {
            var selOpen = '<select class="form-select form-select-sm kanban-step-action mt-2" data-novedad-id="' + c.id + '"';
            if (c.next_step_id) { selOpen += ' data-next-step-id="' + c.next_step_id + '"'; }
            if (c.prev_step_id) { selOpen += ' data-prev-step-id="' + c.prev_step_id + '"'; }
            selOpen += '>';
            var parts = [selOpen];
            parts.push('<option value="">' + escapeHtml('Elegir acción…') + '</option>');
            if (c.next_step_id) {
                parts.push('<option value="next">' + escapeHtml('Avanzar → ' + (c.next_step_nombre || 'siguiente')) + '</option>');
            }
            if (c.prev_step_id) {
                parts.push('<option value="prev">' + escapeHtml('Volver ← ' + (c.prev_step_nombre || 'anterior')) + '</option>');
            }
            parts.push('</select>');
            sel = parts.join('');
        }
        return (
            '<div class="kanban-card kanban-card-minimal mb-2' + roClass + lockClass + '" data-novedad-id="' + c.id + '"' + titleAttr + '>' +
            '<div class="kanban-card-swatch ' + sw + ' shadow-sm" role="img" aria-label="' + label + '"></div>' +
            '<div class="text-center small fw-medium mt-1 px-1 text-dark">' + label + '</div>' +
            sel +
            '</div>'
        );
    }

    function renderFlujoKanban(data) {
        var \$host = $('#novedad-flujo-kanban-columns');
        var \$banner = $('#novedad-flujo-kanban-banner');
        var \$hint = $('#novedad-flujo-kanban-hint');
        if (\$banner.length) { \$banner.empty(); }
        if (!\$host.length) { return; }
        \$host.empty();
        if (!data.success) {
            \$host.html('<div class="alert alert-warning mb-0">' + escapeHtml(data.message || 'Error') + '</div>');
            return;
        }
        var steps = data.steps || [];
        var cols = data.columns || {};
        var kanbanReadonly = !!data.is_ultimo_paso;
        if (\$banner.length && !kanbanReadonly && data.can_move === false) {
            \$banner.html(
                '<div class="alert alert-warning border-0 mb-0 py-2">' +
                '<i class="ti ti-lock me-1"></i> El paso actual tiene un <strong>responsable asignado</strong> distinto a tu usuario. No podés cambiar de paso desde el tablero.' +
                '</div>'
            );
        } else if (\$banner.length && !kanbanReadonly) {
            \$banner.empty();
        }
        var html = '';
        steps.forEach(function (s) {
            var list = cols[String(s.id)] || [];
            var stepNum = s.step_index || 1;
            html += '<div class="flex-shrink-0" style="width:280px">';
            html += '<div class="fw-semibold small text-dark mb-0">Paso ' + stepNum + '</div>';
            html += '<div class="text-muted small mb-1">' + escapeHtml(s.nombre) + '</div>';
            if (s.estado_label) {
                html += '<div class="mb-2"><span class="badge ' + pasoStepEstadoBadgeClass(s.estado) + '">' + escapeHtml(s.estado_label) + '</span></div>';
            }
            html += '<div class="kanban-column border rounded p-2 bg-white" style="min-height:120px" data-step-id="' + s.id + '" data-step-orden="' + (typeof s.orden !== 'undefined' ? s.orden : 0) + '">';
            list.forEach(function (card) {
                var locked = !kanbanReadonly && card.can_move === false;
                html += renderKanbanCard(card, kanbanReadonly, locked);
            });
            html += '</div></div>';
        });
        if (steps.length === 0) {
            html = '<div class="text-muted small">No hay pasos en este flujo.</div>';
        }
        \$host.html(html);

        if (kanbanReadonly) {
            if (\$hint.length) { \$hint.hide(); }
            if (\$banner.length) {
                \$banner.html(
                    '<div class="alert alert-info border-0 mb-0">' +
                    '<i class="ti ti-info-circle me-1"></i> Esta novedad ya está en el <strong>último paso</strong> del flujo. No se puede modificar desde el tablero. Esta ventana se cerrará sola.' +
                    '</div>'
                );
            }
            var modalFlujoEl = document.getElementById('modal-flujo-novedad');
            setTimeout(function () {
                var inst = bootstrap.Modal.getInstance(modalFlujoEl);
                if (inst) { inst.hide(); }
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'info',
                        title: 'Último paso',
                        text: 'La novedad completó el flujo configurado.',
                        timer: 2800,
                        showConfirmButton: false
                    });
                }
            }, 1800);
            return;
        }
        if (\$hint.length) { \$hint.show(); }
    }

    $(document).on('change', '.kanban-step-action', function () {
        var \$sel = $(this);
        var v = \$sel.val();
        if (!v) {
            return;
        }
        var novedadId = parseInt(\$sel.attr('data-novedad-id'), 10);
        var stepId = v === 'next' ? \$sel.attr('data-next-step-id') : (v === 'prev' ? \$sel.attr('data-prev-step-id') : null);
        \$sel.val('');
        if (!stepId || !novedadId) {
            return;
        }
        if (v === 'prev') {
            pendingRetroKanban = { novedadId: novedadId, rawStepId: stepId };
            motivoRetroConfirmed = false;
            $('#motivo-retro-kanban-input').val('');
            bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-motivo-retro-kanban')).show();
            return;
        }
        submitKanbanMove(novedadId, stepId, '');
    });

    function loadFlujoKanbanForNovedad(novedadId) {
        var \$host = $('#novedad-flujo-kanban-columns');
        if (!\$host.length) { return; }
        var \$banner = $('#novedad-flujo-kanban-banner');
        if (\$banner.length) { \$banner.empty(); }
        var \$hint = $('#novedad-flujo-kanban-hint');
        if (\$hint.length) { \$hint.show(); }
        \$host.html('<div class="text-muted py-2 small">Cargando tablero…</div>');
        $.getJSON('{$kanbanDataNovedadUrl}', { novedad_id: novedadId })
            .done(renderFlujoKanban)
            .fail(function (xhr) {
                var msg = 'No se pudo cargar el tablero.';
                if (xhr.responseJSON && xhr.responseJSON.message) { msg = xhr.responseJSON.message; }
                \$host.html('<div class="alert alert-danger mb-0">' + escapeHtml(msg) + '</div>');
            });
    }

    $(document).on('click', '.btn-novedad-flujo', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-flujo-novedad'));
        $('#modal-flujo-novedad-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$flujoAjaxUrl}', { id: id }, function(html) {
            $('#modal-flujo-novedad-body').html(html);
            if ($('#novedad-flujo-kanban-columns').length) {
                loadFlujoKanbanForNovedad(id);
            }
        }).fail(function() {
            $('#modal-flujo-novedad-body').html('<div class="alert alert-danger">Error al cargar el flujo.</div>');
        });
    });

    $('#btn-save-edit-novedad').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-novedad-modal');
        var \$btn = $(this);
        var \$errors = $('#novedad-edit-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';

        $.ajax({
            url: '{$updateAjaxUrl}?id=' + encodeURIComponent(id),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var m = bootstrap.Modal.getInstance(document.getElementById('modal-edit-novedad'));
                    m.hide();
                    table.ajax.reload(null, false);
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push(res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]);
                        }
                    }
                    \$errors.html(errors.join('<br>')).removeClass('d-none');
                }
            },
            error: function() {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $(document).on('click', '.btn-novedad-delete', function() {
        var id = $(this).data('id');
        var label = $(this).data('label') || 'este registro';

        if (typeof Swal === 'undefined') {
            if (confirm('¿Eliminar la novedad ' + label + '?')) {
                doDelete(id);
            }
            return;
        }
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará la novedad ' + label + '.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) { doDelete(id); }
        });
    });

    function doDelete(id) {
        $.ajax({
            url: '{$deleteUrl}',
            type: 'POST',
            data: { id: id, '{$csrfParam}': '{$csrfToken}' },
            dataType: 'json',
            success: function(res) {
                if (res && res.success === false) {
                    var m = (res.message) ? res.message : 'No se pudo eliminar.';
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ title: 'No permitido', text: m, icon: 'warning' });
                    } else {
                        alert(m);
                    }
                    return;
                }
                table.ajax.reload(null, false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'El registro ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
                }
            },
            error: function(xhr) {
                var m = 'No se pudo eliminar.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    m = xhr.responseJSON.message;
                }
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: xhr.status === 403 ? 'No permitido' : 'Error', text: m, icon: xhr.status === 403 ? 'warning' : 'error' });
                } else {
                    alert(m);
                }
            }
        });
    }

    $(document).on('change', '#novedad-edit-tipo', function() {
        var tid = $(this).val();
        var \$c = $('#novedad-edit-concepto');
        if (!\$c.length) { return; }
        \$c.empty().append('<option value=\"\">Cargando…</option>');
        if (!tid) { return; }
        $.getJSON('{$conceptosUrl}', { novedad_tipo_id: tid })
            .done(function (res) {
                \$c.empty();
                if (!res.success || !res.items || !res.items.length) {
                    \$c.append('<option value=\"\">Sin conceptos</option>');
                    return;
                }
                res.items.forEach(function (it) {
                    \$c.append('<option value=\"' + it.id + '\">' + escapeHtml(it.nombre) + '</option>');
                });
            });
    });

});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>