<?php

use yii\helpers\Html;

/** @var int[] $profileSedeIds IDs location_sede seleccionados */
/** @var array<int, string> $sedesMap id => nombre */

$profileSedeIds = array_map('intval', $profileSedeIds ?? []);
?>

<style>
/* Picker sedes — cuadrícula tipo fichas (no Select2) */
.profile-sedes-picker {
    --profile-sede-accent: #A2C044;
}
.profile-sedes-picker .profile-sedes-toolbar {
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    padding-bottom: 0.75rem;
    margin-bottom: 1rem;
}
.profile-sedes-picker .profile-sedes-toolbar .btn-outline-sede {
    border: 1px solid #212529;
    color: #212529;
    background: #fff;
    border-radius: 999px;
    font-size: 0.8125rem;
    padding: 0.35rem 0.9rem;
}
.profile-sedes-picker .profile-sedes-toolbar .btn-outline-sede:hover {
    background: #f8f9fa;
}
.profile-sede-tile {
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
.profile-sede-tile:hover:not(.is-selected) {
    background: #f8f9fa;
    border-color: #ced4da;
}
.profile-sede-tile.is-selected {
    background: var(--profile-sede-accent);
    border-color: var(--profile-sede-accent);
    color: #fff;
}
.profile-sede-tile.is-selected .profile-sede-icon-off {
    display: none !important;
}
.profile-sede-tile.is-selected .profile-sede-icon-on {
    display: inline-block !important;
}
.profile-sede-tile .profile-sede-icon-off {
    color: #6c757d;
}
.profile-sede-tile.is-selected .profile-sede-icon-on {
    color: #fff;
}
.profile-sede-tile-name {
    font-size: 0.9375rem;
    line-height: 1.3;
    word-break: break-word;
}
</style>

<div class="rounded-3 border border-dashed p-3 p-md-4 bg-light profile-sedes-picker">
    <?php if (empty($sedesMap)): ?>
        <div class="alert alert-warning mb-0"><?= Html::encode(\Yii::t('app', 'No hay sedes activas configuradas para esta empresa.')) ?></div>
    <?php else: ?>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 profile-sedes-toolbar">
            <p class="mb-0 text-body small flex-grow-1" style="max-width: 100%;">
                <?= Html::encode(\Yii::t('app', 'Seleccione las sedes a las que pertenece este empleado.')) ?>
            </p>
            <div class="d-flex flex-shrink-0 gap-2">
                <button type="button" class="btn btn-outline-sede js-profile-sedes-select-all"><?= Html::encode(\Yii::t('app', 'Seleccionar todo')) ?></button>
                <button type="button" class="btn btn-outline-sede js-profile-sedes-clear"><?= Html::encode(\Yii::t('app', 'Limpiar')) ?></button>
            </div>
        </div>

        <div class="row g-2 g-md-3">
            <?php foreach ($sedesMap as $sid => $nombre): ?>
                <?php
                $sid = (int) $sid;
                $checked = in_array($sid, $profileSedeIds, true);
                ?>
                <div class="col-12 col-md-4">
                    <label class="profile-sede-tile w-100 <?= $checked ? 'is-selected' : '' ?>">
                        <input type="checkbox"
                            name="Profile[profile_sede_ids][]"
                            value="<?= $sid ?>"
                            class="visually-hidden"
                            <?= $checked ? 'checked' : '' ?>>
                        <span class="profile-sede-tile-inner d-flex align-items-center gap-2">
                            <span class="profile-sede-tile-check flex-shrink-0 d-inline-flex align-items-center justify-content-center" aria-hidden="true">
                                <i class="ti ti-square fs-18 profile-sede-icon-off"></i>
                                <i class="ti ti-square-check fs-18 profile-sede-icon-on d-none"></i>
                            </span>
                            <span class="profile-sede-tile-name flex-grow-1"><?= Html::encode($nombre) ?></span>
                        </span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="form-text small text-muted mb-0 mt-3"><?= Html::encode(\Yii::t('app', 'Los cambios se guardan al pulsar «Guardar cambios».')) ?></p>
    <?php endif; ?>
</div>
