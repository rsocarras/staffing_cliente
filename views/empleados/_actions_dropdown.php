<?php

use yii\helpers\Html;

/** @var app\models\Profile $model */
?>
<div class="dropdown">
    <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones"><i class="ti ti-dots-vertical fs-16"></i></button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a href="javascript:void(0);" class="dropdown-item btn-empleado-view d-flex align-items-center gap-2 py-2 rounded text-info" data-user-id="<?= (int) $model->user_id ?>"><span class="avatar avatar-sm bg-soft-info text-info rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"><i class="ti ti-eye fs-12"></i></span><span class="fw-medium">Ver</span></a></li>
    </ul>
</div>
