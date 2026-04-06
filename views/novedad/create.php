<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */
/** @var app\models\forms\NovedadSolicitudContextForm $ctx */
/** @var app\models\Empresas|null $empresa */
/** @var app\models\NovedadTipo|null $tipoSeleccionado */
/** @var int|null $horasTipoId */
/** @var bool $esContratoTipoHoras */
/** @var app\models\EmpresaCliente[] $clientesEmpresa */
/** @var app\models\EmpresaCliente|null $clienteUnico */
/** @var bool $sinEmpresaCliente */
$clienteUnico = $clienteUnico ?? null;
$sinEmpresaCliente = $sinEmpresaCliente ?? false;

$this->title = Yii::t('app', 'Nueva solicitud de novedad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Novedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$clientesEmpresa = $clientesEmpresa ?? [];
?>
<div class="novedad-create">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <h4 class="card-title mb-0 fw-semibold"><?= Html::encode($this->title) ?></h4>
            <p class="text-muted small mb-0 mt-2">
                <?= Html::encode(Yii::t(
                    'app',
                    'Complete los datos para registrar la solicitud. El asterisco rojo (*) junto a la etiqueta indica campo obligatorio.'
                )) ?>
            </p>
        </div>
        <div class="card-body p-3 p-md-4">
            <?php
            $flashError = Yii::$app->session->getFlash('error');
            if ($flashError !== null && $flashError !== '') {
                echo Alert::widget([
                    'options' => ['class' => 'alert-dismissible alert-danger', 'role' => 'alert'],
                    'body' => Html::encode((string) $flashError),
                    'closeButton' => ['label' => '×'],
                ]);
            }
            ?>
            <?= $this->render('_form_solicitud', [
                'model' => $model,
                'ctx' => $ctx,
                'empresa' => $empresa,
                'horasTipoId' => $horasTipoId,
                'esContratoTipoHoras' => $esContratoTipoHoras ?? false,
                'clientesEmpresa' => $clientesEmpresa,
                'clienteUnico' => $clienteUnico,
                'sinEmpresaCliente' => $sinEmpresaCliente,
                'solicitudFormState' => $solicitudFormState ?? [],
            ]) ?>
        </div>
    </div>
</div>
