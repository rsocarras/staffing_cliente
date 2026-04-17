<?php

declare(strict_types=1);

use app\models\AuditLog;
use app\models\search\AuditLogSearch;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var AuditLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Auditoría de cambios');
$models = $dataProvider->getModels();
$hasActiveFilters = (string) ($searchModel->table_name ?? '') !== ''
    || (string) ($searchModel->action ?? '') !== ''
    || (string) ($searchModel->username ?? '') !== ''
    || (string) ($searchModel->record_pk ?? '') !== ''
    || (string) ($searchModel->created_from ?? '') !== ''
    || (string) ($searchModel->created_to ?? '') !== '';

$this->registerCss(<<<'CSS'
#auditLogModal .modal-dialog {
    max-width: 920px;
}
#auditLogModal .modal-content {
    border: 0;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12);
    overflow: hidden;
}
#auditLogModal .modal-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--bs-border-color);
    background: var(--bs-light);
}
[data-bs-theme="dark"] #auditLogModal .modal-header {
    background: var(--bs-tertiary-bg);
}
#auditLogModal .modal-body {
    padding: 0;
    background: var(--bs-body-bg);
}
#auditLogModal .modal-body > .audit-modal-root {
    padding: 1.25rem 1.25rem 1.35rem;
}
.audit-modal-root .audit-modal-header.audit-hero {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding-bottom: 1rem;
    margin-bottom: 0.25rem;
    border-bottom: 1px solid var(--bs-border-color);
}
.audit-modal-root .audit-hero-icon {
    flex-shrink: 0;
    width: 3rem;
    height: 3rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    line-height: 1;
}
.audit-modal-root .audit-hero-icon.is-insert {
    background: rgba(var(--bs-success-rgb), 0.12);
    color: var(--bs-success);
}
.audit-modal-root .audit-hero-icon.is-update {
    background: rgba(var(--bs-primary-rgb), 0.12);
    color: var(--bs-primary);
}
.audit-modal-root .audit-hero-icon.is-delete {
    background: rgba(var(--bs-danger-rgb), 0.12);
    color: var(--bs-danger);
}
.audit-modal-root .audit-hero-meta {
    flex: 1;
    min-width: 0;
}
.audit-modal-root .audit-meta-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.65rem;
}
.audit-modal-root .audit-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.65rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    font-weight: 500;
    background: var(--bs-tertiary-bg);
    color: var(--bs-body-color);
    border: 1px solid var(--bs-border-color);
}
.audit-modal-root .audit-chip i {
    font-size: 0.9rem;
    opacity: 0.85;
}
.audit-modal-root .audit-pk-box {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    background: var(--bs-tertiary-bg);
    border: 1px solid var(--bs-border-color);
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.8125rem;
    line-height: 1.45;
    word-break: break-all;
    color: var(--bs-secondary-color);
}
.audit-modal-root .audit-section {
    margin-top: 1.1rem;
}
.audit-modal-root .audit-section-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--bs-secondary-color);
    margin-bottom: 0.65rem;
    padding-bottom: 0.35rem;
    border-bottom: 2px solid rgba(var(--bs-primary-rgb), 0.25);
}
.audit-modal-root .audit-section-title i {
    font-size: 1rem;
    opacity: 0.9;
}
.audit-modal-root .audit-table-card {
    border-radius: 0.5rem;
    border: 1px solid var(--bs-border-color);
    overflow: hidden;
}
.audit-modal-root .audit-table-card .table {
    margin-bottom: 0;
    font-size: 0.8125rem;
}
.audit-modal-root .audit-table-card thead th {
    font-weight: 600;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: var(--bs-secondary-color);
    background: var(--bs-tertiary-bg) !important;
    border-bottom: 1px solid var(--bs-border-color);
    padding: 0.65rem 0.85rem;
    white-space: nowrap;
}
.audit-modal-root .audit-table-card tbody td {
    padding: 0.55rem 0.85rem;
    vertical-align: top;
}
.audit-modal-root .audit-table-card tbody tr:hover td {
    background: rgba(var(--bs-primary-rgb), 0.04);
}
.audit-modal-root .audit-field-name {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--bs-primary);
}
.audit-modal-root .audit-val {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.78rem;
    line-height: 1.4;
    word-break: break-word;
    padding: 0.35rem 0.5rem;
    border-radius: 0.35rem;
    background: rgba(0, 0, 0, 0.04);
}
[data-bs-theme="dark"] .audit-modal-root .audit-val {
    background: rgba(255, 255, 255, 0.06);
}
.audit-modal-root .audit-col-old .audit-val {
    background: rgba(var(--bs-danger-rgb), 0.08);
}
.audit-modal-root .audit-col-new .audit-val {
    background: rgba(var(--bs-success-rgb), 0.1);
}
.audit-modal-root .audit-empty-hint {
    padding: 1.25rem;
    text-align: center;
    border-radius: 0.5rem;
    background: var(--bs-tertiary-bg);
    border: 1px dashed var(--bs-border-color);
    color: var(--bs-secondary-color);
    font-size: 0.875rem;
}
CSS);

