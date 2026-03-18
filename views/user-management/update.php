<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\User $model */
/** @var array $allRoles */

$this->title = 'Editar usuario: ' . $model->username;
?>
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1"><?= Html::encode($this->title) ?></h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-smart-home"></i></a></li>
                <li class="breadcrumb-item"><?= Html::a('Usuarios', ['index']) ?></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <?= Html::a('<i class="ti ti-arrow-left me-2"></i>Volver', ['index'], ['class' => 'btn btn-white']) ?>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Datos del usuario</h5>
    </div>
    <div class="card-body">
        <?= $this->render('_form', ['model' => $model, 'allRoles' => $allRoles, 'isNew' => false]) ?>
    </div>
</div>
