<?php

use app\models\LocationSedeCargoTarifa;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array<int, string> $cargoOptions */
/** @var array<int, array<string, mixed>> $cargoTarifaValues */

$cargoOptions = $cargoOptions ?? [];
$cargoTarifaValues = $cargoTarifaValues ?? [];
$labels = (new LocationSedeCargoTarifa())->attributeLabels();
$fields = LocationSedeCargoTarifa::tariffColumnNames();
$labelMap = [];
foreach ($fields as $f) {
    $labelMap[$f] = (string) ($labels[$f] ?? $f);
}
$tarifaCargoSelectId = 'location-sede-tarifa-cargo-select';
$firstCargoId = $cargoOptions !== [] ? (int) array_key_first($cargoOptions) : 0;
$fmtTarifaValor = static function ($v): string {
    if ($v === null || $v === '') {
        return '';
    }

    return Yii::$app->formatter->asDecimal(round((float) $v, 2), 2);
};

$this->registerCss(<<<'CSS'
/* Misma fila visual: etiquetas multilínea no desalinean los inputs */
.location-sedes-tarifas-form .location-sede-tarifa-widget .tarifa-monto-row {
    align-items: stretch;
}
.location-sedes-tarifas-form .location-sede-tarifa-widget .tarifa-monto-field {
    display: flex;
    flex-direction: column;
    flex: 0 0 auto;
    width: 12.5rem;
    max-width: calc(50% - 0.5rem);
}
@media (min-width: 768px) {
    .location-sedes-tarifas-form .location-sede-tarifa-widget .tarifa-monto-field {
        max-width: 12.5rem;
    }
}
.location-sedes-tarifas-form .location-sede-tarifa-widget .tarifa-monto-field .form-label {
    line-height: 1.25;
}
.location-sedes-tarifas-form .location-sede-tarifa-widget .tarifa-monto-field .js-tarifa-moneda {
    margin-top: auto;
    width: 100%;
}
CSS);
?>

<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-secondary text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-currency-dollar fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Tarifas por cargo</h6>
            <p class="text-muted small mb-0">Valores por combinación sede y cargo (contratos por horas).</p>
        </div>
    </div>
    <?php if ($cargoOptions === []): ?>
        <div class="alert alert-info mb-0"><?= Html::encode(Yii::t('app', 'No hay cargos activos en la organización.')) ?></div>
    <?php else: ?>
        <div class="location-sede-tarifa-widget">
        <div class="mb-3">
            <label class="form-label fw-semibold mb-1" for="<?= Html::encode($tarifaCargoSelectId) ?>"><?= Html::encode(Yii::t('app', 'Cargo')) ?></label>
            <?= Html::dropDownList(
                '_tarifa_cargo_ui',
                (string) $firstCargoId,
                $cargoOptions,
                [
                    'id' => $tarifaCargoSelectId,
                    'class' => 'form-select',
                ]
            ) ?>
            <p class="text-muted small mb-0 mt-2"><?= Html::encode(Yii::t('app', 'Elija un cargo para ver y editar sus tarifas en esta sede.')) ?></p>
        </div>
        <div class="cargo-tarifa-panels">
            <?php foreach ($cargoOptions as $cargoId => $cargoNombre): ?>
                <?php
                $cid = (int) $cargoId;
                $vals = $cargoTarifaValues[$cid] ?? $cargoTarifaValues[$cargoId] ?? [];
                $isActive = $cid === $firstCargoId;
                ?>
                <div class="cargo-tarifa-panel border rounded-3 p-3 bg-white <?= $isActive ? '' : 'd-none' ?>" data-cargo-id="<?= $cid ?>" role="region" aria-labelledby="<?= Html::encode($tarifaCargoSelectId) ?>">
                    <div class="fw-semibold mb-3 text-body"><?= Html::encode((string) $cargoNombre) ?></div>
                    <div class="d-flex flex-wrap gap-3 align-items-stretch tarifa-monto-row">
                        <?php foreach ($fields as $field): ?>
                            <?php $v = $vals[$field] ?? ''; ?>
                            <div class="tarifa-monto-field">
                                <label class="form-label small mb-1 d-block"><?= Html::encode($labelMap[$field]) ?></label>
                                <input type="text" inputmode="decimal" autocomplete="off"
                                    class="form-control form-control-sm text-end js-tarifa-moneda"
                                    name="CargoTarifa[<?= $cid ?>][<?= Html::encode($field) ?>]"
                                    value="<?= Html::encode($fmtTarifaValor($v)) ?>"
                                    placeholder="<?= Html::encode(Yii::t('app', '0,00')) ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
        <?php
        $sid = json_encode($tarifaCargoSelectId);
        $this->registerJs(<<<JS
(function () {
  var sel = document.getElementById({$sid});
  if (!sel) { return; }
  var root = sel.closest('.location-sede-tarifa-widget');
  if (!root) { return; }
  var panels = root.querySelectorAll('.cargo-tarifa-panel');
  function showCargo(id) {
    var s = String(id);
    panels.forEach(function (p) {
      var match = p.getAttribute('data-cargo-id') === s;
      p.classList.toggle('d-none', !match);
    });
  }
  sel.addEventListener('change', function () { showCargo(this.value); });

  function stripMoneda(val) {
    var s = String(val || '').trim();
    if (s === '') { return ''; }
    if (s.indexOf(',') !== -1) {
      return s.replace(/\./g, '').replace(',', '.').replace(/[^\d.]/g, '');
    }
    if (/^\d{1,3}(\.\d{3})+$/.test(s)) {
      return s.replace(/\./g, '');
    }
    return s.replace(/[^\d.]/g, '');
  }
  function formatMoneda(val) {
    var s = stripMoneda(val);
    if (s === '' || s === '.') { return ''; }
    var n = parseFloat(s);
    if (isNaN(n) || n < 0) { return String(val || '').trim(); }
    return new Intl.NumberFormat('es-CO', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(n);
  }

  root.querySelectorAll('.js-tarifa-moneda').forEach(function (el) {
    if (el.value) { el.value = formatMoneda(el.value); }
    el.addEventListener('blur', function () { el.value = formatMoneda(el.value); });
    el.addEventListener('focus', function () {
      el.value = stripMoneda(el.value);
    });
  });

  var form = root.closest('form');
  if (form) {
    form.addEventListener('submit', function () {
      root.querySelectorAll('.js-tarifa-moneda').forEach(function (el) {
        var s = stripMoneda(el.value);
        el.value = s === '' ? '' : s;
      });
    });
  }
})();
JS
        );
        ?>
    <?php endif; ?>
</div>
