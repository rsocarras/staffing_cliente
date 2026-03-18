<?php
use app\models\NovedadTipo;
use yii\helpers\Html;

/** @var app\models\NovedadTipo $model */
?>
<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones">
        <i class="ti ti-dots-vertical fs-16"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-novedad-tipo-view d-flex align-items-center gap-2 py-2 rounded text-info" data-id="<?= $model->id ?>">
                <span class="avatar avatar-sm bg-soft-info text-info rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-eye fs-12"></i>
                </span>
                <span class="fw-medium">Ver</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-novedad-tipo-edit d-flex align-items-center gap-2 py-2 rounded" data-id="<?= $model->id ?>">
                <span class="avatar avatar-sm bg-soft-primary text-primary rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-edit fs-12"></i>
                </span>
                <span class="fw-medium">Editar</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="dropdown-item text-danger btn-novedad-tipo-delete d-flex align-items-center gap-2 py-2 rounded" data-id="<?= $model->id ?>" data-nombre="<?= Html::encode($model->nombre) ?>">
                <span class="avatar avatar-sm bg-soft-danger text-danger rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                    <i class="ti ti-trash fs-12"></i>
                </span>
                <span class="fw-medium">Eliminar</span>
            </a>
        </li>
    </ul>
</div>