$this->registerJs(<<<'JS'
(function () {
    const modalEl = document.getElementById('auditLogModal');
    const body = document.getElementById('auditLogModalBody');
    const titleEl = document.getElementById('auditLogModalLabel');
    if (!modalEl || !body || typeof bootstrap === 'undefined') {
        return;
    }
    const bsModal = new bootstrap.Modal(modalEl);
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.js-audit-detail');
        if (!btn) {
            return;
        }
        e.preventDefault();
        const url = btn.getAttribute('data-url');
        if (!url) {
            return;
        }
        const titleText = titleEl.querySelector('.js-audit-modal-title-text');
        if (titleText) {
            titleText.textContent = btn.getAttribute('data-loading') || '…';
        }
        body.innerHTML = '<div class="p-5 text-center text-muted"><div class="spinner-border spinner-border-sm text-primary" role="status"></div><div class="small mt-2">' + (btn.getAttribute('data-loading') || '') + '</div></div>';
        bsModal.show();
        try {
            const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }
            const html = await res.text();
            body.innerHTML = html;
            const root = body.querySelector('.audit-modal-root');
            const fromData = root ? root.getAttribute('data-modal-title') : null;
            if (titleText) {
                titleText.textContent = fromData || (modalEl.getAttribute('data-default-title') || '');
            }
        } catch (err) {
            body.innerHTML = '<div class="alert alert-danger m-3">' + (btn.getAttribute('data-error') || '') + '</div>';
            if (titleText) {
                titleText.textContent = btn.getAttribute('data-error-title') || '';
            }
        }
    });
})();
JS
);

?>

<div class="page-wrapper">
    <div class="content">
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                        <p class="text-muted fs-13 mb-0 mt-1"><?= Html::encode(Yii::t('app', 'Historial de altas, modificaciones y bajas registradas en la aplicación.')) ?></p>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><?= Html::encode(Yii::t('app', 'Administración')) ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="accordion mb-4" id="accordionFiltrosAudit">
                    <div class="accordion-item border rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button <?= $hasActiveFilters ? '' : 'collapsed' ?> py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosAudit" aria-expanded="<?= $hasActiveFilters ? 'true' : 'false' ?>" aria-controls="collapseFiltrosAudit">
                                <i class="ti ti-filter me-2"></i><?= Html::encode(Yii::t('app', 'Filtros')) ?>
                            </button>
                        </h2>
                        <div id="collapseFiltrosAudit" class="accordion-collapse collapse <?= $hasActiveFilters ? 'show' : '' ?>" data-bs-parent="#accordionFiltrosAudit">
                            <div class="accordion-body py-3 bg-light bg-opacity-25">
                                <?= $this->render('_search', ['model' => $searchModel]) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><?= Html::encode(Yii::t('app', 'Fecha')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Tabla')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Acción')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Clave')) ?></th>
                                <th><?= Html::encode(Yii::t('app', 'Usuario')) ?></th>
                                <th class="text-end"><?= Html::encode(Yii::t('app', 'Detalle')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($models as $model): ?>
                                <?php /** @var AuditLog $model */ ?>
                                <?php
                                $badgeMap = [
                                    AuditLog::ACTION_INSERT => 'bg-success',
                                    AuditLog::ACTION_UPDATE => 'bg-primary',
                                    AuditLog::ACTION_DELETE => 'bg-danger',
                                ];
                                $badgeCls = $badgeMap[$model->action] ?? 'bg-secondary';
                                $u = $model->username ?: ($model->user_id !== null ? '#' . (string) $model->user_id : '');
                                ?>
                                <tr>
                                    <td class="fw-medium"><?= (int) $model->id ?></td>
                                    <td><?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at, 'php:Y-m-d H:i:s')) ?></td>
                                    <td class="text-break"><?= Html::encode($model->table_name) ?></td>
                                    <td><span class="badge <?= Html::encode($badgeCls) ?>"><?= Html::encode($model->getActionLabel()) ?></span></td>
                                    <td class="text-break" style="max-width:220px;"><?= Html::encode($model->record_pk) ?></td>
                                    <td><?= $u !== '' && $u !== '#' ? Html::encode($u) : '—' ?></td>
                                    <td class="text-end">
                                        <?= Html::button(
                                            '<i class="ti ti-eye me-1"></i>' . Yii::t('app', 'Ver'),
                                            [
                                                'class' => 'btn btn-sm btn-outline-primary js-audit-detail',
                                                'data-url' => Url::to(['/audit-log/modal', 'id' => $model->id]),
                                                'data-loading' => Yii::t('app', 'Cargando…'),
                                                'data-error' => Yii::t('app', 'No se pudo cargar el detalle.'),
                                                'data-error-title' => Yii::t('app', 'Error'),
                                                'encode' => false,
                                            ]
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if ($models === []): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted"><?= Html::encode(Yii::t('app', 'No hay registros de auditoría.')) ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">
                    <?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="auditLogModal"
    tabindex="-1"
    aria-labelledby="auditLogModalLabel"
    aria-hidden="true"
    data-default-title="<?= Html::encode(Yii::t('app', 'Detalle de auditoría')) ?>"
>
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center gap-2 mb-0" id="auditLogModalLabel">
                    <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ti ti-file-analytics fs-16" aria-hidden="true"></i>
                    </span>
                    <span class="js-audit-modal-title-text"><?= Html::encode(Yii::t('app', 'Detalle de auditoría')) ?></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="auditLogModalBody"></div>
        </div>
    </div>
</div>
