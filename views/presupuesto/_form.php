<?php

use Yii;
use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\PresupuestoConceptoDia;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Presupuesto $model */
/** @var string $matrixJson */
/** @var int[] $selectedConceptos */
/** @var array<int, string> $conceptosCatalogo */

$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
$empresaId = is_numeric($tenantEmpresaId) ? (int) $tenantEmpresaId : null;

$sedes = $empresaId
    ? LocationSedes::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all()
    : [];
$empresaClientes = EmpresaCliente::getActivos($empresaId);

$dias = PresupuestoConceptoDia::optsDiaSemana();

$formId = 'form-presupuesto';
$matrixJson = $matrixJson ?? '{}';
$matrixDecoded = [];
if (is_string($matrixJson) && $matrixJson !== '') {
    $tmp = json_decode($matrixJson, true);
    if (is_array($tmp)) {
        $matrixDecoded = $tmp;
    }
}
$matrizColspan = 1 + count($dias);
?>

<?php $form = ActiveForm::begin([
    'id' => $formId,
    'options' => ['class' => 'presupuesto-form'],
]); ?>

<div class="row g-3">
    <div class="col-md-6">
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'fecha_inicio_vigencia')->input('date') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'fecha_fin_vigencia')->input('date') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'location_sede_id')->dropDownList(
            \yii\helpers\ArrayHelper::map($sedes, 'id', 'nombre'),
            ['prompt' => 'Seleccione sede…']
        ) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'empresa_cliente_id')->dropDownList(
            \yii\helpers\ArrayHelper::map($empresaClientes, 'id', 'nombre'),
            ['prompt' => '— Opcional —']
        ) ?>
    </div>
    <div class="col-12">
        <?= $form->field($model, 'observacion')->textarea(['rows' => 3]) ?>
    </div>
</div>

<?php if (empty($conceptosCatalogo)): ?>
    <div class="alert alert-info mb-2">
        No hay etiquetas en el catálogo para su empresa. Puede guardar el borrador con la cabecera y añadirlas cuando existan.
        Si en BD existe <code>novedad_tipo.empresa_id</code>, el listado se filtra por empresa; si no, deberían mostrarse todos los conceptos activos del sistema.
    </div>
<?php endif; ?>

<div class="mb-2 presupuesto-conceptos-tags">
    <label class="form-label" for="presupuesto-conceptos">Etiquetas / líneas de horas</label>
    <select name="conceptos[]" id="presupuesto-conceptos" multiple="multiple" class="form-select presupuesto-conceptos-select" style="width:100%">
        <?php foreach ($conceptosCatalogo as $cid => $nombre): ?>
            <option value="<?= (int) $cid ?>" <?= in_array((int) $cid, $selectedConceptos, true) ? 'selected' : '' ?>>
                <?= Html::encode($nombre) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="form-text">
        Añada una o varias como etiquetas (búsqueda y clic; puede dejar varias abiertas).
        Al guardar borrador no se exigen horas; al <strong>enviar a aprobación</strong> sí debe haber al menos una etiqueta y cada línea con algún día &gt; 0 h.
    </div>
</div>

<div class="table-responsive mb-3">
    <table class="table table-bordered table-sm bg-white" id="presupuesto-matriz">
        <thead>
            <tr>
                <th>Concepto</th>
                <?php foreach ($dias as $num => $label): ?>
                    <th class="text-center"><?= Html::encode($label) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody id="presupuesto-matriz-tbody">
        <?php if (empty($selectedConceptos)): ?>
            <tr class="presupuesto-matriz-hint">
                <td colspan="<?= $matrizColspan ?>" class="text-muted py-3 px-2">
                    Elija una o más etiquetas arriba; aquí aparecerán las filas con un input de horas por día.
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($selectedConceptos as $cidRow): ?>
                <?php
                $cidRow = (int) $cidRow;
                $nomFila = $conceptosCatalogo[$cidRow] ?? ('#' . $cidRow);
                ?>
                <tr>
                    <td><?= Html::encode($nomFila) ?></td>
                    <?php foreach ($dias as $dNum => $dLabel): ?>
                        <?php
                        $rowM = $matrixDecoded[(string) $cidRow] ?? $matrixDecoded[$cidRow] ?? [];
                        $cell = is_array($rowM) ? ($rowM[(string) $dNum] ?? $rowM[$dNum] ?? 0) : 0;
                        $cell = is_numeric($cell) ? (float) $cell : 0;
                        ?>
                        <td class="text-center">
                            <?= Html::input('number', 'matrix[' . $cidRow . '][' . $dNum . ']', $cell, [
                                'class' => 'form-control form-control-sm',
                                'step' => '0.25',
                                'min' => '0',
                                'max' => '24',
                            ]) ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="form-group">
    <?= Html::submitButton('Guardar borrador', ['class' => 'btn btn-primary', 'name' => 'save', 'value' => '1']) ?>
    <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php
