<?php

declare(strict_types=1);

use app\models\AuditLog;
use Throwable;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;

/** @var AuditLog $model */

$presentation = AuditLog::buildDiffPresentation($model);

$pkForDisplay = $model->record_pk;
try {
    $pkDecoded = Json::decode($model->record_pk, true);
    if (is_array($pkDecoded)) {
        $pkForDisplay = Json::encode($pkDecoded, JSON_UNESCAPED_UNICODE);
    } elseif ($pkDecoded !== null) {
        $pkForDisplay = (string) $pkDecoded;
    }
} catch (Throwable) {
    // usar texto tal cual
}

$formatValue = static function (mixed $v): string {
    if ($v === null) {
        return '—';
    }
    if (is_bool($v)) {
        return $v ? 'true' : 'false';
    }
    if (is_array($v)) {
        try {
            return Html::encode(Json::encode($v, JSON_UNESCAPED_UNICODE));
        } catch (Throwable) {
            return Html::encode('[array]');
        }
    }

    return Html::encode((string) $v);
};

$heroKind = match ($model->action) {
    AuditLog::ACTION_INSERT => 'insert',
    AuditLog::ACTION_DELETE => 'delete',
    default => 'update',
};
$heroIcon = match ($heroKind) {
    'insert' => 'ti-circle-plus',
    'delete' => 'ti-trash',
    default => 'ti-pencil',
};
$badgeClass = match ($heroKind) {
    'insert' => 'text-bg-success',
    'delete' => 'text-bg-danger',
    default => 'text-bg-primary',
};

$userLine = trim((string) ($model->username ?: ''));
if ($userLine === '' && $model->user_id !== null) {
    $userLine = '#' . (string) $model->user_id;
}
if ($userLine === '') {
    $userLine = '—';
}

?>

<div
    class="audit-modal-root"
    data-modal-title="<?= Html::encode(Yii::t('app', 'Auditoría #{id}', ['id' => $model->id])) ?>"
>
    <header class="audit-modal-header audit-hero">
        <div class="audit-hero-icon is-<?= Html::encode($heroKind) ?>" aria-hidden="true">
            <i class="ti <?= Html::encode($heroIcon) ?>"></i>
        </div>
        <div class="audit-hero-meta">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                <span class="badge <?= Html::encode($badgeClass) ?> rounded-pill px-3 py-2 fw-semibold">
                    <?= Html::encode($model->getActionLabel()) ?>
                </span>
                <span class="fw-semibold text-body fs-6 text-break"><?= Html::encode($model->table_name) ?></span>
            </div>
            <div class="audit-meta-chips">
                <span class="audit-chip">
                    <i class="ti ti-calendar-time" aria-hidden="true"></i>
                    <?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at, 'php:d/m/Y H:i')) ?>
                </span>
                <span class="audit-chip">
                    <i class="ti ti-user" aria-hidden="true"></i>
                    <?= Html::encode($userLine) ?>
                </span>
                <?php if ($model->ip !== null && $model->ip !== ''): ?>
                    <span class="audit-chip">
                        <i class="ti ti-world" aria-hidden="true"></i>
                        <?= Html::encode($model->ip) ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="mt-3">
                <div class="audit-section-title mb-2">
                    <i class="ti ti-key" aria-hidden="true"></i>
                    <?= Html::encode(Yii::t('app', 'Clave del registro')) ?>
                </div>
                <div class="audit-pk-box"><?= Html::encode($pkForDisplay) ?></div>
            </div>
        </div>
    </header>

    <div class="audit-modal-body">
        <?php if ($presentation['kind'] === 'insert'): ?>
            <section class="audit-section">
                <div class="audit-section-title">
                    <i class="ti ti-circle-plus" aria-hidden="true"></i>
                    <?= Html::encode(Yii::t('app', 'Datos creados')) ?>
                </div>
                <?php $fields = $presentation['insert_fields'] ?? []; ?>
                <?php if ($fields === []): ?>
                    <div class="audit-empty-hint"><?= Html::encode(Yii::t('app', 'No hay campos con valor en el registro creado.')) ?></div>
                <?php else: ?>
                    <div class="audit-table-card">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Campo')) ?></th>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Valor')) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fields as $attr => $val): ?>
                                        <tr>
                                            <td class="audit-field-name"><?= Html::encode((string) $attr) ?></td>
                                            <td><span class="audit-val d-inline-block w-100"><?= $formatValue($val) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </section>

        <?php elseif ($presentation['kind'] === 'delete'): ?>
            <section class="audit-section">
                <div class="audit-section-title">
                    <i class="ti ti-trash" aria-hidden="true"></i>
                    <?= Html::encode(Yii::t('app', 'Datos eliminados')) ?>
                </div>
                <?php $fields = $presentation['delete_fields'] ?? []; ?>
                <?php if ($fields === []): ?>
                    <div class="audit-empty-hint"><?= Html::encode(Yii::t('app', 'Sin datos previos registrados en la auditoría.')) ?></div>
                <?php else: ?>
                    <div class="audit-table-card">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Campo')) ?></th>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Valor eliminado')) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fields as $attr => $val): ?>
                                        <tr>
                                            <td class="audit-field-name"><?= Html::encode((string) $attr) ?></td>
                                            <td><span class="audit-val d-inline-block w-100"><?= $formatValue($val) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </section>

        <?php else: ?>
            <section class="audit-section">
                <div class="audit-section-title">
                    <i class="ti ti-git-compare" aria-hidden="true"></i>
                    <?= Html::encode(Yii::t('app', 'Campos modificados')) ?>
                </div>
                <?php $changes = $presentation['update_changes'] ?? []; ?>
                <?php if ($changes === []): ?>
                    <div class="audit-empty-hint"><?= Html::encode(Yii::t('app', 'No se detectaron diferencias entre el estado anterior y el nuevo.')) ?></div>
                <?php else: ?>
                    <div class="audit-table-card">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Campo')) ?></th>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Antes')) ?></th>
                                        <th scope="col"><?= Html::encode(Yii::t('app', 'Después')) ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($changes as $row): ?>
                                        <tr>
                                            <td class="audit-field-name"><?= Html::encode($row['attribute']) ?></td>
                                            <td class="audit-col-old"><span class="audit-val d-inline-block w-100"><?= $formatValue($row['old']) ?></span></td>
                                            <td class="audit-col-new"><span class="audit-val d-inline-block w-100"><?= $formatValue($row['new']) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </div>
</div>
