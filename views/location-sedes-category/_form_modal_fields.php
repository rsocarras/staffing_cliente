<?php

use app\models\LocationSedeCargoTarifa;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationSedesCategory $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array<int,string> $sedesMap */
/** @var array<int,string> $empresaClientesMap */

$selectedSedes = array_map('intval', (array) ($model->sedeIds ?? []));
$pivotTariffs = $model->getPivotTariffsBySedeId();
$tarifaFields = LocationSedeCargoTarifa::tariffColumnNames();
$tarifaLabels = (new LocationSedeCargoTarifa())->attributeLabels();
?>
<style>
    .sede-category-sedes-picker .profile-sede-tile.is-selected .profile-sede-icon-on {
        color: #fff;
    }

    .sede-category-sedes-picker .profile-sede-tile-name {
        font-size: 0.9375rem;
        line-height: 1.3;
        word-break: break-word;
    }

    .sede-category-sedes-picker .js-dynamic-sede-card.border-primary {
        border-color: var(--bs-primary) !important;
    }

    .sede-category-sedes-picker {
        --profile-sede-accent: #a2c044;
    }

    .sede-category-sedes-picker .profile-sedes-toolbar {
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        padding-bottom: 0.75rem;
        margin-bottom: 1rem;
    }

    .sede-category-sedes-picker .profile-sedes-toolbar .btn-outline-sede {
        border: 1px solid #212529;
        color: #212529;
        background: #fff;
        border-radius: 999px;
        font-size: 0.8125rem;
        padding: 0.35rem 0.9rem;
    }

    .sede-category-sedes-picker .profile-sedes-toolbar .btn-outline-sede:hover {
        background: #f8f9fa;
    }

    .sede-category-sedes-picker .profile-sede-tile {
        display: block;
        margin: 0;
        cursor: pointer;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 0.65rem 0.85rem;
        background: #fff;
        color: #212529;
        transition: background 0.15s ease, border-color 0.15s ease, color 0.15s ease;
        min-height: 2.75rem;
    }

    .sede-category-sedes-picker .profile-sede-tile:hover:not(.is-selected) {
        background: #f8f9fa;
        border-color: #ced4da;
    }

    .sede-category-sedes-picker .profile-sede-tile.is-selected {
        background: var(--profile-sede-accent);
        border-color: var(--profile-sede-accent);
        color: #fff;
    }

    .sede-category-sedes-picker .profile-sede-tile.is-selected .profile-sede-icon-off {
        display: none !important;
    }

    .sede-category-sedes-picker .profile-sede-tile.is-selected .profile-sede-icon-on {
        display: inline-block !important;
    }

    .sede-category-sedes-picker .profile-sede-tile .profile-sede-icon-off {
        color: #6c757d;
    }

    .sede-category-sedes-picker .profile-sede-tile.is-selected .profile-sede-icon-on {
        color: #fff;
    }

    .sede-category-sedes-picker .profile-sede-tile-name {
        font-size: 0.9375rem;
        line-height: 1.3;
        word-break: break-word;
    }
</style>

