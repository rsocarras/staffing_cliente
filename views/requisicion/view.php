<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Requisición #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisicion-view">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><?= Html::encode($this->title) ?> - <?= \app\models\Requisicion::optsEstado()[$model->estado] ?? $model->estado ?></h1>
        <div>
            <?php if ($model->estado === \app\models\Requisicion::ESTADO_DRAFT): ?>
                <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['submit', 'id' => $model->id], 'method' => 'post', 'options' => ['class' => 'd-inline']]); ?>
                <?= Html::submitButton('Enviar a aprobación', ['class' => 'btn btn-success', 'onclick' => "return confirm('¿Enviar a aprobación?');"]) ?>
                <?php \yii\widgets\ActiveForm::end(); ?>
            <?php endif; ?>
            <?php if (($model->estado === \app\models\Requisicion::ESTADO_APPROVAL_PENDING) && Yii::$app->user->can('requisicion_approve')): ?>
                <?php $f = \yii\widgets\ActiveForm::begin(['action' => ['approve', 'id' => $model->id], 'method' => 'post', 'options' => ['class' => 'd-inline']]); ?>
                <?= Html::submitButton('Aprobar', ['class' => 'btn btn-success']) ?>
                <?php \yii\widgets\ActiveForm::end(); ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Rechazar</button>
            <?php endif; ?>
            <?php if (($model->estado === \app\models\Requisicion::ESTADO_ORDER_PENDING || $model->estado === \app\models\Requisicion::ESTADO_PERSON_ASSIGNED) && Yii::$app->user->can('requisicion_assign')): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal">Asignar persona</button>
            <?php endif; ?>
            <?php if (($model->estado === \app\models\Requisicion::ESTADO_PERSON_ASSIGNED) && Yii::$app->user->can('requisicion_vinculacion')): ?>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#vinculacionModal">Paso vinculación</button>
            <?php endif; ?>
            <?php if (($model->estado === \app\models\Requisicion::ESTADO_HIRING_IN_PROGRESS) && Yii::$app->user->can('requisicion_vinculacion')): ?>
                <?= Html::a('Checklist', ['checklist', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?php if ($model->checklistCompleto()): ?>
                    <?php $f = \yii\widgets\ActiveForm::begin(['action' => ['activar', 'id' => $model->id], 'method' => 'post', 'options' => ['class' => 'd-inline']]); ?>
                    <div class="d-inline-block me-2">
                        <input type="text" name="comentario" class="form-control form-control-sm d-inline-block" style="width:200px" placeholder="Comentario (opcional)">
                    </div>
                    <?= Html::submitButton('Activar', ['class' => 'btn btn-success', 'onclick' => "return confirm('¿Activar contratación? Persona pasará a ACTIVO y se ejecutará webhook.');"]) ?>
                    <?php \yii\widgets\ActiveForm::end(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5>Grupo: <?= Html::encode($model->group_uuid) ?> - Vacante <?= $model->vacante_index ?> de <?= $model->numero_vacantes ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Datos vacante</h6>
                    <table class="table table-sm">
                        <tr><th>Empresa</th><td><?= Html::encode($model->empresa->nombre ?? '-') ?></td></tr>
                        <tr><th>Ciudad</th><td><?= Html::encode($model->ciudad->name ?? '-') ?></td></tr>
                        <tr><th>Sede</th><td><?= Html::encode($model->sede->nombre ?? '-') ?></td></tr>
                        <tr><th>Área / Sub-área</th><td><?= Html::encode($model->area->nombre ?? '-') ?> / <?= Html::encode($model->subArea->nombre ?? '-') ?></td></tr>
                        <tr><th>Cargo</th><td><?= Html::encode($model->cargo->nombre ?? '-') ?></td></tr>
                        <tr><th>Jornada</th><td><?= $model->jornada ?></td></tr>
                        <tr><th>Salario</th><td><?= Yii::$app->formatter->asCurrency($model->salario) ?></td></tr>
                        <tr><th>Auxilio</th><td><?= Yii::$app->formatter->asCurrency($model->auxilio) ?></td></tr>
                        <tr><th>F. Ingreso</th><td><?= Yii::$app->formatter->asDatetime($model->fecha_ingreso) ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Persona asignada</h6>
                    <?php if ($model->profile_id && $model->profile): ?>
                        <table class="table table-sm">
                            <tr><th>Nombre</th><td><?= Html::encode($model->profile->name) ?></td></tr>
                            <tr><th>Documento</th><td><?= Html::encode($model->profile->tipo_doc) ?> <?= Html::encode($model->profile->num_doc) ?></td></tr>
                            <tr><th>Correo</th><td><?= Html::encode($model->profile->public_email) ?></td></tr>
                            <tr><th>Teléfono</th><td><?= Html::encode($model->profile->telefono) ?></td></tr>
                        </table>
                    <?php else: ?>
                        <p class="text-muted">Sin persona asignada</p>
                    <?php endif; ?>
                    <?php if ($model->estado === \app\models\Requisicion::ESTADO_REJECTED && $model->motivo_rechazo): ?>
                        <div class="alert alert-danger mt-2"><strong>Motivo rechazo:</strong> <?= Html::encode($model->motivo_rechazo) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (count($grupo) > 1): ?>
    <div class="card mt-3">
        <div class="card-header"><h5>Vacantes del grupo</h5></div>
        <div class="card-body">
            <table class="table table-sm">
                <thead><tr><th>#</th><th>Estado</th><th>Persona</th><th></th></tr></thead>
                <tbody>
                    <?php foreach ($grupo as $r): ?>
                    <tr>
                        <td><?= $r->vacante_index ?></td>
                        <td><?= \app\models\Requisicion::optsEstado()[$r->estado] ?? $r->estado ?></td>
                        <td><?= Html::encode($r->profile ? $r->profile->name : '-') ?></td>
                        <td><?= Html::a('Ver', ['view', 'id' => $r->id], ['class' => 'btn btn-sm btn-outline-primary']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php $logs = $model->getHistoryLogs()->all(); ?>
    <?php if (!empty($logs)): ?>
    <div class="card mt-3">
        <div class="card-header"><h5>Historial de cambios</h5></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
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
                        <?php foreach ($logs as $i => $log): ?>
                        <tr>
                            <td><?= Yii::$app->formatter->asDatetime($log->created_at) ?></td>
                            <td><span class="badge bg-secondary"><?= Html::encode($log->estadoAnteriorLabel) ?></span></td>
                            <td><span class="badge bg-<?= \app\models\Requisicion::estadoBadgeClass($log->estado_nuevo) ?>"><?= Html::encode($log->estadoNuevoLabel) ?></span></td>
                            <td><?= Html::encode($log->duracionFormateada) ?></td>
                            <td><?= Html::encode($log->comentario ?? '-') ?></td>
                            <td><?= Html::encode($log->usuario && $log->usuario->profile ? $log->usuario->profile->name : ($log->usuario ? $log->usuario->username : '-')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Rechazar -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $f = \yii\widgets\ActiveForm::begin(['action' => Url::to(['reject', 'id' => $model->id]), 'method' => 'post']); ?>
            <div class="modal-header">
                <h5 class="modal-title">Rechazar requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Motivo de rechazo (obligatorio)</label>
                    <textarea name="motivo_rechazo" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Rechazar</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Asignar persona -->
<div class="modal fade" id="assignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $f = \yii\widgets\ActiveForm::begin(['action' => Url::to(['assign-person', 'id' => $model->id]), 'method' => 'post']); ?>
            <div class="modal-header">
                <h5 class="modal-title">Asignar persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Buscar por documento</label>
                    <input type="text" id="buscar-doc" class="form-control" placeholder="Escriba número de documento...">
                    <div id="persona-results" class="list-group mt-2" style="max-height:200px;overflow-y:auto"></div>
                </div>
                <input type="hidden" name="profile_id" id="profile_id" value="">
                <div class="mb-3">
                    <label class="form-label">Comentario (opcional)</label>
                    <textarea name="comentario" class="form-control" rows="2" placeholder="Comentario para el historial"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-assign" disabled>Asignar</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Vinculación -->
<div class="modal fade" id="vinculacionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Paso vinculación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php $f = \yii\widgets\ActiveForm::begin(['action' => Url::to(['vinculacion', 'id' => $model->id]), 'method' => 'post', 'id' => 'vinculacion-form']); ?>
                <p>¿La persona pasa el paso de vinculación?</p>
                <div class="mb-3" id="motivo-rechazo-vinculacion" style="display:none">
                    <label class="form-label">Motivo rechazo (opcional)</label>
                    <textarea name="motivo_rechazo" class="form-control" rows="2"></textarea>
                </div>
                <input type="hidden" name="aprobada" id="aprobada-val" value="1">
                <button type="submit" class="btn btn-success">Sí - Pasa vinculación</button>
                <button type="button" class="btn btn-outline-danger" id="btn-no-vinculacion">No - No pasa</button>
                <div id="confirmar-rechazo-div" style="display:none" class="mt-2">
                    <button type="button" class="btn btn-danger" id="btn-confirmar-rechazo">Confirmar rechazo</button>
                </div>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$buscarUrl = Url::to(['buscar-persona']);
$this->registerJs(<<<JS
// Buscar persona por documento
$('#buscar-doc').on('input', function() {
    var q = $(this).val();
    if (q.length < 3) { $('#persona-results').empty(); return; }
    $.get('{$buscarUrl}', { num_documento: q }, function(data) {
        var html = '';
        (data.results || []).forEach(function(p) {
            html += '<a href="#" class="list-group-item list-group-item-action" data-id="'+p.id+'" data-name="'+p.name+'" data-num="'+p.num_doc+'" data-email="'+p.email+'" data-tel="'+p.telefono+'" data-birth="'+p.birthday+'" data-sexo="'+p.sexo+'" data-tipo="'+p.tipo_doc+'">'+p.text+'</a>';
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
// Vinculación No: mostrar motivo y botón confirmar
$('#btn-no-vinculacion').on('click', function() {
    $('#aprobada-val').val('0');
    $('#motivo-rechazo-vinculacion').show();
    $('#confirmar-rechazo-div').show();
});
$('#btn-confirmar-rechazo').on('click', function() {
    $('#vinculacion-form').submit();
});
JS
, \yii\web\View::POS_READY);
?>
