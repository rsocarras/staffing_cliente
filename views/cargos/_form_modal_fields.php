<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit */
/** @var array $areasList id => nombre */
/** @var array $subAreasList id => nombre (sub-áreas del área seleccionada) */
/** @var list<array{tipo: \app\models\NovedadTipo, conceptos: list<\app\models\NovedadConcepto>}> $conceptosPorAgrupador */
/** @var int[] $selectedIdsConceptosCargo */
/** @var string $cargoAccordionSuffix */
/** @var string $urlAjaxConceptosCargoHtml */

$isEdit = !empty($isEdit);
$conceptosPorAgrupador = $conceptosPorAgrupador ?? [];
$selectedIdsConceptosCargo = $selectedIdsConceptosCargo ?? [];
$cargoAccordionSuffix = $cargoAccordionSuffix ?? ($model->isNewRecord ? 'new' : (string) (int) $model->id);
$urlAjaxConceptosCargoHtml = $urlAjaxConceptosCargoHtml ?? '';
$subAreasList = $subAreasList ?? [];
$areaIdAttr = $isEdit ? 'cargos-edit-area_id' : 'cargos-area_id';
$subAreaIdAttr = $isEdit ? 'cargos-edit-sub_area_id' : 'cargos-sub_area_id';
$activoId = $isEdit ? 'cargos-edit-activo' : 'cargos-add-activo';
$tabPrefix = $isEdit ? 'cargo-tab-edit' : 'cargo-tab-add';
?>

<div class="cargo-modal-form">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-bottom mb-3" id="<?= $tabPrefix ?>-nav" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="<?= $tabPrefix ?>-info-tab"
                    data-bs-toggle="tab" data-bs-target="#<?= $tabPrefix ?>-info"
                    type="button" role="tab" aria-controls="<?= $tabPrefix ?>-info" aria-selected="true">
                <i class="ti ti-info-circle me-1"></i>Información
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="<?= $tabPrefix ?>-conceptos-tab"
                    data-bs-toggle="tab" data-bs-target="#<?= $tabPrefix ?>-conceptos"
                    type="button" role="tab" aria-controls="<?= $tabPrefix ?>-conceptos" aria-selected="false">
                <i class="ti ti-list-check me-1"></i>Conceptos de novedad
                <?php if ($selectedIdsConceptosCargo): ?>
                    <span class="badge bg-warning text-dark ms-1"><?= count($selectedIdsConceptosCargo) ?></span>
                <?php endif; ?>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="<?= $tabPrefix ?>-content">
        <!-- Tab: Información -->
        <div class="tab-pane fade show active" id="<?= $tabPrefix ?>-info" role="tabpanel" aria-labelledby="<?= $tabPrefix ?>-info-tab">
            <!-- Organización -->
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-map-pin fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1">Ubicación organizacional</h6>
                        <p class="text-muted small mb-0">Área principal y sub-área a la que pertenece el cargo.</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $form->field($model, 'area_id', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-primary"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->dropDownList($areasList, [
                            'prompt' => 'Seleccione área',
                            'id' => $areaIdAttr,
                            'class' => 'form-select',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'sub_area_id', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-sitemap text-primary"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->dropDownList($subAreasList, [
                            'prompt' => 'Seleccione sub-área',
                            'id' => $subAreaIdAttr,
                            'class' => 'form-select',
                            'disabled' => !$model->area_id,
                        ]) ?>
                    </div>
                </div>
            </div>

            <!-- Datos del cargo -->
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-briefcase fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1">Datos del cargo</h6>
                        <p class="text-muted small mb-0">Código interno, nombre y descripción.</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <?= $form->field($model, 'codigo', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hash text-info"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->textInput([
                            'maxlength' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Opcional',
                        ]) ?>
                    </div>
                    <div class="col-md-8">
                        <?= $form->field($model, 'nombre', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-tag text-info"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->textInput([
                            'maxlength' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Nombre del cargo',
                        ]) ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'descripcion', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-info"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->textarea([
                            'rows' => 3,
                            'maxlength' => 255,
                            'class' => 'form-control',
                            'placeholder' => 'Descripción breve (opcional, máx. 255 caracteres)',
                        ]) ?>
                    </div>
                </div>
            </div>

            <!-- Estado -->
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="avatar avatar-sm bg-soft-success text-success rounded d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                            <i class="ti ti-toggle-right fs-18"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-0">Estado del cargo</h6>
                            <p class="text-muted small mb-0">Los cargos inactivos no se suelen ofrecer en listas operativas.</p>
                        </div>
                    </div>
                    <div class="form-check form-switch ps-0 mb-0">
                        <?= $form->field($model, 'activo', [
                            'template' => '{input}{error}',
                            'options' => ['class' => 'mb-0'],
                        ])->checkbox([
                            'class' => 'form-check-input ms-0',
                            'id' => $activoId,
                            'label' => '<span class="form-check-label fw-medium ms-2">Activo</span>',
                            'encode' => false,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Conceptos de novedad -->
        <div class="tab-pane fade" id="<?= $tabPrefix ?>-conceptos" role="tabpanel" aria-labelledby="<?= $tabPrefix ?>-conceptos-tab">
            <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-list-check fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1">Conceptos de novedad</h6>
                        <p class="text-muted small mb-0">Indique qué conceptos de novedad aplican a este cargo.</p>
                    </div>
                </div>
                <div id="js-cargo-conceptos-wrap" data-url-ajax="<?= Html::encode($urlAjaxConceptosCargoHtml) ?>">
                    <?= $this->render('_conceptos_cargo', [
                        'conceptosPorAgrupador' => $conceptosPorAgrupador,
                        'selectedIds' => $selectedIdsConceptosCargo,
                        'formFieldPrefix' => 'Cargos',
                        'accordionSuffix' => $cargoAccordionSuffix,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
