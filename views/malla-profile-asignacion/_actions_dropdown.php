<?php
use app\models\MallaProfileAsignacion;
use yii\helpers\Html;

/** @var MallaProfileAsignacion $model */
if ($model->profile && $model->malla) {
    $nombre = ($model->profile->name ?: 'Sin nombre') . ' - ' . ($model->malla->nombre ?: '-');
} else {
    $nombre = $model->id ? ('Asignación #' . $model->id) : 'esta asignación';
}
?>
<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones">
        <i class="ti ti-dots-vertical fs-16"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-malla-profile-asignacion-view" data-id="<?= (int) $model->id ?>">
                <i class="ti ti-eye me-2"></i>Ver
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-malla-profile-asignacion-edit" data-id="<?= (int) $model->id ?>">
                <i class="ti ti-edit me-2"></i>Editar
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="dropdown-item text-danger btn-malla-profile-asignacion-delete" data-id="<?= (int) $model->id ?>" data-nombre="<?= Html::encode($nombre) ?>">
                <i class="ti ti-trash me-2"></i>Eliminar
            </a>
        </li>
    </ul>
</div>

