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

$formId = 'novedad-solicitud-form';
$ajax = [
    'agrupadores' => Url::to(['/novedad/agrupadores']),
    'buscarEmpleado' => Url::to(['/novedad/buscar-empleado']),
    'ciudades' => Url::to(['/novedad/ciudades']),
    'cargoClases' => Url::to(['/novedad/cargo-clases-grupales']),
    'conceptos' => Url::to(['/novedad/conceptos']),
    'tipoCampos' => Url::to(['/novedad/tipo-campos']),
];
$sedesBase = Url::to(['/novedad/sedes-por-ciudad']) . '?ciudad_id=';

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
            'data-sedes-por-ciudad-base' => $sedesBase,
            'data-novedad-conceptos-url' => $ajax['conceptos'],
            'data-novedad-tipo-campos-url' => $ajax['tipoCampos'],
            'data-msg-empleado-no-encontrado' => Yii::t('app', 'No se encontró el empleado.'),
            'data-label-cargo' => Yii::t('app', 'Cargo'),
            'data-msg-sin-cargo' => Yii::t('app', 'Sin contrato vigente en la fecha'),
        ],
    ]); ?>

    <div class="row mb-3">
        <div class="col-md-6 mb-3 mb-md-0">
            <label class="form-label"><?= Yii::t('app', 'Organización') ?></label>
            <div class="form-control-plaintext border rounded px-3 py-2 bg-light">
                <?= Html::encode($empresa ? ($empresa->name ?: $empresa->social_name ?: '—') : Yii::t('app', '—')) ?>
            </div>
            <div class="form-text"><?= Yii::t('app', 'Fija según su perfil de usuario; no se puede cambiar aquí.') ?></div>
        </div>
        <div class="col-md-6">
            <?php if ($clienteUnico !== null): ?>
                <?= Html::activeHiddenInput($ctx, 'empresa_cliente_id') ?>
                <label class="form-label"><?= Yii::t('app', 'Empresa cliente') ?></label>
                <div class="form-control-plaintext border rounded px-3 py-2 bg-light">
                    <?= Html::encode($clienteUnico->nombre) ?>
                </div>
            <?php else: ?>
                <?= $form->field($ctx, 'empresa_cliente_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map($clientesEmpresa, 'id', 'nombre'),
                    ['prompt' => Yii::t('app', 'Seleccione...'), 'class' => 'form-select']
                ) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($ctx, 'ciudad_id')->dropDownList([], [
                'prompt' => Yii::t('app', 'Seleccione...'),
                'id' => 'solicitudctx-ciudad_id',
                'class' => 'form-select',
            ]) ?>
        </div>
        <div class="col-md-6 mb-3">
            <?= $form->field($ctx, 'sede_id')->dropDownList([], [
                'prompt' => Yii::t('app', 'Seleccione ciudad primero'),
                'id' => 'solicitudctx-sede_id',
                'class' => 'form-select',
            ]) ?>
        </div>
    </div>

    <div class="row align-items-start mb-3">
        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
            <div class="novedad-solicitud-empleado-bloque">
                <label class="form-label"><?= Yii::t('app', 'Documento empleado') ?></label>
                <div class="input-group">
                    <?= Html::textInput('buscar_num_doc', '', [
                        'class' => 'form-control',
                        'id' => 'buscar-num-doc',
                        'autocomplete' => 'off',
                    ]) ?>
                    <?= Html::button(Yii::t('app', 'Buscar'), [
                        'class' => 'btn btn-outline-secondary',
                        'type' => 'button',
                        'id' => 'btn-buscar-empleado',
                    ]) ?>
                </div>
                <div class="form-text mb-3"><?= Yii::t('app', 'Buscar por documento; el afectado se guarda como empleado de la novedad.') ?></div>

                <?= $form->field($model, 'profile_id', ['enableClientValidation' => false])
                    ->hiddenInput(['id' => 'novedad-profile_id'])
                    ->label(false) ?>
                <div id="empleado-seleccionado-error" class="alert alert-danger border-0 py-2 px-3 mb-0 d-none" role="alert"></div>
                <div id="empleado-seleccionado" class="form-control-plaintext border rounded px-3 py-2 bg-light small d-none"></div>
                <input type="hidden" id="empleado-cargo-id" value="">
                <div class="form-text"><?= Yii::t('app', 'Nombre y cargo según contrato en la fecha de la novedad.') ?></div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <?= $form->field($ctx, 'novedad_tipo_id')->dropDownList([], [
                'prompt' => Yii::t('app', 'Seleccione...'),
                'id' => 'solicitudctx-novedad_tipo_id',
                'class' => 'form-select',
            ])->hint(Yii::t('app', 'Solo agrupadores para los que tiene permiso de creación.')) ?>
        </div>
    </div>

    <?php if (!empty($horasTipoId)): ?>
        <div class="alert alert-info small mb-3 py-2" role="status">
            <?= Yii::t(
                'app',
                'Para solicitar horas (intervalo hora inicio y fin, con troceo en servidor), elija en «Tipo / agrupador» la opción de novedades de tipo horas. Luego complete fecha, empleado y las horas que se muestran debajo.'
            ) ?>
        </div>
    <?php endif; ?>

    <div id="bloque-concepto" class="mb-3">
        <?= $form->field($model, 'concepto_id', ['enableClientValidation' => false])->dropDownList([], [
            'prompt' => Yii::t('app', 'Seleccione...'),
            'id' => 'novedad-concepto_id',
            'class' => 'form-select',
        ])->hint(Yii::t('app', 'Filtrado por tenant, contrato/cargo y conceptos habilitados para su organización.')) ?>
    </div>

    <div id="bloque-campos-dinamicos" class="row g-3 mb-3"></div>

    <?= $form->field($model, 'fecha_novedad')->textInput(['type' => 'date', 'id' => 'novedad-fecha_novedad']) ?>

    <div id="bloque-horas" class="mb-3" style="display:none;">
        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'hora_inicio')->textInput([
                    'type' => 'time',
                    'step' => 60,
                    'id' => 'novedad-hora_inicio',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'hora_fin')->textInput([
                    'type' => 'time',
                    'step' => 60,
                    'id' => 'novedad-hora_fin',
                ]) ?>
            </div>
            <div class="col-12">
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Tipo Horas: sin cruce de medianoche en el formulario; el servidor trocea el intervalo (recargos, etc.).') ?></p>
            </div>
        </div>
        <div id="bloque-auxilio" class="form-check mt-3 mb-0" style="display:none;">
            <?= Html::checkbox('auxilio_movilizacion', false, [
                'class' => 'form-check-input',
                'id' => 'auxilio_movilizacion',
                'value' => '1',
            ]) ?>
            <label class="form-check-label" for="auxilio_movilizacion">
                <?= Yii::t('app', 'Solicitar auxilio de movilización (importe fijo según configuración, si el cargo aplica a clases grupales)') ?>
            </label>
        </div>
    </div>

    <div class="mt-4">
        <?= $form->field($model, 'descripcion')->textarea(['rows' => 3]) ?>
    </div>

    <?= $form->field($model, 'datos')->hiddenInput(['id' => 'novedad-datos-json', 'value' => $model->datos ?: '{}'])->label(false) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(Yii::t('app', 'Enviar solicitud'), [
            'class' => 'btn btn-primary',
            'disabled' => $sinEmpresaCliente,
        ]) ?>
        <?= Html::a(Yii::t('app', 'Cancelar'), ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
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

  function escapeHtml(s) {
    if (s == null || s === '') { return ''; }
    return String(s).replace(/[&<>"']/g, function (ch) {
      return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[ch];
    });
  }

  function ocultarPanelesEmpleado() {
    $('#empleado-seleccionado').addClass('d-none').empty();
    $('#empleado-seleccionado-error').addClass('d-none').empty();
  }

  function setEmpleadoNoEncontrado() {
    var msg = $form.attr('data-msg-empleado-no-encontrado') || '';
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
    $('#empleado-seleccionado').removeClass('d-none').html(line1 + line2);
  }

  function buscarEmpleadoPorDocumento(done) {
    var doc = ($('#buscar-num-doc').val() || '').trim();
    var fecha = $('#novedad-fecha_novedad').val() || '';
    if (doc.length < 3) {
      ocultarPanelesEmpleado();
      $('#novedad-profile_id').val('');
      $('#empleado-cargo-id').val('');
      refreshAuxilioCheckbox();
      loadConceptos($('#solicitudctx-novedad_tipo_id').val(), done);
      return;
    }
    $.getJSON(ajax.buscarEmpleado, { num_documento: doc, fecha_novedad: fecha }, function (data) {
      var results = (data && data.results) ? data.results : [];
      if (!results.length) {
        setEmpleadoNoEncontrado();
        $('#novedad-profile_id').val('');
        $('#empleado-cargo-id').val('');
        refreshAuxilioCheckbox();
        loadConceptos($('#solicitudctx-novedad_tipo_id').val(), done);
        return;
      }
      var r = results[0];
      $('#novedad-profile_id').val(r.id);
      setEmpleadoPanel(r);
      $('#empleado-cargo-id').val(r.cargo_id != null ? r.cargo_id : '');
      refreshAuxilioCheckbox();
      loadConceptos($('#solicitudctx-novedad_tipo_id').val(), done);
    });
  }

  function loadAgrupadores() {
    $.getJSON(ajax.agrupadores, function (rows) {
      var $sel = $('#solicitudctx-novedad_tipo_id');
      var v = $sel.val() || (formState.novedad_tipo_id != null ? String(formState.novedad_tipo_id) : '');
      $sel.empty().append($('<option/>').val('').text('…'));
      $.each(rows, function (_, r) {
        $sel.append($('<option/>').val(r.id).text(r.nombre).attr('data-codigo', r.codigo || ''));
      });
      if (v) { $sel.val(v); }
      var id = $sel.val();
      toggleModoHoras(id);
      restaurarEmpleadoPostCarga();
    });
  }

  function loadCiudades(done) {
    $.getJSON(ajax.ciudades, function (rows) {
      var $sel = $('#solicitudctx-ciudad_id');
      var v = $sel.val() || (formState.ciudad_id != null ? String(formState.ciudad_id) : '');
      $sel.empty().append($('<option/>').val('').text('…'));
      $.each(rows, function (_, r) {
        $sel.append($('<option/>').val(r.id).text(r.nombre));
      });
      if (v) { $sel.val(v); }
      if (typeof done === 'function') { done(); }
    });
  }

  function loadConceptos(tipoId, done) {
    var $c = $('#novedad-concepto_id');
    if (!tipoId) {
      $c.empty().append($('<option/>').val('').text('…'));
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
      $c.empty().append($('<option/>').val('').text('…'));
      $.each(rows, function (_, r) {
        $c.append($('<option/>').val(r.id).text(r.nombre));
      });
      if (v) { $c.val(v); }
      if (typeof done === 'function') { done(); }
    });
  }

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
        $wrap.append($('<label class="form-label"/>').text(f.label + (f.requerido ? ' *' : '')));
        var $field;
        if (f.opciones && f.opciones.length) {
          $field = $('<select class="form-select"/>').attr('data-ncampo', f.campo_id);
          $field.append($('<option value=""/>').text('…'));
          $.each(f.opciones, function (_, o) {
            $field.append($('<option/>').val(o.valor).text(o.etiqueta || o.valor));
          });
        } else {
          $field = $('<input class="form-control"/>').attr({
            type: inputTypeForDato(f.tipo_dato),
            'data-ncampo': f.campo_id
          });
        }
        if (f.requerido) {
          $field.prop('required', true);
        }
        var pv = persisted[f.campo_id];
        if (pv !== undefined && pv !== null && String(pv) !== '') {
          $field.val(String(pv));
        }
        $wrap.append($field);
        $blk.append($wrap);
      });
    });
  }

  function loadSedes(ciudadId, done) {
    var base = $form.attr('data-sedes-por-ciudad-base') || '';
    var $s = $('#solicitudctx-sede_id');
    $s.empty().append($('<option/>').val('').text('…'));
    if (!ciudadId) {
      if (typeof done === 'function') { done(); }
      return;
    }
    $.getJSON(base + encodeURIComponent(ciudadId), function (rows) {
      $.each(rows, function (_, r) {
        $s.append($('<option/>').val(r.id).text(r.nombre));
      });
      var sv = formState.sede_id != null ? String(formState.sede_id) : '';
      if (sv) { $s.val(sv); }
      if (typeof done === 'function') { done(); }
    });
  }

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
      $('#novedad-profile_id').val(String(formState.profile_id));
      if (formState.cargo_id != null) {
        $('#empleado-cargo-id').val(String(formState.cargo_id));
      }
      refreshAuxilioCheckbox();
      loadConceptos($('#solicitudctx-novedad_tipo_id').val(), function () {
        if (formState.auxilio_movilizacion) {
          $('#auxilio_movilizacion').prop('checked', true);
        }
        refreshAuxilioCheckbox();
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

  $('#solicitudctx-novedad_tipo_id').on('change', function () {
    var id = $(this).val();
    toggleModoHoras(id);
    loadConceptos(id, null);
    refreshAuxilioCheckbox();
  });

  $('#solicitudctx-ciudad_id').on('change', function () {
    loadSedes($(this).val(), null);
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
      loadConceptos($('#solicitudctx-novedad_tipo_id').val(), null);
    }
  });

  $form.on('submit', function (e) {
    var tipoId = $('#solicitudctx-novedad_tipo_id').val();
    if (horasTipoId !== null && String(tipoId) === String(horasTipoId)) {
      var hi = $('#novedad-hora_inicio').val();
      var hf = $('#novedad-hora_fin').val();
      if (hi && hf && hf <= hi) {
        alert(msgHoras);
        e.preventDefault();
        return false;
      }
    }
    mergeDatosDinamicos();
  });

  loadCiudades(function () {
    var cid = $('#solicitudctx-ciudad_id').val();
    if (cid) {
      loadSedes(cid, loadAgrupadores);
    } else {
      loadAgrupadores();
    }
  });
})(jQuery);
JS;
$js = str_replace(
    ['__AJAX__', '__HORAS__', '__FORM__'],
    [$ajaxJson, $horasTipoIdJs, (string) $formId],
    $jsTemplate
);
$this->registerJs($js);
?>
