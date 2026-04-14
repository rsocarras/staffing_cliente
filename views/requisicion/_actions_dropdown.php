<?php
use app\models\Requisicion;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var Requisicion $model */
?>

<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones">
        <i class="ti ti-dots-vertical fs-16"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-requisicion-view d-flex align-items-center gap-2 py-2 rounded text-info" data-id="<?= (int) $model->id ?>">
                <span class="avatar avatar-sm bg-soft-info text-info rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"><i class="ti ti-eye fs-12"></i></span>
                <span class="fw-medium">Ver</span>
            </a>
        </li>
        <?php if ($model->isEditable()): ?>
            <li>
                <a href="javascript:void(0);" class="dropdown-item btn-requisicion-edit d-flex align-items-center gap-2 py-2 rounded" data-id="<?= (int) $model->id ?>">
                    <span class="avatar avatar-sm bg-soft-primary text-primary rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"><i class="ti ti-edit fs-12"></i></span>
                    <span class="fw-medium">Editar</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="dropdown-item btn-requisicion-submit d-flex align-items-center gap-2 py-2 rounded"
                   data-url="<?= Html::encode(Url::to(['submit', 'id' => $model->id])) ?>"
                   data-requisicion="<?= Html::encode((string) $model->id) ?>"
                   data-empresa="<?= Html::encode((string) ($model->empresa->nombre ?? '-')) ?>"
                   data-ciudad="<?= Html::encode((string) ($model->ciudad->name ?? '-')) ?>"
                   data-sede="<?= Html::encode((string) ($model->sede->nombre ?? '-')) ?>"
                   data-area="<?= Html::encode((string) ($model->area->nombre ?? '-')) ?>"
                   data-cargo="<?= Html::encode((string) ($model->cargo->nombre ?? '-')) ?>"
                   data-fecha="<?= Html::encode((string) (Yii::$app->formatter->asDate($model->fecha_ingreso) ?: '-')) ?>">
                    <span class="avatar avatar-sm bg-soft-warning text-warning rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"><i class="ti ti-send fs-12"></i></span>
                    <span class="fw-medium">Enviar a aprobación</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="dropdown-item text-danger btn-requisicion-delete d-flex align-items-center gap-2 py-2 rounded" data-id="<?= (int) $model->id ?>" data-nombre="<?= Html::encode($model->group_uuid ?: 'Requisición') ?>">
                    <span class="avatar avatar-sm bg-soft-danger text-danger rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"><i class="ti ti-trash fs-12"></i></span>
                    <span class="fw-medium">Eliminar</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>

