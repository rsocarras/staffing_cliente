<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Requisiciones de Contratación';
$this->params['breadcrumbs'][] = $this->title;

$createAjaxUrl = Url::to(['requisicion/create-ajax']);
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <?= Html::a('<i class="ti ti-plus me-1"></i> Nueva Requisición', 'javascript:void(0);', ['class' => 'btn btn-primary', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#add_requisicion']) ?>
                <?php if (Yii::$app->user->can('requisicion_approve')): ?>
                    <?= Html::a('<i class="ti ti-check me-1"></i> Bandeja Aprobación', ['approval'], ['class' => 'btn btn-outline-primary']) ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('requisicion_reportes')): ?>
                    <?= Html::a('<i class="ti ti-report me-1"></i> Reportes RRHH', ['reportes'], ['class' => 'btn btn-outline-secondary']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filtros</h5>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['index'], 'options' => ['id' => 'requisicion-filter-form']]); ?>
                <div class="row g-2">
                    <div class="col-md-2"><?= $form->field($searchModel, 'estado')->dropDownList(\app\models\Requisicion::optsEstado(), ['prompt' => 'Todos'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'empresa_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\EmpresaCliente::getActivos(), 'id', 'nombre'), ['prompt' => 'Empresa'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'ciudad_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name'), ['prompt' => 'Ciudad'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'fecha_ingreso_desde')->input('date')->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'fecha_ingreso_hasta')->input('date')->label(false) ?></div>
                    <div class="col-md-2">
                        <?= Html::submitButton('<i class="ti ti-search"></i> Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap" id="requisicion-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Grupo / Vacante</th>
                                <th>Estado</th>
                                <th>Tiempo total</th>
                                <th>Empresa</th>
                                <th>Ciudad</th>
                                <th>Sede</th>
                                <th>Cargo</th>
                                <th>F. Ingreso</th>
                                <th>Persona</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                                <?= $this->render('_row', ['model' => $model]) ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$modelRequisicionModal = new \app\models\Requisicion();
$modelRequisicionModal->estado = \app\models\Requisicion::ESTADO_DRAFT;
$modelRequisicionModal->numero_vacantes = 1;
?>
<div class="modal fade" id="add_requisicion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $modalForm = ActiveForm::begin([
                'id' => 'form-add-requisicion',
                'action' => ['create'],
                'method' => 'post',
                'enableClientValidation' => false,
            ]); ?>
            <div class="modal-body">
                <div id="requisicion-form-errors" class="alert alert-danger d-none"></div>
                <?= $this->render('_form_fields', [
                    'model' => $modelRequisicionModal,
                    'form' => $modalForm,
                    'esCreacion' => true,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-requisicion">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJs(<<<JS
$(function() {
    var table = $('#requisicion-table').DataTable({
        order: [[0, 'desc']],
        pageLength: 25,
        language: {
            search: 'Buscar:',
            lengthMenu: 'Mostrar _MENU_',
            info: 'Mostrando _START_ a _END_ de _TOTAL_',
            paginate: { first: 'Primero', last: 'Último', next: 'Siguiente', previous: 'Anterior' }
        }
    });

    function hasActiveServerFilters() {
        var hasFilters = false;
        $('#requisicion-filter-form')
            .find('select, input[type="date"], input[type="text"], input[type="hidden"]')
            .each(function() {
                if ($(this).attr('name') === '_csrf') {
                    return;
                }

                if ($.trim($(this).val() || '') !== '') {
                    hasFilters = true;
                    return false;
                }
            });

        return hasFilters;
    }

    function resetRequisicionModal() {
        var form = $('#form-add-requisicion')[0];
        if (form) {
            form.reset();
        }

        $('#requisicion-form-errors').addClass('d-none').empty();
        $('#requisicion-sede_id').html('<option value="">Seleccione sede</option>');
        $('#requisicion-sub_area_id').html('<option value="">Seleccione sub-área</option>');
    }

    $('#form-add-requisicion').on('submit', function(e) {
        e.preventDefault();

        var \$form = $(this);
        var \$btn = $('#btn-save-requisicion');
        var \$errors = $('#requisicion-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: \$form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (!res.success) {
                    var errors = [];
                    if (res.errors) {
                        Object.keys(res.errors).forEach(function(key) {
                            var value = res.errors[key];
                            errors.push($.isArray(value) ? value.join(' ') : value);
                        });
                    }
                    \$errors.html(errors.join('<br>') || 'No fue posible guardar la requisición.').removeClass('d-none');
                    return;
                }

                var modalEl = document.getElementById('add_requisicion');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                }

                if (!hasActiveServerFilters() && res.canAppendToList) {
                    var rowNodes = [];

                    (res.rowsHtml || []).forEach(function(rowHtml) {
                        var rowNode = $(rowHtml).get(0);
                        if (rowNode) {
                            rowNodes.push(rowNode);
                        }
                    });

                    if (rowNodes.length) {
                        table.rows.add(rowNodes).draw(false);
                    }

                    resetRequisicionModal();
                    return;
                }

                if (res.viewUrl) {
                    window.location.href = res.viewUrl;
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

    $('#add_requisicion').on('hidden.bs.modal', function() {
        resetRequisicionModal();
    });
});
JS, \yii\web\View::POS_READY);
?>
