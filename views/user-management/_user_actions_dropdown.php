<?php
use yii\helpers\Html;
/** @var int $id */
/** @var string $username */
/** @var bool $active */
?>
<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones"><i class="ti ti-dots-vertical fs-16"></i></button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a href="javascript:void(0);" class="dropdown-item btn-user-edit" data-id="<?= (int) $id ?>"><i class="ti ti-edit me-2"></i>Editar</a></li>
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-user-block <?= $active ? 'text-danger' : 'text-success' ?>" data-id="<?= (int) $id ?>" data-username="<?= Html::encode($username) ?>" data-active="<?= $active ? '1' : '0' ?>">
                <i class="ti ti-<?= $active ? 'user-off' : 'user-check' ?> me-2"></i><?= $active ? 'Inactivar' : 'Activar' ?>
            </a>
        </li>
    </ul>
</div>
