<?php

use app\models\Contrato;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\search\ContratoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $filterOptions */
/** @var array $scope */
/** @var array $summaryCounts */
/** @var array $formOptions */
/** @var app\models\Contrato $modelContratoAdd */

$profileItems = ArrayHelper::map($filterOptions['profiles'], 'user_id', function ($item) {
    $parts = array_filter([
        $item->name,
        $item->user ? '@' . $item->user->username : null,
    ]);
    return implode(' | ', $parts);
});

$this->title = 'Contratos';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['contrato/create-ajax']);
$viewAjaxUrl = Url::to(['contrato/view-ajax']);
$formAjaxUrl = Url::to(['contrato/form-ajax']);
$updateAjaxUrl = Url::to(['contrato/update-ajax']);
$deleteUrl = Url::to(['contrato/delete']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
?>

<div class="page-wrapper">
    <div class="content">
        <!-- 1. Encabezado -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                        <p class="mb-0 text-muted">Listado contractual por empleado, sede, área y cargo.</p>
                    </div>
                    <div class="text-end d-flex gap-2 align-items-center">
                        <ol class="breadcrumb m-0 py-0 me-2">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item">Sistema</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Cards resumen -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row row-gap-4">
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-building fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Total contratos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['total'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-success flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-check fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Activos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['activos'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-secondary flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-calendar-event fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Vigentes</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['vigentes'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-danger flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-x fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Liquidados/Cancelados</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['liquidados'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Contenido: acciones, filtros y tabla -->
        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="d-flex gap-2 justify-content-end mb-4">
                    <?php if (empty($scope['readonly'])): ?>
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_contrato">
                            <i class="ti ti-plus me-1"></i>Nuevo contrato
                        </a>
                    <?php endif; ?>
                    <?= Html::a('<i class="ti ti-settings me-1"></i>Tipos de contrato', ['/contrato-tipos/index'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>

                <!-- Start Search and Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['index'], 'options' => ['class' => 'row g-3']]); ?>
                        <div class="col-lg-3">
                            <?= $form->field($searchModel, 'profile_id')->dropDownList($profileItems, ['prompt' => 'Empleado']) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($searchModel, 'contrato_tipo_id')->dropDownList(ArrayHelper::map($filterOptions['contratoTipos'], 'id', 'nombre'), ['prompt' => 'Tipo contrato']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'estado')->dropDownList($filterOptions['estados'], ['prompt' => 'Estado']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'vigente')->dropDownList($filterOptions['vigencia'], ['prompt' => 'Vigencia']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'sede_id')->dropDownList(ArrayHelper::map($filterOptions['sedes'], 'id', 'nombre'), ['prompt' => 'Sede']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'region_id')->dropDownList(ArrayHelper::map($filterOptions['regiones'], 'id', 'name'), ['prompt' => 'Región']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'city_id')->dropDownList(ArrayHelper::map($filterOptions['ciudades'], 'id', 'name'), ['prompt' => 'Ciudad']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'area_id')->dropDownList(ArrayHelper::map($filterOptions['areas'], 'id', 'nombre'), ['prompt' => 'Área', 'id' => 'contratosearch-area_id']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'sub_area_id')->dropDownList(ArrayHelper::map($filterOptions['subAreas'], 'id', 'nombre'), ['prompt' => 'Subárea', 'id' => 'contratosearch-sub_area_id']) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($searchModel, 'cargo_id')->dropDownList(ArrayHelper::map($filterOptions['cargos'], 'id', 'nombre'), ['prompt' => 'Cargo', 'id' => 'contratosearch-cargo_id']) ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($searchModel, 'texto')->textInput(['placeholder' => 'Buscar por empleado, usuario, sede o cargo']) ?>
                        </div>
                        <div class="col-lg-4 d-flex align-items-end gap-2">
                            <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <!-- End Search and Filter -->

                <!-- start table -->
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="contrato-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empleado</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Vigencia</th>
                                <th>Sede principal</th>
                                <th>Área</th>
                                <th>Subárea</th>
                                <th>Cargo</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Distribución</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                                <?php
                                $distributionCount = count($model->contratoDistribucionSedes);
                                $distributionLabel = $distributionCount > 0 ? $distributionCount . ' sedes' : 'Principal 100%';
                                ?>
                                <tr>
                                    <td><?= Html::encode($model->id) ?></td>
                                    <td><?= Html::encode($model->getProfileDisplayName()) ?></td>
                                    <td><?= Html::encode($model->contratoTipo ? $model->contratoTipo->nombre : '-') ?></td>
                                    <td><span class="badge badge-soft-<?= Html::encode($model->getEstadoBadgeClass()) ?>"><?= Html::encode($model->getDisplayEstado()) ?></span></td>
                                    <td>
                                        <span class="badge badge-soft-<?= $model->isCurrentByDate() ? 'success' : 'danger' ?>">
                                            <?= Html::encode($model->getVigenciaLabel()) ?>
                                        </span>
                                    </td>
                                    <td><?= Html::encode($model->sede ? $model->sede->nombre : '-') ?></td>
                                    <td><?= Html::encode($model->area ? $model->area->nombre : '-') ?></td>
                                    <td><?= Html::encode($model->subArea ? $model->subArea->nombre : '-') ?></td>
                                    <td><?= Html::encode($model->cargo ? $model->cargo->nombre : '-') ?></td>
                                    <td><?= Yii::$app->formatter->asDate($model->fecha_inicio) ?></td>
                                    <td><?= $model->fecha_fin ? Yii::$app->formatter->asDate($model->fecha_fin) : '-' ?></td>
                                    <td><span class="badge bg-light text-dark"><?= Html::encode($distributionLabel) ?></span></td>
                                    <td class="text-center">
                                        <?= $this->render('_actions_dropdown', ['model' => $model, 'scope' => $scope]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- end table -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Contrato -->
<div class="modal fade" id="modal-view-contrato">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-contrato-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Contrato -->
<div class="modal fade" id="modal-edit-contrato">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar contrato</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza empleado, sede, fechas, estructura y distribución.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-contrato-body">
                <div class="text-center py-5">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-contrato">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Contrato -->
<div class="modal fade" id="add_contrato">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-file-text fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo contrato</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Asigna empleado, tipo, sede, fechas y estructura organizacional.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2">
                <?= $this->render('_form_add_modal', [
                    'model' => $modelContratoAdd,
                    'options' => $formOptions,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-contrato">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar contrato</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$subAreasUrl = Url::to(['contrato/sub-areas']);
$cargosUrl = Url::to(['contrato/cargos-por-estructura']);
$distributionSedesJson = json_encode(ArrayHelper::map($formOptions['sedes'], 'id', 'nombre'));
$distributionRowTemplate = '<tr><td><select class="form-select distribution-sede" name="DistribucionSede[__index__][sede_id]"><option value="">Seleccione sede</option></select></td><td><input type="number" class="form-control distribution-porcentaje" name="DistribucionSede[__index__][porcentaje]" step="0.01" min="0" max="100"></td><td class="text-end"><button type="button" class="btn btn-icon btn-sm btn-outline-danger remove-distribution-row"><i class="ti ti-trash"></i></button></td></tr>';
$distributionRowTemplateJson = json_encode($distributionRowTemplate);
$js = <<<JS
$(function() {
    $('#contrato-table').DataTable({
        pageLength: 7,
        order: [[0, 'desc']],
        columnDefs: [{ orderable: false, targets: -1 }],
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" },
            zeroRecords: "No se encontraron registros"
        }
    });

    var evNsFilter = '.contratoSearchCascade';

    function rebuildFilterSelect(selector, items, prompt, preferredValue) {
        var \$select = $(selector);
        var prev = preferredValue !== undefined ? preferredValue : \$select.val();
        \$select.empty().append($('<option>', { value: '', text: prompt }));
        items.forEach(function (item) {
            \$select.append($('<option>', { value: item.id, text: item.nombre || '' }));
        });
        if (prev !== undefined && prev !== null && prev !== '') {
            var s = String(prev);
            if (items.some(function (it) { return String(it.id) === s; })) {
                \$select.val(s);
            }
        }
    }

    $(document).off('change' + evNsFilter, '#contratosearch-area_id');
    $(document).off('change' + evNsFilter, '#contratosearch-sub_area_id');

    function loadContratoSearchCargos() {
        var areaId = $('#contratosearch-area_id').val();
        var subAreaId = $('#contratosearch-sub_area_id').val();
        rebuildFilterSelect('#contratosearch-cargo_id', [], 'Cargo');
        if (!areaId || !subAreaId) return;
        $.getJSON('{$cargosUrl}', { area_id: areaId, sub_area_id: subAreaId })
            .done(function (data) {
                data = Array.isArray(data) ? data : [];
                rebuildFilterSelect('#contratosearch-cargo_id', data, 'Cargo');
                if (data.length === 1) {
                    $('#contratosearch-cargo_id').val(String(data[0].id));
                }
            });
    }

    $(document).on('change' + evNsFilter, '#contratosearch-area_id', function () {
        var areaId = $(this).val();
        rebuildFilterSelect('#contratosearch-sub_area_id', [], 'Subárea');
        rebuildFilterSelect('#contratosearch-cargo_id', [], 'Cargo');
        if (!areaId) return;
        $.getJSON('{$subAreasUrl}', { area_id: areaId })
            .done(function (data) {
                data = Array.isArray(data) ? data : [];
                rebuildFilterSelect('#contratosearch-sub_area_id', data, 'Subárea');
                var \$sub = $('#contratosearch-sub_area_id');
                if (data.length === 1) {
                    \$sub.val(String(data[0].id));
                    loadContratoSearchCargos();
                }
            });
    });

    $(document).on('change' + evNsFilter, '#contratosearch-sub_area_id', function () {
        loadContratoSearchCargos();
    });

    (function() {
        var sedes = {$distributionSedesJson};
        var rowTpl = {$distributionRowTemplateJson};
        var distributionIndex = { add: 1, edit: 0 };

        function updateDistributionTotal(prefix) {
            var \$table = $('#distribution-table-' + prefix);
            var \$badge = $('#distribution-total-badge-' + prefix);
            if (!\$table.length || !\$badge.length) return;
            var total = 0;
            \$table.find('.distribution-porcentaje').each(function() {
                var v = parseFloat($(this).val());
                if (!isNaN(v)) total += v;
            });
            \$badge.text('Total: ' + total.toFixed(2) + '%')
                .removeClass('bg-info bg-success bg-danger')
                .addClass(total === 0 ? 'bg-info' : (Math.abs(total - 100) < 0.01 ? 'bg-success' : 'bg-danger'));
        }

        $(document).on('click', '[id^="add-distribution-row-"]', function() {
            var id = $(this).attr('id');
            var prefix = id.replace('add-distribution-row-', '');
            var \$table = $('#distribution-table-' + prefix);
            if (!\$table.length) return;
            var idx = distributionIndex[prefix] !== undefined ? distributionIndex[prefix] : \$table.find('tbody tr').length;
            distributionIndex[prefix] = idx + 1;
            var html = rowTpl.replace(/__index__/g, idx);
            var \$row = $(html);
            Object.keys(sedes).forEach(function(sid) {
                \$row.find('.distribution-sede').append('<option value="' + sid + '">' + sedes[sid] + '</option>');
            });
            \$table.find('tbody').append(\$row);
            updateDistributionTotal(prefix);
        });

        $(document).on('click', '.remove-distribution-row', function() {
            var \$row = $(this).closest('tr');
            var \$table = \$row.closest('table');
            var id = \$table.attr('id');
            if (!id || id.indexOf('distribution-table-') !== 0) return;
            var prefix = id.replace('distribution-table-', '');
            var rows = \$table.find('tbody tr');
            if (rows.length === 1) {
                \$row.find('select, input').val('');
            } else {
                \$row.remove();
            }
            updateDistributionTotal(prefix);
        });

        $(document).on('input change', '.distribution-porcentaje, .distribution-sede', function() {
            var \$table = $(this).closest('table');
            var id = \$table.attr('id');
            if (!id || id.indexOf('distribution-table-') !== 0) return;
            var prefix = id.replace('distribution-table-', '');
            updateDistributionTotal(prefix);
        });

        $(document).on('shown.bs.modal', '#add_contrato', function() {
            distributionIndex.add = $('#distribution-table-add').find('tbody tr').length;
            updateDistributionTotal('add');
        });
        $(document).on('shown.bs.modal', '#modal-edit-contrato', function() {
            distributionIndex.edit = $('#distribution-table-edit').find('tbody tr').length;
            updateDistributionTotal('edit');
        });
    })();

    $(document).on('click', '.btn-contrato-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-contrato'));
        $('#modal-view-contrato-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-contrato-body').html(html);
        }).fail(function() {
            $('#modal-view-contrato-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-contrato-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-contrato'));
        $('#modal-edit-contrato-body').html('<div class="text-center py-5"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        $('#btn-save-edit-contrato').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            var \$temp = $('<div>').html(html);
            var scripts = [];
            \$temp.find('script').each(function() {
                var code = this.textContent || this.innerText || $(this).html();
                if (code && code.trim()) scripts.push(code);
            });
            \$temp.find('script').remove();
            $('#modal-edit-contrato-body').html(\$temp.html());
            scripts.forEach(function(code) { $.globalEval(code); });
        }).fail(function() {
            $('#modal-edit-contrato-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-contrato').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-contrato-modal');
        var \$btn = $(this);
        var \$errors = $('#contrato-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        \$form.find('select').prop('disabled', false);
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-contrato')).hide();
                    window.location.reload();
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push((res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]));
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

    $(document).on('click', '.btn-contrato-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'este contrato';
        var \$btn = $(this);
        if (typeof Swal === 'undefined') {
            if (confirm('¿Está seguro que desea eliminar ' + nombre + '?')) {
                doDeleteContrato(id);
            }
            return;
        }
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará el contrato de "' + nombre + '". Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                doDeleteContrato(id);
            }
        });
    });

    function doDeleteContrato(id) {
        $.ajax({
            url: '{$deleteUrl}',
            type: 'POST',
            data: { id: id, '{$csrfParam}': '{$csrfToken}' },
            dataType: 'json',
            success: function() {
                window.location.reload();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'El contrato ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
                }
            },
            error: function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar. Intente nuevamente.', icon: 'error' });
                } else {
                    alert('Error al eliminar.');
                }
            }
        });
    }

    $('#btn-save-contrato').on('click', function() {
        var \$form = $('#form-add-contrato');
        var \$btn = $(this);
        var \$errors = $('#contrato-add-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        \$form.find('select').prop('disabled', false);

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: \$form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('add_contrato')).hide();
                    \$form[0].reset();
                    window.location.reload();
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push((res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]));
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

    $('#add_contrato').on('hidden.bs.modal', function() {
        $('#form-add-contrato')[0].reset();
        $('#contrato-add-form-errors').addClass('d-none').empty();
        var \$tbody = $('#distribution-table-add tbody');
        if (\$tbody.length) {
            \$tbody.find('tr:gt(0)').remove();
            \$tbody.find('tr:first select, tr:first input').val('');
        }
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>