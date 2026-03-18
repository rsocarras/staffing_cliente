<?php
use app\models\Requisicion;
use yii\helpers\Html;

/** @var Requisicion $model */
?>

<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones">
        <i class="ti ti-dots-vertical fs-16"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-requisicion-view" data-id="<?= (int) $model->id ?>">
                <i class="ti ti-eye me-2"></i>Ver
            </a>
        </li>
        <?php if ($model->isEditable()): ?>
            <li>
                <a href="javascript:void(0);" class="dropdown-item btn-requisicion-edit" data-id="<?= (int) $model->id ?>">
                    <i class="ti ti-edit me-2"></i>Editar
                </a>
            </li>
            <li>
                <?= Html::a('<i class="ti ti-send me-2"></i>Enviar a aprobación', ['submit', 'id' => $model->id], [
                    'class' => 'dropdown-item',
                    'data' => [
                        'confirm' => '¿Enviar a aprobación?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
            <li>
                <a href="javascript:void(0);" class="dropdown-item text-danger btn-requisicion-delete" data-id="<?= (int) $model->id ?>" data-nombre="<?= Html::encode($model->group_uuid ?: 'Requisición') ?>">
                    <i class="ti ti-trash me-2"></i>Eliminar
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>

