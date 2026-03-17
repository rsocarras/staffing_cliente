<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Manual de usuario';
$this->params['breadcrumbs'][] = ['label' => 'Documentación', 'url' => ['manual-usuario']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
                </ol>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5>¿Qué encontrarás en este manual?</h5>
                <p class="mb-2">Esta guía resume cómo usar el sistema para operar módulos principales sin depender de soporte técnico.</p>
                <ul class="mb-0">
                    <li>Navegación por secciones.</li>
                    <li>Flujo de requisiciones.</li>
                    <li>Módulo de mallas y asignaciones.</li>
                    <li>Buenas prácticas para evitar errores comunes.</li>
                </ul>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">Accesos rápidos</h5>
                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-primary" href="<?= Url::to(['/requisicion/index']) ?>">Requisiciones</a>
                    <a class="btn btn-outline-primary" href="<?= Url::to(['/mallas/index']) ?>">Mallas</a>
                    <a class="btn btn-outline-primary" href="<?= Url::to(['/malla-cargo-asignacion/index']) ?>">Asignación por cargo</a>
                    <a class="btn btn-outline-primary" href="<?= Url::to(['/malla-profile-asignacion/index']) ?>">Asignación por empleado</a>
                    <a class="btn btn-primary" href="<?= Url::to(['/documentacion/crear-requisicion']) ?>">Guía: crear requisición</a>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Recomendaciones</h5>
                <ul class="mb-0">
                    <li>Completa todos los campos obligatorios antes de guardar.</li>
                    <li>Verifica sede, área y cargo para evitar reprocesos.</li>
                    <li>Usa los estados del flujo como control operativo del proceso.</li>
                    <li>Si un registro no aparece, revisa filtros activos en el listado.</li>
                </ul>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>

