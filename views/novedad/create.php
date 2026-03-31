<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */
/** @var app\models\forms\NovedadSolicitudContextForm $ctx */
/** @var app\models\Empresas|null $empresa */
/** @var app\models\NovedadTipo|null $tipoSeleccionado */
/** @var int|null $horasTipoId */
/** @var app\models\EmpresaCliente[] $clientesEmpresa */
/** @var app\models\EmpresaCliente|null $clienteUnico */
/** @var bool $sinEmpresaCliente */
/** @var string $msgHorasRangoInvalido */

$clienteUnico = $clienteUnico ?? null;
$sinEmpresaCliente = $sinEmpresaCliente ?? false;

$this->title = Yii::t('app', 'Nueva solicitud de novedad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Novedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$clientesEmpresa = $clientesEmpresa ?? [];
?>
<div class="novedad-create">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">
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
                'clientesEmpresa' => $clientesEmpresa,
                'clienteUnico' => $clienteUnico,
                'sinEmpresaCliente' => $sinEmpresaCliente,
                'msgHorasRangoInvalido' => $msgHorasRangoInvalido,
                'solicitudFormState' => $solicitudFormState ?? [],
            ]) ?>
        </div>
    </div>
</div>
