<?php
use yii\helpers\Html;
/** @var string $name */
?>
<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones"><i class="ti ti-dots-vertical fs-16"></i></button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a href="javascript:void(0);" class="dropdown-item btn-role-edit" data-name="<?= Html::encode($name) ?>"><i class="ti ti-edit me-2"></i>Editar</a></li>
        <li><a href="javascript:void(0);" class="dropdown-item text-danger btn-role-delete" data-name="<?= Html::encode($name) ?>"><i class="ti ti-trash me-2"></i>Eliminar</a></li>
    </ul>
</div>
