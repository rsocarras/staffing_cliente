<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Guía para crear una requisición';
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
                    <li class="breadcrumb-item"><a href="<?= Url::to(['/documentacion/manual-usuario']) ?>">Documentación</a></li>
                    <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
                </ol>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Pasos</h5>
                <ol class="mb-0">
                    <li>Ir a <strong>Requisiciones</strong> y pulsar <strong>Nueva Requisición</strong>.</li>
                    <li>Completar la información de la vacante.</li>
                    <li>Definir número de vacantes para crear el grupo.</li>
                    <li>Guardar y validar que se creen las vacantes esperadas.</li>
                </ol>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">Campos del formulario y su propósito</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Campo</th>
                                <th>¿Para qué sirve?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Empresa</td><td>Define la empresa dueña de la requisición.</td></tr>
                            <tr><td>Motivo vinculación</td><td>Justifica la necesidad de la vacante (opcional).</td></tr>
                            <tr><td>Fecha ingreso</td><td>Fecha objetivo en la que se espera la incorporación.</td></tr>
                            <tr><td>Ciudad</td><td>Ubicación geográfica de la vacante.</td></tr>
                            <tr><td>Sede</td><td>Lugar operativo específico dentro de la ciudad.</td></tr>
                            <tr><td>Área</td><td>Área funcional principal donde se abrirá la vacante.</td></tr>
                            <tr><td>Sub-área</td><td>Detalle organizacional más específico del área.</td></tr>
                            <tr><td>Cargo</td><td>Perfil/cargo solicitado para contratación.</td></tr>
                            <tr><td>Tipo de contrato</td><td>Modalidad contractual permitida para la requisición.</td></tr>
                            <tr><td>Jornada</td><td>Intensidad horaria esperada para el cargo.</td></tr>
                            <tr><td>Salario</td><td>Salario base estimado para la oferta.</td></tr>
                            <tr><td>Auxilio</td><td>Valor de auxilios asociados al cargo.</td></tr>
                            <tr><td>Esquema variable</td><td>Define componentes variables (bonos/comisiones), si aplica.</td></tr>
                            <tr><td>Número de vacantes</td><td>Cuántas requisiciones se crearán en el grupo.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Consejos operativos</h5>
                <ul class="mb-0">
                    <li>Valida <strong>Ciudad - Sede</strong> y <strong>Área - Sub-área</strong> antes de guardar.</li>
                    <li>Usa número de vacantes mayor a 1 solo cuando sean vacantes equivalentes.</li>
                    <li>Si el flujo requiere aprobación, revisa luego la bandeja de aprobación RRHH.</li>
                </ul>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>