<div class="sede-category-modal-form">

    <!-- Tabs -->
    <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="cat-form-tab-info" data-bs-toggle="pill" data-bs-target="#cat-form-pane-info" type="button" role="tab" aria-controls="cat-form-pane-info" aria-selected="true">
                <i class="ti ti-category me-1"></i>Categoría
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="cat-form-tab-sedes" data-bs-toggle="pill" data-bs-target="#cat-form-pane-sedes" type="button" role="tab" aria-controls="cat-form-pane-sedes" aria-selected="false">
                <i class="ti ti-building-store me-1"></i>Sedes
                <?php
                $selectedCount = count(array_filter($model->sedeIds ?? [], fn($v) => $v !== null));
                if ($selectedCount > 0):
                ?>
                    <span class="badge bg-primary bg-opacity-10 text-primary ms-1"><?= $selectedCount ?></span>
                <?php endif; ?>
            </button>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Tab: Datos de la categoría -->
        <div class="tab-pane fade show active" id="cat-form-pane-info" role="tabpanel" aria-labelledby="cat-form-tab-info">
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-category fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1">Datos de la categoría</h6>
                        <p class="text-muted small mb-0">Define nombre, empresa cliente y estado. Las tarifas se configuran por sede en la pestaña «Sedes».</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $form->field($model, 'nombre', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->textInput([
                            'maxlength' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Ej. Sedes Norte',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'empresa_cliente_id', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building-factory text-primary"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->dropDownList($empresaClientesMap, [
                            'prompt' => 'Seleccione empresa cliente...',
                            'class' => 'form-select',
                        ]) ?>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch mt-1">
                            <?= $form->field($model, 'activo', [
                                'template' => '{input}<label class="form-check-label ms-2" for="locationsedescategory-activo">Categoría activa</label>{error}',
                                'options' => ['class' => 'mb-0'],
                            ])->checkbox([
                                'class' => 'form-check-input',
                                'uncheck' => 0,
                                'value' => 1,
                                'id' => 'locationsedescategory-activo',
                                'label' => false,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Sedes -->
        <div class="tab-pane fade" id="cat-form-pane-sedes" role="tabpanel" aria-labelledby="cat-form-tab-sedes">
            <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light profile-sedes-picker sede-category-sedes-picker">
                <?php if ($model->isNewRecord): ?>
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 profile-sedes-toolbar d-none">
                        <p class="mb-0 text-body small flex-grow-1">Seleccione sedes y configure tarifas por sede (pivote categoría–sede).</p>
                        <div class="d-flex flex-shrink-0 gap-2">
                            <button type="button" class="btn btn-outline-sede js-profile-sedes-select-all">Seleccionar todo</button>
                            <button type="button" class="btn btn-outline-sede js-profile-sedes-clear">Limpiar</button>
                        </div>
                    </div>
                    <div class="row g-2 sede-category-sedes-row">
                        <div class="col-12 py-3 text-muted small text-center">
                            <i class="ti ti-building-factory d-block fs-2 mb-1 opacity-50"></i>
                            Seleccione una empresa cliente para ver las sedes disponibles.
                        </div>
                    </div>
                <?php elseif (empty($sedesMap)): ?>
                    <div class="alert alert-warning mb-0">No hay sedes activas configuradas para esta empresa.</div>
                <?php else: ?>
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 profile-sedes-toolbar">
                        <p class="mb-0 text-body small flex-grow-1">Seleccione sedes y, si aplica, los valores de tarifa en el pivote categoría–sede.</p>
                        <div class="d-flex flex-shrink-0 gap-2">
                            <button type="button" class="btn btn-outline-sede js-profile-sedes-select-all">Seleccionar todo</button>
                            <button type="button" class="btn btn-outline-sede js-profile-sedes-clear">Limpiar</button>
                        </div>
                    </div>
                    <div class="row g-3 sede-category-sedes-row">
                        <?php foreach ($sedesMap as $sid => $nombre): ?>
                            <?php
                            $sid = (int) $sid;
                            $isChecked = in_array($sid, $selectedSedes, true);
                            $pRow = $pivotTariffs[$sid] ?? [];
                            ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-check border rounded p-3 h-100 <?= $isChecked ? 'border-primary bg-primary bg-opacity-10' : 'border-secondary-subtle' ?> sede-card">
                                    <?= Html::checkbox(
                                        'LocationSedesCategory[sedeIds][]',
                                        $isChecked,
                                        [
                                            'value' => $sid,
                                            'class' => 'form-check-input sede-checkbox',
                                            'id' => 'sede_cat_' . $sid,
                                        ]
                                    ) ?>
                                    <label class="form-check-label ms-1 user-select-none w-100" for="sede_cat_<?= $sid ?>">
                                        <?= Html::encode($nombre) ?>
                                    </label>
                                    <div class="js-sede-pivot-tariff mt-2 pt-2 border-top <?= $isChecked ? '' : 'd-none' ?>">
                                        <?php foreach ($tarifaFields as $field): ?>
                                            <?php
                                            $pv = $pRow[$field] ?? '';
                                            ?>
                                            <div class="mb-2">
                                                <label class="form-label small mb-0"><?= Html::encode((string) ($tarifaLabels[$field] ?? $field)) ?></label>
                                                <input type="number" step="0.0001" min="0" class="form-control form-control-sm"
                                                    name="PivotTariff[<?= $sid ?>][<?= Html::encode($field) ?>]"
                                                    value="<?= $pv !== null && $pv !== '' ? Html::encode((string) $pv) : '' ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
if (!$model->isNewRecord) {
    $js = <<<'JS'
(function () {
    function togglePivotTariff(card, show) {
        var block = card.querySelector('.js-sede-pivot-tariff');
        if (!block) return;
        block.classList.toggle('d-none', !show);
    }
    var root = document.querySelector('.sede-category-modal-form');
    if (!root) return;
    root.querySelectorAll('.sede-checkbox').forEach(function (chk) {
        chk.addEventListener('change', function () {
            var card = this.closest('.sede-card');
            if (!card) return;
            if (this.checked) {
                card.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
                card.classList.remove('border-secondary-subtle');
                togglePivotTariff(card, true);
            } else {
                card.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
                card.classList.add('border-secondary-subtle');
                togglePivotTariff(card, false);
            }
        });
    });
})();
JS;
    $this->registerJs($js);
}
?>