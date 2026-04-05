<?php

declare(strict_types=1);

use app\models\forms\NovedadSolicitudContextForm;
use app\models\Novedad;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Novedad $model */
/** @var NovedadSolicitudContextForm $ctx */
/** @var app\models\Empresas|null $empresa */
/** @var int|null $horasTipoId */
/** @var app\models\EmpresaCliente[] $clientesEmpresa */
/** @var app\models\EmpresaCliente|null $clienteUnico */
/** @var bool $sinEmpresaCliente */
/** @var string $msgHorasRangoInvalido */
/** @var array<string, mixed> $solicitudFormState */

$clienteUnico = $clienteUnico ?? null;
$solicitudFormState = $solicitudFormState ?? [];
$sinEmpresaCliente = $sinEmpresaCliente ?? false;
$puedeEnviar = $empresa !== null && !$sinEmpresaCliente;

$formId = 'novedad-solicitud-form';
$ajax = [
    'agrupadores' => Url::to(['/novedad/agrupadores']),
    'buscarEmpleado' => Url::to(['/novedad/buscar-empleado']),
    'empresasClientePorEmpleado' => Url::to(['/novedad/empresas-cliente-por-empleado']),
    'sedes' => Url::to(['/novedad/sedes']),
    'cargoClases' => Url::to(['/novedad/cargo-clases-grupales']),
    'conceptos' => Url::to(['/novedad/conceptos']),
    'tipoCampos' => Url::to(['/novedad/tipo-campos']),
];

$lblClass = 'form-label fw-semibold mb-2';
$fldRow = ['options' => ['class' => 'mb-0']];
$lblOpts = ['class' => $lblClass];
/** Texto de etiqueta con asterisco obligatorio (usar con ->label(..., ['encode' => false] + $lblOpts)). */
$txtReq = static function (string $text): string {
    return $text . ' <span class="text-danger ms-1" aria-hidden="true">*</span>';
};
$lblNorm = static function () use ($lblClass): array {
    return ['labelOptions' => ['class' => $lblClass]];
};

$this->registerCss(<<<'CSS'
.novedad-solicitud-form .novedad-solicitud-seccion .form-control,
.novedad-solicitud-form .novedad-solicitud-seccion .form-select {
    min-height: calc(1.5em + 0.75rem + 2px);
}
.novedad-solicitud-form .novedad-solicitud-panel-lectura {
    min-height: 5.75rem;
}
.novedad-solicitud-form .input-group .btn {
    white-space: nowrap;
}
/* Filas de dos columnas: alinear siempre desde arriba (evita saltos con validación) */
.novedad-solicitud-form .novedad-solicitud-row-campos {
    align-items: flex-start;
}
.novedad-solicitud-form .novedad-solicitud-row-campos > [class*="col-"] {
    display: flex;
    flex-direction: column;
}
.novedad-solicitud-form .novedad-solicitud-row-campos .novedad-solicitud-campo-pie {
    margin-top: 0.5rem;
    min-height: 2.75rem;
    font-size: 0.875rem;
}
.novedad-solicitud-form .novedad-solicitud-row-campos .field-solicitudctx-empresa_cliente_id {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    margin-bottom: 0;
}
/* Checkbox auxilio: evitar margin negativo de .form-check que saca el input fuera del borde */
.novedad-solicitud-form .novedad-solicitud-auxilio-check .form-check-input {
    float: none;
    margin-left: 0;
    margin-inline-start: 0;
    margin-top: 0.2em;
    position: static;
    flex-shrink: 0;
}
.novedad-solicitud-form .novedad-solicitud-auxilio-check .form-check-label {
    cursor: pointer;
    line-height: 1.45;
}
CSS
);

?>

