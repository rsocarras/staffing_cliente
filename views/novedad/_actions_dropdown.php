<?php

declare(strict_types=1);

use app\models\Novedad;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Novedad $model */
$puedeEditarEliminar = $model->isEstadoCargaBorrador();
$mostrarIrBorradorHoras = (string) $model->estado === Novedad::ESTADO_BORRADOR
    && trim((string) ($model->batch_id ?? '')) !== ''
    && $model->novedadTipo !== null
    && $model->novedadTipo->esTipoHoras();
?>
<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones">
        <i class="ti ti-dots-vertical fs-16"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-novedad-view d-flex align-items-center gap-2 py-2 rounded text-info" data-id="<?= $model->id ?>">
                <span class="avatar avatar-sm bg-soft-info text-info rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-eye fs-12"></i>
                </span>
                <span class="fw-medium">Ver</span>
            </a>
        </li>
        <?php if ($mostrarIrBorradorHoras): ?>
        <li>
            <?= Html::a(
                '<span class="avatar avatar-sm bg-soft-warning text-warning rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">'
                . '<i class="ti ti-clipboard-list fs-12"></i></span>'
                . '<span class="fw-medium">' . Html::encode(Yii::t('app', 'Revisar borrador')) . '</span>',
                Url::to(['/novedad/resumen-borrador-horas', 'batch' => trim((string) $model->batch_id)]),
                ['class' => 'dropdown-item d-flex align-items-center gap-2 py-2 rounded', 'encode' => false]
            ) ?>
        </li>
        <?php endif; ?>
        <?php if ($puedeEditarEliminar): ?>
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-novedad-edit d-flex align-items-center gap-2 py-2 rounded" data-id="<?= $model->id ?>">
                <span class="avatar avatar-sm bg-soft-primary text-primary rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-edit fs-12"></i>
                </span>
                <span class="fw-medium"><?= Html::encode(Yii::t('app', 'Editar')) ?></span>
            </a>
        </li>
        <?php endif; ?>
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-novedad-flujo d-flex align-items-center gap-2 py-2 rounded text-secondary" data-id="<?= $model->id ?>">
                <span class="avatar avatar-sm bg-soft-secondary text-secondary rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-route fs-12"></i>
                </span>
                <span class="fw-medium">Flujo</span>
            </a>
        </li>
        <?php if ($puedeEditarEliminar): ?>
        <li>
            <a href="javascript:void(0);" class="dropdown-item text-danger btn-novedad-delete d-flex align-items-center gap-2 py-2 rounded" data-id="<?= $model->id ?>" data-label="<?= Html::encode('#' . $model->id) ?>">
                <span class="avatar avatar-sm bg-soft-danger text-danger rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-trash fs-12"></i>
                </span>
                <span class="fw-medium"><?= Html::encode(Yii::t('app', 'Eliminar')) ?></span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</div>