$diasJs = Json::encode(array_keys($dias));
$catalogJs = Json::encode($conceptosCatalogo);
$matrixInit = $matrixJson;
// nowdoc: evita que PHP interprete $ de jQuery como variables (rompía .select2()).
$js = <<<'JS'
(function ($) {
  var dias = __DIAS__;
  var catalog = __CATALOG__;
  var matrixState = __MATRIX__;
  if (typeof matrixState !== 'object' || matrixState === null) { matrixState = {}; }

  /** Select2 / jQuery a veces devuelven un string si solo hay una opción; forEach falla y la matriz no se pinta. */
  function selectedConceptIds($multi) {
    var v = $multi.val();
    if (v == null || v === '') {
      return [];
    }
    if (Array.isArray(v)) {
      return v.map(function (x) { return String(x); });
    }
    return [String(v)];
  }

  function ensureConceptMatrix(cid) {
    cid = String(cid);
    if (!matrixState[cid]) {
      matrixState[cid] = {};
      dias.forEach(function (d) { matrixState[cid][d] = 0; });
    }
  }

  function renderMatrix() {
    var $tb = $('#presupuesto-matriz-tbody');
    if (!$tb.length) {
      return;
    }
    $tb.empty();
    var selected = selectedConceptIds($('#presupuesto-conceptos'));
    if (!selected.length) {
      var colspan = 1 + (dias && dias.length ? dias.length : 7);
      $tb.append(
        $('<tr>').addClass('presupuesto-matriz-hint').append(
          $('<td>').attr('colspan', colspan).addClass('text-muted py-3 px-2')
            .text('Elija una o más etiquetas arriba; aquí aparecerán las filas con un input de horas por día.')
        )
      );
      return;
    }
    selected.forEach(function (cid) {
      ensureConceptMatrix(cid);
      var name = catalog[cid] != null ? catalog[cid] : ('#' + cid);
      var tr = $('<tr>');
      tr.append($('<td>').text(name));
      dias.forEach(function (d) {
        var v = matrixState[cid][d] != null ? matrixState[cid][d] : 0;
        var inp = $('<input>', {
          type: 'number',
          step: '0.25',
          min: '0',
          max: '24',
          class: 'form-control form-control-sm',
          name: 'matrix[' + cid + '][' + d + ']',
          value: v
        });
        inp.on('input', function () {
          matrixState[cid][d] = $(this).val();
        });
        tr.append($('<td>').addClass('text-center').append(inp));
      });
      $tb.append(tr);
    });
  }

  var $sel = $('#presupuesto-conceptos');
  var $form = $('#__FORM_ID__');

  $sel.off('change.presupuestoMatriz').on('change.presupuestoMatriz', function () {
    var selected = selectedConceptIds($(this));
    selected.forEach(function (cid) { ensureConceptMatrix(cid); });
    Object.keys(matrixState).forEach(function (k) {
      if (selected.indexOf(k) === -1) { delete matrixState[k]; }
    });
    renderMatrix();
  });

  $form.off('submit.presupuestoMatriz').on('submit.presupuestoMatriz', function () {
    $('#presupuesto-matriz-tbody input[type="number"]').each(function () {
      var $i = $(this);
      var v = $i.val();
      if (v === '' || v === null || isNaN(parseFloat(v))) {
        $i.val('0');
      }
    });
  });

  if ($sel.data('select2')) {
    try {
      $sel.select2('destroy');
    } catch (e1) { /* ignore */ }
  }
  if (typeof $.fn.select2 === 'function') {
    try {
      $sel.select2({
        width: '100%',
        placeholder: 'Busque y pulse para añadir etiquetas…',
        allowClear: true,
        closeOnSelect: false,
        dropdownParent: $(document.body),
        language: {
          noResults: function () { return 'Sin coincidencias'; },
          searching: function () { return 'Buscando…'; }
        }
      });
    } catch (e2) {
      console.error('Presupuesto: error al iniciar Select2', e2);
    }
  } else {
    console.warn('Presupuesto: Select2 no está disponible; use el listado múltiple nativo del navegador.');
  }

  $sel.trigger('change');
})(jQuery);
JS;
$js = str_replace(
    ['__DIAS__', '__CATALOG__', '__MATRIX__', '__FORM_ID__'],
    [$diasJs, $catalogJs, $matrixInit, Html::encode($formId)],
    $js
);
$this->registerCss(<<<'CSS'
.presupuesto-conceptos-tags .select2-container--default .select2-selection--multiple {
  min-height: 2.75rem;
  border-radius: 0.375rem;
}
.presupuesto-conceptos-tags .select2-container--default .select2-selection--multiple .select2-selection__choice {
  border-radius: 1rem;
  margin-top: 0.25rem;
}
CSS
);
$this->registerJs($js, \yii\web\View::POS_READY, 'presupuesto-matriz-form');
?>