<div class="novedad-solicitud-form">
    <?= Html::script(Json::encode($solicitudFormState), ['type' => 'application/json', 'id' => 'novedad-solicitud-state-json']) ?>
    <?php if ($sinEmpresaCliente): ?>
        <div class="alert alert-danger">
            <?= Yii::t(
                'app',
                'No hay empresa cliente activa para su organización. No se puede enviar la solicitud hasta que exista al menos una en el sistema.'
            ) ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'id' => $formId,
        'options' => [
            'class' => 'needs-validation',
            'novalidate' => true,
            'data-novedad-tipo-horas-id' => $horasTipoId !== null ? (string) $horasTipoId : '',
            'data-novedad-cargo-clases-url' => $ajax['cargoClases'],
            'data-msg-horas-rango-invalido' => $msgHorasRangoInvalido,
            'data-novedad-conceptos-url' => $ajax['conceptos'],
            'data-novedad-tipo-campos-url' => $ajax['tipoCampos'],
            'data-msg-empleado-no-encontrado' => Yii::t('app', 'No se encontró el empleado.'),
            'data-label-cargo' => Yii::t('app', 'Cargo'),
            'data-msg-sin-cargo' => Yii::t('app', 'Sin contrato vigente en la fecha'),
            'data-msg-empresa-cliente-primero' => Yii::t('app', 'Primero busque al empleado por documento.'),
            'data-msg-sin-empresa-cliente-contrato' => Yii::t(
                'app',
                'No hay empresa cliente asociada a un contrato vigente de este empleado en la fecha indicada (o indique la fecha de la novedad).'
            ),
            'data-msg-empleado-recuperado' => Yii::t(
                'app',
                'Empleado asociado a la solicitud. Puede volver a buscar por documento para ver nombre y cargo.'
            ),
            'data-prompt-seleccionar' => Yii::t('app', 'Seleccionar…'),
            'data-placeholder-dinamico' => Yii::t('app', 'Ingrese el valor…'),
            'data-msg-seleccione-sede' => Yii::t('app', 'Se completará al seleccionar una sede…'),
            'data-msg-sin-ciudad-sede' => Yii::t('app', 'Esta sede no tiene ciudad asignada.'),
        ],
    ]); ?>

    <div class="novedad-solicitud-seccion rounded-3 border border-dashed p-3 p-md-4 mb-4 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-id fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Colaborador afectado') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Busque por documento para vincular la novedad al contrato vigente.') ?></p>
            </div>
        </div>
        <div class="row g-3 novedad-solicitud-row-campos">
            <div class="col-md-4 col-lg-3">
                <label class="<?= Html::encode($lblClass) ?>" for="buscar-num-doc">
                    <?= Html::encode(Yii::t('app', 'Documento del empleado')) ?>
                    <span class="text-danger ms-1" aria-hidden="true">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="ti ti-search text-primary"></i></span>
                    <?= Html::textInput('buscar_num_doc', '', [
                        'class' => 'form-control border-start-0 ps-0',
                        'id' => 'buscar-num-doc',
                        'autocomplete' => 'off',
                        'placeholder' => Yii::t('app', 'Ej.: 1234567890'),
                    ]) ?>
                    <?= Html::button(Yii::t('app', 'Buscar'), [
                        'class' => 'btn btn-primary px-3',
                        'type' => 'button',
                        'id' => 'btn-buscar-empleado',
                    ]) ?>
                </div>
                <div class="form-text mt-2 mb-0"><?= Yii::t('app', 'Documento del colaborador afectado por la novedad.') ?></div>
                <?= $form->field($model, 'profile_id', ['enableClientValidation' => false])
                    ->hiddenInput(['id' => 'novedad-profile_id'])
                    ->label(false) ?>
                <input type="hidden" id="empleado-cargo-id" value="">
            </div>
            <div class="col-md-8 col-lg-9">
                <span class="<?= Html::encode($lblClass) ?> d-block"><?= Html::encode(Yii::t('app', 'Datos del empleado')) ?></span>
                <div id="empleado-seleccionado-error" class="alert alert-danger border-0 py-2 px-3 mb-0 d-none rounded-3" role="alert"></div>
                <div id="empleado-seleccionado" class="border rounded-3 px-3 py-3 bg-white small novedad-solicitud-panel-lectura h-100 d-none"></div>
                <div id="empleado-sin-consulta" class="border rounded-3 px-3 py-3 bg-white text-muted small novedad-solicitud-panel-lectura h-100 d-flex align-items-center">
                    <?= Yii::t('app', 'Busque por documento para ver nombre y cargo según contrato en la fecha de la novedad.') ?>
                </div>
            </div>
        </div>
    </div>

    <div id="novedad-secciones-form" style="display:none;">

    <div class="novedad-solicitud-seccion rounded-3 border border-dashed p-3 p-md-4 mb-4 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-building fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Organización y empresa cliente') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'La organización es la de su usuario; el cliente depende del contrato del empleado.') ?></p>
            </div>
        </div>
        <div class="row g-3 novedad-solicitud-row-campos">
            <div class="col-md-6">
                <label class="<?= Html::encode($lblClass) ?>"><?= Html::encode(Yii::t('app', 'Organización')) ?></label>
                <div class="form-control d-flex align-items-center bg-white border rounded-3 py-2 px-3">
                    <?= Html::encode($empresa ? ($empresa->name ?: $empresa->social_name ?: '—') : Yii::t('app', '—')) ?>
                </div>
                <div class="novedad-solicitud-campo-pie text-muted">
                    <?php if ($empresa === null): ?>
                        <span class="text-warning"><i class="ti ti-alert-triangle me-1"></i><?= Yii::t('app', 'El usuario con el que intenta crear la solicitud no tiene una organización asignada.') ?></span>
                    <?php else: ?>
                        <?= Yii::t('app', 'Según su perfil; no se puede cambiar aquí.') ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= $form->field($ctx, 'empresa_cliente_id', $fldRow)
                    ->label($txtReq(Yii::t('app', 'Empresa cliente')), array_merge($lblOpts, ['encode' => false]))
                    ->dropDownList(
                        [],
                        [
                            'prompt' => Yii::t('app', 'Primero busque al empleado…'),
                            'class' => 'form-select rounded-3',
                            'id' => 'solicitudctx-empresa_cliente_id',
                        ]
                    ) ?>
                <div id="empresa-cliente-empleado-hint" class="novedad-solicitud-campo-pie text-muted d-none"></div>
            </div>
        </div>
    </div>

    <div class="novedad-solicitud-seccion rounded-3 border border-dashed p-3 p-md-4 mb-4 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-map-pin fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Ubicación') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Sede operativa y ciudad vinculada (opcional según tipo de novedad).') ?></p>
            </div>
        </div>
        <div class="row g-3 novedad-solicitud-row-campos">
            <div class="col-md-6">
                <?= $form->field($ctx, 'sede_id', array_merge($fldRow, $lblNorm()))->dropDownList([], [
                    'prompt' => Yii::t('app', 'Seleccionar sede…'),
                    'id' => 'solicitudctx-sede_id',
                    'class' => 'form-select rounded-3',
                ]) ?>
            </div>
            <div class="col-md-6">
                <label class="<?= Html::encode($lblClass) ?>"><?= Html::encode(Yii::t('app', 'Ciudad')) ?></label>
                <div id="ciudad-display" class="form-control bg-white rounded-3 text-muted">
                    <?= Html::encode(Yii::t('app', 'Se completará al seleccionar una sede…')) ?>
                </div>
                <?= Html::hiddenInput(
                    'SolicitudCtx[ciudad_id]',
                    $ctx->ciudad_id !== null ? (string) $ctx->ciudad_id : '',
                    ['id' => 'solicitudctx-ciudad_id']
                ) ?>
                <?php if ($ctx->hasErrors('ciudad_id')): ?>
                    <div class="invalid-feedback d-block"><?= Html::encode($ctx->getFirstError('ciudad_id')) ?></div>
                <?php endif; ?>
                <div class="form-text"><?= Html::encode(Yii::t('app', 'Ciudad vinculada a la sede seleccionada.')) ?></div>
            </div>
        </div>
    </div>

    <div class="novedad-solicitud-seccion rounded-3 border border-dashed p-3 p-md-4 mb-4 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-category fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Tipo y concepto') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Agrupador, concepto y campos adicionales del tipo.') ?></p>
            </div>
        </div>
        <div class="row g-3 novedad-solicitud-row-campos">
            <div class="col-12">
                <?= $form->field($ctx, 'novedad_tipo_id', $fldRow)
                    ->label($txtReq(Yii::t('app', 'Tipo / agrupador')), array_merge($lblOpts, ['encode' => false]))
                    ->dropDownList([], [
                        'prompt' => Yii::t('app', 'Seleccionar tipo…'),
                        'id' => 'solicitudctx-novedad_tipo_id',
                        'class' => 'form-select rounded-3',
                    ])->hint(Yii::t('app', 'Solo agrupadores para los que tiene permiso de creación.'), ['class' => 'form-text mt-2']) ?>
            </div>
        </div>
        <?php if (!empty($horasTipoId)): ?>
            <div class="alert alert-info border-0 rounded-3 small mt-3 mb-0 py-3" role="status">
                <i class="ti ti-info-circle me-1"></i><?= Yii::t(
                    'app',
                    'Para solicitar horas (intervalo hora inicio y fin, con troceo en servidor), elija en «Tipo / agrupador» la opción de novedades de tipo horas. Luego complete fecha, empleado y las horas que se muestran debajo.'
                ) ?>
            </div>
        <?php endif; ?>
        <div id="bloque-concepto" class="mt-3 mb-0">
            <?= $form->field($model, 'concepto_id', array_merge(['enableClientValidation' => false], $fldRow))
                ->label($txtReq(Yii::t('app', 'Concepto')), array_merge($lblOpts, ['encode' => false]))
                ->dropDownList([], [
                    'prompt' => Yii::t('app', 'Seleccionar concepto…'),
                    'id' => 'novedad-concepto_id',
                    'class' => 'form-select rounded-3',
                ])->hint(Yii::t('app', 'Filtrado por organización, contrato, cargo y conceptos habilitados.'), ['class' => 'form-text mt-2']) ?>
        </div>
        <div id="bloque-campos-dinamicos" class="row g-3 mt-1 pt-2 border-top border-opacity-25"></div>
    </div>

    <div class="novedad-solicitud-seccion rounded-3 border border-dashed p-3 p-md-4 mb-4 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-danger text-danger rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-calendar-event fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Fecha y horario') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Fecha de la novedad y, si aplica, rango de horas.') ?></p>
            </div>
        </div>
        <div class="row g-3 novedad-solicitud-row-campos">
            <div class="col-md-6 col-lg-4">
                <?= $form->field($model, 'fecha_novedad', $fldRow)
                    ->label($txtReq(Yii::t('app', 'Fecha de la novedad')), array_merge($lblOpts, ['encode' => false]))
                    ->textInput([
                        'type' => 'date',
                        'id' => 'novedad-fecha_novedad',
                        'class' => 'form-control rounded-3',
                    ]) ?>
            </div>
            <div class="col-12 col-lg-8" id="bloque-horas" style="display:none;">
                <div class="row g-3 novedad-solicitud-row-campos">
                    <div class="col-md-6">
                        <?= $form->field($model, 'hora_inicio', $fldRow)
                            ->label($txtReq(Yii::t('app', 'Hora inicio')), array_merge($lblOpts, ['encode' => false]))
                            ->textInput([
                                'type' => 'time',
                                'step' => 60,
                                'id' => 'novedad-hora_inicio',
                                'class' => 'form-control rounded-3',
                            ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'hora_fin', $fldRow)
                            ->label($txtReq(Yii::t('app', 'Hora fin')), array_merge($lblOpts, ['encode' => false]))
                            ->textInput([
                                'type' => 'time',
                                'step' => 60,
                                'id' => 'novedad-hora_fin',
                                'class' => 'form-control rounded-3',
                            ]) ?>
                    </div>
                    <div class="col-12">
                        <p class="text-muted small mb-0"><?= Yii::t('app', 'Tipo horas: sin cruce de medianoche en el formulario; el servidor trocea el intervalo (recargos, etc.).') ?></p>
                    </div>
                </div>
                <div id="bloque-auxilio" class="d-flex align-items-start gap-3 mt-3 mb-0 p-3 bg-white rounded-3 border novedad-solicitud-auxilio-check" style="display:none;">
                    <?= Html::checkbox('auxilio_movilizacion', false, [
                        'class' => 'form-check-input',
                        'id' => 'auxilio_movilizacion',
                        'value' => '1',
                    ]) ?>
                    <label class="form-check-label fw-medium mb-0 flex-grow-1" for="auxilio_movilizacion">
                        <?= Yii::t('app', 'Solicitar auxilio de movilización (importe fijo según configuración, si el cargo aplica a clases grupales)') ?>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="novedad-solicitud-seccion rounded-3 border border-dashed p-3 p-md-4 mb-4 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-secondary text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-align-left fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Descripción') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Detalle opcional de la solicitud.') ?></p>
            </div>
        </div>
        <?= $form->field($model, 'descripcion', array_merge($fldRow, $lblNorm()))->textarea([
            'rows' => 4,
            'class' => 'form-control rounded-3',
            'placeholder' => Yii::t('app', 'Describa el motivo o el detalle de la solicitud (opcional)…'),
        ]) ?>
    </div>

    <?= $form->field($model, 'datos')->hiddenInput(['id' => 'novedad-datos-json', 'value' => $model->datos ?: '{}'])->label(false) ?>

    <div class="d-flex flex-wrap gap-2 pt-2">
        <?= Html::submitButton(
            '<i class="ti ti-send me-1"></i>' . Yii::t('app', 'Enviar solicitud'),
            [
                'class' => 'btn btn-primary px-4 rounded-pill',
                'disabled' => !$puedeEnviar,
                'encode' => false,
            ]
        ) ?>
        <?= Html::a(
            '<i class="ti ti-arrow-left me-1"></i>' . Yii::t('app', 'Cancelar'),
            ['index'],
            ['class' => 'btn btn-outline-secondary rounded-pill', 'encode' => false]
        ) ?>
    </div>

    </div><!-- /#novedad-secciones-form -->

    <?php ActiveForm::end(); ?>

    <div class="modal fade" id="novedad-solicitud-modal-alerta" tabindex="-1" aria-labelledby="novedad-solicitud-modal-alerta-titulo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-semibold" id="novedad-solicitud-modal-alerta-titulo"><?= Yii::t('app', 'Revisar horario') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Html::encode(Yii::t('app', 'Cerrar')) ?>"></button>
                </div>
                <div class="modal-body text-body-secondary" id="novedad-solicitud-modal-alerta-cuerpo"></div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal"><?= Yii::t('app', 'Entendido') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$ajaxJson = \yii\helpers\Json::htmlEncode($ajax);
$horasTipoIdJs = $horasTipoId !== null ? json_encode((int) $horasTipoId) : 'null';
$jsTemplate = <<<'JS'
(function ($) {
  var ajax = __AJAX__;
  var horasTipoId = __HORAS__;
  var $form = $('#__FORM__');
  var formState = {};
  (function () {
    var el = document.getElementById('novedad-solicitud-state-json');
    if (!el || !el.textContent) { return; }
    try { formState = JSON.parse(el.textContent) || {}; } catch (e) { formState = {}; }
  })();
  var msgHoras = $form.attr('data-msg-horas-rango-invalido') || '';
  var conceptosUrl = $form.attr('data-novedad-conceptos-url') || '';
  var tipoCamposUrl = $form.attr('data-novedad-tipo-campos-url') || '';
  var promptSel = ($form.attr('data-prompt-seleccionar') || 'Seleccionar…').trim();
  var placeholderDinamico = ($form.attr('data-placeholder-dinamico') || 'Ingrese el valor…').trim();
  var msgSeleccioneSede = ($form.attr('data-msg-seleccione-sede') || 'Se completará al seleccionar una sede…').trim();
  var msgSinCiudadSede = ($form.attr('data-msg-sin-ciudad-sede') || 'Sin ciudad asignada.').trim();

  /* Mapa sedeId → { city_id, city_nombre } cargado al inicio */
  var sedesData = {};

  function escapeHtml(s) {
    if (s == null || s === '') { return ''; }
    return String(s).replace(/[&<>"']/g, function (ch) {
      return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[ch];
    });
  }

  function mostrarModalAlerta(mensaje) {
    var modalEl = document.getElementById('novedad-solicitud-modal-alerta');
    var cuerpo = document.getElementById('novedad-solicitud-modal-alerta-cuerpo');
    if (!modalEl || !cuerpo) { return; }
    cuerpo.textContent = mensaje || '';
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
      bootstrap.Modal.getOrCreateInstance(modalEl).show();
    } else {
      $(modalEl).modal('show');
    }
  }

  function ocultarPanelesEmpleado() {
    $('#empleado-seleccionado').addClass('d-none').empty();
    $('#empleado-seleccionado-error').addClass('d-none').empty();
    $('#empleado-sin-consulta').removeClass('d-none');
  }

  function setEmpleadoNoEncontrado() {
    var msg = $form.attr('data-msg-empleado-no-encontrado') || '';
    $('#empleado-sin-consulta').addClass('d-none');
    $('#empleado-seleccionado').addClass('d-none').empty();
    $('#empleado-seleccionado-error').text(msg).removeClass('d-none');
  }

  function setEmpleadoPanel(r) {
    var lblCargo = $form.attr('data-label-cargo') || 'Cargo';
    var sinCargo = $form.attr('data-msg-sin-cargo') || '';
    var name = escapeHtml(r.name || '');
    var doc = escapeHtml(r.num_doc || '');
    var line1 = '<div class="fw-medium">' + (name || '—') + (doc ? ' <span class="text-muted fw-normal">· ' + doc + '</span>' : '') + '</div>';
    var line2;
    if (r.cargo_nombre) {
      line2 = '<div class="text-muted mt-1">' + escapeHtml(lblCargo) + ': <span class="text-dark">' + escapeHtml(r.cargo_nombre) + '</span></div>';
    } else {
      line2 = '<div class="text-muted fst-italic mt-1">' + escapeHtml(sinCargo) + '</div>';
    }
    $('#empleado-seleccionado-error').addClass('d-none').empty();
    $('#empleado-sin-consulta').addClass('d-none');
    $('#empleado-seleccionado').removeClass('d-none').html(line1 + line2);
  }

  function fechaParaContratoCliente() {
    var f = ($('#novedad-fecha_novedad').val() || '').trim();
    if (/^\d{4}-\d{2}-\d{2}$/.test(f)) { return f; }
    var d = new Date();
    return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
  }

  /* ── Visibilidad de secciones ── */

  function mostrarSecciones() {
    $('#novedad-secciones-form').show();
  }

  function ocultarSecciones() {
    $('#novedad-secciones-form').hide();
  }

  /* ── Ciudad vinculada a la sede ── */

  function actualizarCiudadDesdeSede(sedeId) {
    var $hidden = $('#solicitudctx-ciudad_id');
    var $display = $('#ciudad-display');
    if (!sedeId || !sedesData[String(sedeId)]) {
      $hidden.val('');
      $display.text(msgSeleccioneSede).addClass('text-muted');
      return;
    }
    var d = sedesData[String(sedeId)];
    if (d.city_id) {
      $hidden.val(String(d.city_id));
      $display.text(d.city_nombre || '—').removeClass('text-muted').css('color', '');
    } else {
      $hidden.val('');
      $display.text(msgSinCiudadSede).addClass('text-muted');
    }
  }

  /* ── Empresa cliente ── */

  function loadEmpresasCliente(done) {
    var $sel = $('#solicitudctx-empresa_cliente_id');
    var url = ajax.empresasClientePorEmpleado;
    var pid = $('#novedad-profile_id').val() || '';
    var promptDoc = $form.attr('data-msg-empresa-cliente-primero') || '…';
    var msgVacio = $form.attr('data-msg-sin-empresa-cliente-contrato') || '';
    if (!url) {
      if (typeof done === 'function') { done(); }
      return;
    }
    if (!pid) {
      $sel.empty().append($('<option/>').val('').text(promptDoc));
      $sel.val('');
      $('#empresa-cliente-empleado-hint').addClass('d-none').text('');
      if (typeof done === 'function') { done(); }
      return;
    }
    var fecha = fechaParaContratoCliente();
    $.getJSON(url, { profile_id: pid, fecha_novedad: fecha }, function (data) {
      var items = (data && data.items) ? data.items : [];
      var v = formState.empresa_cliente_id != null ? String(formState.empresa_cliente_id) : '';
      $sel.empty().append($('<option/>').val('').text(promptSel));
      $.each(items, function (_, r) {
        $sel.append($('<option/>').val(r.id).text(r.nombre));
      });
      var $hint = $('#empresa-cliente-empleado-hint');
      if (items.length === 0) {
        $hint.text(msgVacio).removeClass('d-none');
        $sel.val('');
      } else {
        $hint.addClass('d-none').text('');
        if (items.length === 1) {
          $sel.val(String(items[0].id));
        } else if (v) {
          $sel.val(v);
        }
      }
      if (typeof done === 'function') { done(); }
    }).fail(function () {
      $sel.empty().append($('<option/>').val('').text(promptSel));
      if (typeof done === 'function') { done(); }
    });
  }

  /* ── Búsqueda de empleado ── */

  function buscarEmpleadoPorDocumento(done) {
    var doc = ($('#buscar-num-doc').val() || '').trim();
    var fecha = $('#novedad-fecha_novedad').val() || '';
    if (doc.length < 3) {
      ocultarPanelesEmpleado();
      ocultarSecciones();
      $('#novedad-profile_id').val('');
      $('#empleado-cargo-id').val('');
      loadEmpresasCliente(function () {
        refreshAuxilioCheckbox();
        loadConceptos($('#solicitudctx-novedad_tipo_id').val(), done);
      });
      return;
    }
    $.getJSON(ajax.buscarEmpleado, { num_documento: doc, fecha_novedad: fecha }, function (data) {
      var results = (data && data.results) ? data.results : [];
      if (!results.length) {
        setEmpleadoNoEncontrado();
        ocultarSecciones();
        $('#novedad-profile_id').val('');
        $('#empleado-cargo-id').val('');
        loadEmpresasCliente(function () {
          refreshAuxilioCheckbox();
          loadConceptos($('#solicitudctx-novedad_tipo_id').val(), done);
        });
        return;
      }
      var r = results[0];
      $('#novedad-profile_id').val(r.id);
      setEmpleadoPanel(r);
      $('#empleado-cargo-id').val(r.cargo_id != null ? r.cargo_id : '');
      mostrarSecciones();
      loadEmpresasCliente(function () {
        loadSedes(function () {
          refreshAuxilioCheckbox();
          loadConceptos($('#solicitudctx-novedad_tipo_id').val(), done);
        }, { forcePreferida: true, preserveCurrent: false });
      });
    });
  }

  /* ── Agrupadores (tipo) ── */

  function loadAgrupadores() {
    $.getJSON(ajax.agrupadores, function (rows) {
      var $sel = $('#solicitudctx-novedad_tipo_id');
      var v = $sel.val() || (formState.novedad_tipo_id != null ? String(formState.novedad_tipo_id) : '');
      $sel.empty().append($('<option/>').val('').text(promptSel));
      $.each(rows, function (_, r) {
        $sel.append($('<option/>').val(r.id).text(r.nombre).attr('data-codigo', r.codigo || ''));
      });
      if (v) { $sel.val(v); }
      var id = $sel.val();
      toggleModoHoras(id);
      restaurarEmpleadoPostCarga();
    });
  }

  /* ── Conceptos ── */

  function loadConceptos(tipoId, done) {
    var $c = $('#novedad-concepto_id');
    if (!tipoId) {
      $c.empty().append($('<option/>').val('').text(promptSel));
      if (typeof done === 'function') { done(); }
      return;
    }
    var pid = $('#novedad-profile_id').val() || '';
    var fecha = $('#novedad-fecha_novedad').val() || '';
    $.getJSON(conceptosUrl, {
      novedad_tipo_id: tipoId,
      profile_id: pid,
      fecha_novedad: fecha
    }, function (rows) {
      var v = $c.val() || (formState.concepto_id != null ? String(formState.concepto_id) : '');
      $c.empty().append($('<option/>').val('').text(promptSel));
      $.each(rows, function (_, r) {
        $c.append($('<option/>').val(r.id).text(r.nombre));
      });
      if (v) { $c.val(v); }
      if (typeof done === 'function') { done(); }
    });
  }

  /* ── Campos dinámicos ── */

  function inputTypeForDato(t) {
    var x = (t || '').toLowerCase();
    if (x.indexOf('fecha') >= 0 || x === 'date') { return 'date'; }
    if (x.indexOf('num') >= 0 || x === 'decimal' || x === 'entero') { return 'number'; }
    if (x.indexOf('hora') >= 0) { return 'time'; }
    return 'text';
  }

  function loadTipoCampos(tipoId) {
    var isHoras = horasTipoId !== null && String(tipoId) === String(horasTipoId);
    var $blk = $('#bloque-campos-dinamicos');
    $blk.empty();
    if (!tipoId || isHoras || !tipoCamposUrl) { return; }
    var persisted = {};
    try {
      var jo = JSON.parse($('#novedad-datos-json').val() || '{}');
      if (jo && typeof jo === 'object' && jo.campos_dinamicos) {
        persisted = jo.campos_dinamicos;
      }
    } catch (e2) { persisted = {}; }
    $.getJSON(tipoCamposUrl, { novedad_tipo_id: tipoId }, function (res) {
      if (!res || !res.success || !res.items || !res.items.length) { return; }
      $.each(res.items, function (_, f) {
        var $wrap = $('<div class="col-md-6"/>');
        $wrap.append($('<label class="form-label fw-semibold mb-2"/>').html(
          escapeHtml(f.label || '') + (f.requerido ? ' <span class="text-danger ms-1" aria-hidden="true">*</span>' : '')
        ));
        var $field;
        if (f.opciones && f.opciones.length) {
          $field = $('<select class="form-select rounded-3"/>').attr('data-ncampo', f.campo_id);
          $field.append($('<option value=""/>').text(promptSel));
          $.each(f.opciones, function (_, o) {
            $field.append($('<option/>').val(o.valor).text(o.etiqueta || o.valor));
          });
        } else {
          $field = $('<input class="form-control rounded-3"/>').attr({
            type: inputTypeForDato(f.tipo_dato),
            'data-ncampo': f.campo_id,
            placeholder: placeholderDinamico
          });
        }
        if (f.requerido) { $field.prop('required', true); }
        var pv = persisted[f.campo_id];
        if (pv !== undefined && pv !== null && String(pv) !== '') {
          $field.val(String(pv));
        }
        $wrap.append($field);
        $blk.append($wrap);
      });
    });
  }

  /* ── Sedes filtradas por contexto (cliente → contrato → todas) ── */

  function loadSedes(done, options) {
    options = options || {};
    var forcePreferida = options.forcePreferida === true;
    var preserveCurrent = options.preserveCurrent !== false;
    var $s = $('#solicitudctx-sede_id');
    var currentVal = preserveCurrent ? $s.val() : '';
    $s.empty().append($('<option/>').val('').text(promptSel));
    actualizarCiudadDesdeSede('');
    if (!ajax.sedes) {
      if (typeof done === 'function') { done(); }
      return;
    }
    var params = {
      empresa_cliente_id: $('#solicitudctx-empresa_cliente_id').val() || '',
      profile_id:         $('#novedad-profile_id').val() || '',
      fecha_novedad:      $('#novedad-fecha_novedad').val() || ''
    };
    $.getJSON(ajax.sedes, params, function (rows) {
      sedesData = {};
      var sv = preserveCurrent ? (currentVal || (formState.sede_id != null ? String(formState.sede_id) : '')) : '';
      var preferredSedeId = '';
      $.each(rows, function (_, r) {
        $s.append($('<option/>').val(r.id).text(r.nombre));
        sedesData[String(r.id)] = { city_id: r.city_id, city_nombre: r.city_nombre };
        if (!preferredSedeId && r.preferida) {
          preferredSedeId = String(r.id);
        }
      });
      var targetVal = '';
      if (forcePreferida && preferredSedeId) {
        targetVal = preferredSedeId;
      } else if (sv) {
        targetVal = sv;
      } else if (preferredSedeId) {
        targetVal = preferredSedeId;
      }
      if (targetVal) {
        $s.val(targetVal);
        if (String($s.val() || '') !== String(targetVal)) {
          $s.val('');
        }
      }
      actualizarCiudadDesdeSede($s.val());
      if (typeof done === 'function') { done(); }
    }).fail(function () {
      if (typeof done === 'function') { done(); }
    });
  }

  /* ── Restaurar estado tras POST con errores ── */

  function restaurarEmpleadoPostCarga() {
    if (formState.auxilio_movilizacion) {
      $('#auxilio_movilizacion').prop('checked', true);
    }
    if (formState.num_doc && String(formState.num_doc).length >= 3) {
      $('#buscar-num-doc').val(formState.num_doc);
      buscarEmpleadoPorDocumento(function () {
        if (formState.auxilio_movilizacion) {
          $('#auxilio_movilizacion').prop('checked', true);
        }
        refreshAuxilioCheckbox();
      });
      return;
    }
    if (formState.profile_id) {
      mostrarSecciones();
      $('#novedad-profile_id').val(String(formState.profile_id));
      if (formState.cargo_id != null) {
        $('#empleado-cargo-id').val(String(formState.cargo_id));
      }
      $('#empleado-sin-consulta').addClass('d-none');
      $('#empleado-seleccionado-error').addClass('d-none').empty();
      $('#empleado-seleccionado').removeClass('d-none').html(
        '<span class="text-muted">' + escapeHtml($form.attr('data-msg-empleado-recuperado') || '') + '</span>'
      );
      loadEmpresasCliente(function () {
        loadSedes(function () {
          refreshAuxilioCheckbox();
          loadConceptos($('#solicitudctx-novedad_tipo_id').val(), function () {
            if (formState.auxilio_movilizacion) {
              $('#auxilio_movilizacion').prop('checked', true);
            }
            refreshAuxilioCheckbox();
          });
        });
      });
      return;
    }
    var tid = $('#solicitudctx-novedad_tipo_id').val();
    if (tid) {
      loadConceptos(tid, function () {
        if (formState.auxilio_movilizacion) {
          $('#auxilio_movilizacion').prop('checked', true);
        }
        refreshAuxilioCheckbox();
      });
    } else {
      refreshAuxilioCheckbox();
    }
  }

  function toggleModoHoras(tipoId) {
    var isHoras = horasTipoId !== null && String(tipoId) === String(horasTipoId);
    $('#bloque-horas').toggle(isHoras);
    $('#bloque-concepto').toggle(!isHoras);
    var $conc = $('#novedad-concepto_id');
    if (isHoras) {
      $conc.val('').prop({ disabled: true, required: false });
    } else {
      $conc.prop({ disabled: false, required: true });
    }
    if (!isHoras) {
      loadTipoCampos(tipoId);
    } else {
      $('#bloque-campos-dinamicos').empty();
    }
  }

  function refreshAuxilioCheckbox() {
    var tipoId = $('#solicitudctx-novedad_tipo_id').val();
    var isHoras = horasTipoId !== null && String(tipoId) === String(horasTipoId);
    if (!isHoras) {
      $('#bloque-auxilio').hide();
      $('#auxilio_movilizacion').prop('checked', false);
      return;
    }
    var cargoId = $('#empleado-cargo-id').val();
    var url = $form.attr('data-novedad-cargo-clases-url');
    if (!cargoId || !url) {
      $('#bloque-auxilio').hide();
      $('#auxilio_movilizacion').prop('checked', false);
      return;
    }
    $.getJSON(url, { cargo_id: cargoId })
      .done(function (res) {
        if (res && res.aplica) {
          $('#bloque-auxilio').show();
        } else {
          $('#bloque-auxilio').hide();
          $('#auxilio_movilizacion').prop('checked', false);
        }
      })
      .fail(function () {
        $('#bloque-auxilio').hide();
        $('#auxilio_movilizacion').prop('checked', false);
      });
  }

  function mergeDatosDinamicos() {
    var $hidden = $('#novedad-datos-json');
    var o = {};
    try { o = JSON.parse($hidden.val() || '{}'); } catch (e) { o = {}; }
    if (typeof o !== 'object' || o === null) { o = {}; }
    o.campos_dinamicos = {};
    $('#bloque-campos-dinamicos [data-ncampo]').each(function () {
      var key = $(this).data('ncampo');
      if (key) { o.campos_dinamicos[key] = $(this).val(); }
    });
    $hidden.val(JSON.stringify(o));
  }

  /* ── Manejadores de eventos ── */

  $('#solicitudctx-novedad_tipo_id').on('change', function () {
    var id = $(this).val();
    toggleModoHoras(id);
    loadConceptos(id, null);
    refreshAuxilioCheckbox();
  });

  $('#solicitudctx-empresa_cliente_id').on('change', function () {
    loadSedes(null, { forcePreferida: true, preserveCurrent: false });
  });

  $('#solicitudctx-sede_id').on('change', function () {
    actualizarCiudadDesdeSede($(this).val());
  });

  $('#btn-buscar-empleado').on('click', function () {
    buscarEmpleadoPorDocumento(null);
  });

  $('#buscar-num-doc').on('keydown', function (e) {
    if (e.key === 'Enter' || e.which === 13) {
      e.preventDefault();
      buscarEmpleadoPorDocumento(null);
    }
  });

  $('#novedad-fecha_novedad').on('change', function () {
    if ($('#novedad-profile_id').val()) {
      buscarEmpleadoPorDocumento(null);
    } else {
      loadEmpresasCliente(function () {
        loadConceptos($('#solicitudctx-novedad_tipo_id').val(), null);
      });
    }
  });

  $form.on('submit', function (e) {
    var tipoId = $('#solicitudctx-novedad_tipo_id').val();
    if (horasTipoId !== null && String(tipoId) === String(horasTipoId)) {
      var hi = $('#novedad-hora_inicio').val();
      var hf = $('#novedad-hora_fin').val();
      if (hi && hf && hf <= hi) {
        mostrarModalAlerta(msgHoras);
        e.preventDefault();
        return false;
      }
    }
    mergeDatosDinamicos();
  });

  /* ── Arranque: cargar sedes → agrupadores → restaurar estado ── */
  loadSedes(loadAgrupadores);

})(jQuery);
JS;
$js = str_replace(
    ['__AJAX__', '__HORAS__', '__FORM__'],
    [$ajaxJson, $horasTipoIdJs, (string) $formId],
    $jsTemplate
);
$this->registerJs($js);
?>
