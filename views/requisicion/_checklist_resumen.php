<?php

use app\models\ChecklistItem;
use app\models\ChecklistStatus;
use app\models\Requisicion;
use yii\helpers\Html;
use yii\web\View;

/**
 * Checklist de contratación (solo lectura) en detalle de requisición.
 *
 * @var View $this
 * @var Requisicion $model
 */

$mostrar = ChecklistStatus::find()->where(['requisicion_id' => $model->id])->exists()
    || in_array($model->estado, [Requisicion::ESTADO_HIRING_IN_PROGRESS, Requisicion::ESTADO_ACTIVE], true);

if (!$mostrar) {
    return;
}

$items = ChecklistItem::find()->where(['is_active' => 1])->orderBy(['orden' => SORT_ASC])->all();
if ($items === []) {
    return;
}

$statuses = ChecklistStatus::find()
    ->where(['requisicion_id' => $model->id])
    ->with(['completadoPor.profile'])
    ->indexBy('checklist_item_id')
    ->all();

$usuarioMarca = static function (?ChecklistStatus $cs): string {
    if ($cs === null || !$cs->completado_por) {
        return '—';
    }
    $u = $cs->completadoPor;
    if ($u === null) {
        return '#' . (int) $cs->completado_por;
    }
    if ($u->profile !== null && $u->profile->name !== null && trim((string) $u->profile->name) !== '') {
        return (string) $u->profile->name;
    }

    return (string) ($u->username ?? '#' . $cs->completado_por);
};

$completo = $model->checklistCompleto();
?>
<style>
.requisicion-checklist-panel .requisicion-checklist-table > :not(caption) > * > * {
    padding: 0.75rem 0.85rem;
    vertical-align: middle;
}
.requisicion-checklist-panel .requisicion-checklist-head {
    padding-bottom: 1.25rem;
    margin-bottom: 0;
    border-bottom: 1px dashed rgba(0, 0, 0, 0.12);
}
</style>
<div class="rounded-3 border border-dashed bg-light p-4 mb-3 mt-3 requisicion-checklist-panel">
    <div class="d-flex align-items-start gap-3 flex-wrap requisicion-checklist-head">
        <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-list-check fs-20"></i>
        </span>
        <div class="flex-grow-1 min-w-0">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                <h6 class="fw-semibold mb-0">Checklist de contratación</h6>
                <?php if ($completo): ?>
                    <span class="badge badge-soft-success">Obligatorios completos</span>
                <?php else: ?>
                    <span class="badge badge-soft-warning">Pendiente</span>
                <?php endif; ?>
            </div>
            <p class="text-muted small mb-0">Estado de los ítems marcados desde administración. Solo lectura en este portal.</p>
        </div>
        <?php if ($model->estado === Requisicion::ESTADO_HIRING_IN_PROGRESS && Yii::$app->user->can('requisicion_vinculacion')): ?>
            <div class="ms-auto flex-shrink-0 pt-1">
                <?= Html::a('<i class="ti ti-list-check me-1"></i>Gestionar checklist', ['checklist', 'id' => $model->id], ['class' => 'btn btn-sm btn-warning']) ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="table-responsive rounded-3 border bg-white mt-3">
            <table class="table align-middle mb-0 requisicion-checklist-table">
                <thead class="table-light">
                    <tr>
                        <th>Ítem</th>
                        <th class="text-center">Oblig.</th>
                        <th class="text-center">Completado</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <?php
                        $cs = $statuses[$item->id] ?? null;
                        $hecho = $cs !== null && (int) $cs->completado === 1;
                        ?>
                        <tr>
                            <td>
                                <?= Html::encode($item->nombre) ?>
                                <?php if ($item->descripcion): ?>
                                    <br><small class="text-muted"><?= Html::encode($item->descripcion) ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?= (int) $item->es_obligatorio === 1 ? Html::tag('span', 'Sí', ['class' => 'badge badge-soft-danger']) : 'No' ?></td>
                            <td class="text-center">
                                <?php if ($hecho): ?>
                                    <span class="text-success"><i class="ti ti-circle-check"></i> Sí</span>
                                <?php else: ?>
                                    <span class="text-muted"><i class="ti ti-circle-dashed"></i> No</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $cs && $cs->completado_at ? Html::encode($cs->completado_at) : '—' ?></td>
                            <td><?= Html::encode($usuarioMarca($cs)) ?></td>
                            <td><?= $cs && $cs->observacion !== null && $cs->observacion !== '' ? Html::encode($cs->observacion) : '—' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
