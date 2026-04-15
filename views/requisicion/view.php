<?php

use app\models\Requisicion;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Requisición #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$estadoLabel = Requisicion::optsEstado()[$model->estado] ?? $model->estado;
$estadoClass = Requisicion::estadoBadgeClass($model->estado);
$grupoLabel = $model->group_uuid ?: ('REQ-' . $model->id);

$this->registerCss(<<<CSS
.requisicion-detail-panel .requisicion-detail-table > tbody > tr > th,
.requisicion-detail-panel .requisicion-detail-table > tbody > tr > td {
    padding-top: 0.7rem;
    padding-bottom: 0.7rem;
    vertical-align: top;
}
.requisicion-detail-panel .requisicion-detail-table > tbody > tr > th {
    padding-right: 1.25rem;
}
CSS);
?>
<div class="page-wrapper">
    <div class="content">
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-3">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-1"><?= Html::encode($this->title) ?></h4>
                        <p class="text-muted small mb-0">
                            <?= Html::encode('Grupo ' . $grupoLabel . ' · Vacante #' . (int) $model->vacante_index . ' de ' . (int) $model->numero_vacantes) ?>
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <?= Html::a('<i class="ti ti-arrow-left me-1"></i>Volver al listado', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                        <span class="badge badge-soft-<?= Html::encode($estadoClass) ?> align-self-center px-3 py-2"><?= Html::encode($estadoLabel) ?></span>
                        <?php if ($model->estado === Requisicion::ESTADO_DRAFT): ?>
                            <?= Html::a('<i class="ti ti-edit me-1"></i>Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#submitApprovalModal">
                                <i class="ti ti-send me-1"></i>Enviar a aprobación
                            </button>
                        <?php endif; ?>
                        <?php if ($model->estado === Requisicion::ESTADO_APPROVAL_PENDING && Yii::$app->user->can('requisicion_approve')): ?>
                            <?php $approveForm = \yii\widgets\ActiveForm::begin(['action' => ['approve', 'id' => $model->id], 'method' => 'post', 'options' => ['class' => 'd-inline']]); ?>
                            <?= Html::submitButton('<i class="ti ti-check me-1"></i>Aprobar', ['class' => 'btn btn-success']) ?>
                            <?php \yii\widgets\ActiveForm::end(); ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <i class="ti ti-x me-1"></i>Rechazar
                            </button>
                        <?php endif; ?>
                        <?php if (($model->estado === Requisicion::ESTADO_ORDER_PENDING || $model->estado === Requisicion::ESTADO_PERSON_ASSIGNED) && Yii::$app->user->can('requisicion_assign')): ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal">
                                <i class="ti ti-user-plus me-1"></i>Asignar persona
                            </button>
                        <?php endif; ?>
                        <?php if ($model->estado === Requisicion::ESTADO_PERSON_ASSIGNED && Yii::$app->user->can('requisicion_vinculacion')): ?>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#vinculacionModal">
                                <i class="ti ti-link me-1"></i>Paso vinculación
                            </button>
                        <?php endif; ?>
                        <?php if ($model->estado === Requisicion::ESTADO_HIRING_IN_PROGRESS && Yii::$app->user->can('requisicion_vinculacion')): ?>
                            <?= Html::a('<i class="ti ti-list-check me-1"></i>Checklist', ['checklist', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                            <?php if ($model->checklistCompleto()): ?>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#activateModal">
                                    <i class="ti ti-circle-check me-1"></i>Activar
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success border-0"><?= Html::encode((string) Yii::$app->session->getFlash('success')) ?></div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger border-0"><?= Html::encode((string) Yii::$app->session->getFlash('error')) ?></div>
        <?php endif; ?>

        <div class="card mb-3">
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="rounded-3 border border-dashed p-4 bg-light h-100 requisicion-detail-panel">
                            <div class="d-flex align-items-start gap-3 mb-4">
                                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-briefcase fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Datos de la vacante</h6>
                                    <p class="text-muted small mb-0">Información principal de ubicación, cargo y condiciones.</p>
                                </div>
                            </div>
                            <div class="table-responsive requisicion-detail-table-wrap">
                                <table class="table table-borderless align-middle mb-0 requisicion-detail-table">
                                    <tbody>
                                        <tr><th class="w-50 text-muted fw-medium">Empresa</th><td><?= Html::encode($model->empresa->nombre ?? '—') ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Ciudad</th><td><?= Html::encode($model->ciudad->name ?? '—') ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Sede</th><td><?= Html::encode($model->sede->nombre ?? '—') ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Área / Subárea</th><td><?= Html::encode($model->area->nombre ?? '—') ?> / <?= Html::encode($model->subArea->nombre ?? '—') ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Cargo</th><td><?= Html::encode($model->cargo->nombre ?? '—') ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Jornada</th><td><?= $model->jornada !== null ? Html::encode((string) $model->jornada) : '—' ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Salario</th><td><?= Yii::$app->formatter->asCurrency($model->salario) ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Auxilio</th><td><?= Yii::$app->formatter->asCurrency($model->auxilio) ?></td></tr>
                                        <tr><th class="text-muted fw-medium">Fecha de ingreso</th><td><?= $model->fecha_ingreso ? Yii::$app->formatter->asDatetime($model->fecha_ingreso) : '—' ?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="rounded-3 border border-dashed p-4 bg-light h-100 requisicion-detail-panel">
                            <div class="d-flex align-items-start gap-3 mb-4">
                                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-user fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Persona asignada</h6>
                                    <p class="text-muted small mb-0">Datos del candidato o empleado asociado.</p>
                                </div>
                            </div>
                            <?php if ($model->profile_id && $model->profile): ?>
                                <div class="table-responsive requisicion-detail-table-wrap">
                                    <table class="table table-borderless align-middle mb-0 requisicion-detail-table">
                                        <tbody>
                                            <tr><th class="w-50 text-muted fw-medium">Nombre</th><td><?= Html::encode($model->profile->name ?: '—') ?></td></tr>
                                            <tr><th class="text-muted fw-medium">Documento</th><td><?= Html::encode(trim((string) $model->profile->tipo_doc . ' ' . $model->profile->num_doc)) ?></td></tr>
                                            <tr><th class="text-muted fw-medium">Correo</th><td><?= Html::encode($model->profile->public_email ?: '—') ?></td></tr>
                                            <tr><th class="text-muted fw-medium">Teléfono</th><td><?= Html::encode($model->profile->telefono ?: '—') ?></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif ($cand = $model->candidatoAsignado): ?>
                                <div class="table-responsive requisicion-detail-table-wrap">
                                    <table class="table table-borderless align-middle mb-0 requisicion-detail-table">
                                        <tbody>
                                            <tr><th class="w-50 text-muted fw-medium">Nombre</th><td><?= Html::encode($cand->getNombreCompleto() ?: '—') ?></td></tr>
                                            <tr><th class="text-muted fw-medium">Documento</th><td><?= Html::encode(trim((string) $cand->tipo_documento . ' ' . $cand->num_documento)) ?></td></tr>
                                            <tr><th class="text-muted fw-medium">Correo</th><td><?= Html::encode($cand->correo ?: '—') ?></td></tr>
                                            <tr><th class="text-muted fw-medium">Teléfono</th><td><?= Html::encode($cand->telefono ?: '—') ?></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-muted small mb-0 mt-3 pt-1">Persona asignada desde atracción (candidato); aún sin usuario interno vinculado.</p>
                            <?php else: ?>
                                <div class="rounded-3 border bg-white p-3 text-muted small">
                                    Sin persona asignada.
                                </div>
                            <?php endif; ?>
                            <?php if ($model->estado === Requisicion::ESTADO_REJECTED && $model->motivo_rechazo): ?>
                                <div class="alert alert-danger border-0 mt-3 mb-0">
                                    <strong>Motivo de rechazo:</strong> <?= Html::encode($model->motivo_rechazo) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->render('_checklist_resumen', ['model' => $model]) ?>

        <?php if (count($grupo) > 1): ?>
            <div class="card mb-3">
                <div class="card-header border-0 pb-0">
                    <h5 class="mb-0">Vacantes del grupo</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th># Vacante</th>
                                    <th>Estado</th>
                                    <th>Persona</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grupo as $r): ?>
                                    <tr>
                                        <td><?= (int) $r->vacante_index ?></td>
                                        <td>
                                            <span class="badge badge-soft-<?= Html::encode(Requisicion::estadoBadgeClass($r->estado)) ?>">
                                                <?= Html::encode(Requisicion::optsEstado()[$r->estado] ?? $r->estado) ?>
                                            </span>
                                        </td>
                                        <td><?= Html::encode($r->personaAsignadaNombre) ?></td>
                                        <td class="text-end">
                                            <?= Html::a('<i class="ti ti-eye me-1"></i>Ver', ['view', 'id' => $r->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php $logs = $model->getHistoryLogs()->all(); ?>
        <?php if (!empty($logs)): ?>
            <div class="card mb-0">
                <div class="card-header border-0 pb-0">
                    <h5 class="mb-0">Historial de cambios</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Estado anterior</th>
                                    <th>Estado nuevo</th>
                                    <th>Tiempo en estado anterior</th>
                                    <th>Comentario</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs as $log): ?>
                                    <tr>
                                        <td><?= Yii::$app->formatter->asDatetime($log->created_at) ?></td>
                                        <td>
                                            <span class="badge badge-soft-secondary"><?= Html::encode($log->estadoAnteriorLabel) ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-<?= Html::encode(Requisicion::estadoBadgeClass($log->estado_nuevo)) ?>">
                                                <?= Html::encode($log->estadoNuevoLabel) ?>
                                            </span>
                                        </td>
                                        <td><?= Html::encode($log->duracionFormateada) ?></td>
                                        <td><?= Html::encode($log->comentario ?? '—') ?></td>
                                        <td><?= Html::encode($log->usuario && $log->usuario->profile ? $log->usuario->profile->name : ($log->usuario ? $log->usuario->username : '—')) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Enviar a aprobación -->
<div class="modal fade" id="submitApprovalModal" tabindex="-1" aria-labelledby="submitApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?php $submitForm = \yii\widgets\ActiveForm::begin(['action' => ['submit', 'id' => $model->id], 'method' => 'post']); ?>
            <div class="modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-2">
                    <span class="avatar avatar-sm bg-soft-warning text-warning rounded d-inline-flex align-items-center justify-content-center">
                        <i class="ti ti-send fs-16"></i>
                    </span>
                    <h5 class="modal-title fw-bold mb-0" id="submitApprovalModalLabel">Enviar a aprobación</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="mb-0 text-muted">¿Desea enviar esta requisición a aprobación? Una vez enviada, pasará al flujo de aprobación.</p>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check me-1"></i>Enviar
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Activar contratación -->
<div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?php $activateForm = \yii\widgets\ActiveForm::begin(['action' => ['activar', 'id' => $model->id], 'method' => 'post']); ?>
            <div class="modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-2">
                    <span class="avatar avatar-sm bg-soft-success text-success rounded d-inline-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-check fs-16"></i>
                    </span>
                    <h5 class="modal-title fw-bold mb-0" id="activateModalLabel">Activar contratación</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="text-muted mb-3">Esta acción cambiará la persona a estado <strong>ACTIVO</strong> y ejecutará webhook.</p>
                <label class="form-label fw-medium mb-2" for="activar-comentario">Comentario (opcional)</label>
                <textarea id="activar-comentario" name="comentario" class="form-control" rows="3" placeholder="Ingrese un comentario opcional para el historial"></textarea>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check me-1"></i>Activar
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Rechazar -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?php $rejectForm = \yii\widgets\ActiveForm::begin(['action' => Url::to(['reject', 'id' => $model->id]), 'method' => 'post']); ?>
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold mb-0">Rechazar requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <label class="form-label fw-medium mb-2" for="rechazo-motivo">Motivo de rechazo <span class="text-danger">*</span></label>
                <textarea id="rechazo-motivo" name="motivo_rechazo" class="form-control" rows="3" placeholder="Describa el motivo del rechazo" required></textarea>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="ti ti-ban me-1"></i>Rechazar
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Asignar persona -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?php $assignForm = \yii\widgets\ActiveForm::begin(['action' => Url::to(['assign-person', 'id' => $model->id]), 'method' => 'post']); ?>
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold mb-0">Asignar persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-medium mb-2" for="buscar-doc">Buscar por documento</label>
                    <input type="text" id="buscar-doc" class="form-control" placeholder="Escriba número de documento...">
                    <div id="persona-results" class="list-group mt-2 rounded-3 border" style="max-height:220px;overflow-y:auto"></div>
                </div>
                <input type="hidden" name="profile_id" id="profile_id" value="">
                <div class="mb-0">
                    <label class="form-label fw-medium mb-2" for="asignar-comentario">Comentario (opcional)</label>
                    <textarea id="asignar-comentario" name="comentario" class="form-control" rows="2" placeholder="Comentario para el historial"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-assign" disabled>
                    <i class="ti ti-user-check me-1"></i>Asignar
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Vinculación -->
<div class="modal fade" id="vinculacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold mb-0">Paso vinculación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <?php $vinculacionForm = \yii\widgets\ActiveForm::begin(['action' => Url::to(['vinculacion', 'id' => $model->id]), 'method' => 'post', 'id' => 'vinculacion-form']); ?>
                <p class="text-muted mb-3">¿La persona pasa el paso de vinculación?</p>
                <div class="mb-3 d-none" id="motivo-rechazo-vinculacion">
                    <label class="form-label fw-medium mb-2" for="vinculacion-motivo">Motivo de rechazo (opcional)</label>
                    <textarea id="vinculacion-motivo" name="motivo_rechazo" class="form-control" rows="2" placeholder="Detalle del rechazo en vinculación"></textarea>
                </div>
                <input type="hidden" name="aprobada" id="aprobada-val" value="1">
                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-check me-1"></i>Sí, pasa vinculación
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="btn-no-vinculacion">
                        <i class="ti ti-x me-1"></i>No, no pasa
                    </button>
                    <button type="button" class="btn btn-danger d-none" id="btn-confirmar-rechazo">
                        <i class="ti ti-ban me-1"></i>Confirmar rechazo
                    </button>
                </div>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$buscarUrl = Url::to(['buscar-persona']);
$this->registerJs(<<<JS
$('#buscar-doc').on('input', function() {
    var q = $(this).val();
    if (q.length < 3) { $('#persona-results').empty(); return; }
    $.get('{$buscarUrl}', { num_documento: q }, function(data) {
        var html = '';
        (data.results || []).forEach(function(p) {
            html += '<a href="#" class="list-group-item list-group-item-action" data-id=\"'+p.id+'\" data-num=\"'+p.num_doc+'\">'+p.text+'</a>';
        });
        $('#persona-results').html(html || '<div class="list-group-item text-muted">Sin resultados</div>');
    });
});

$('#persona-results').on('click', 'a', function(e) {
    e.preventDefault();
    $('#profile_id').val($(this).data('id'));
    $('#buscar-doc').val($(this).data('num'));
    $('#btn-assign').prop('disabled', false);
});

$('#btn-no-vinculacion').on('click', function() {
    $('#aprobada-val').val('0');
    $('#motivo-rechazo-vinculacion').removeClass('d-none');
    $('#btn-confirmar-rechazo').removeClass('d-none');
});

$('#btn-confirmar-rechazo').on('click', function() {
    $('#vinculacion-form').submit();
});
JS, \yii\web\View::POS_READY);
?>
