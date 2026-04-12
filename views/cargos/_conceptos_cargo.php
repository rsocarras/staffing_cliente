<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var list<array{tipo: \app\models\NovedadTipo, conceptos: list<\app\models\NovedadConcepto>}> $conceptosPorAgrupador
 * @var int[] $selectedIds
 * @var string $formFieldPrefix nombre del modelo en el formulario (p. ej. Cargos)
 * @var string $accordionSuffix sufijo único para ids de acordeón (evitar colisiones en modal)
 */

$selectedSet = array_fill_keys(array_map('intval', $selectedIds), true);
$fieldName = $formFieldPrefix . '[novedadConceptoIds][]';
$suffix = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) ($accordionSuffix ?? 'new'));
$accordionId = 'cargo-conceptos-acc-' . $suffix;
?>
<div class="cargo-conceptos-novedad">
    <h6 class="fw-semibold mb-2"><?= Html::encode(Yii::t('app', 'Conceptos de novedad por cargo')) ?></h6>
    <p class="text-muted small mb-3"><?= Html::encode(Yii::t('app', 'Marque los conceptos aplicables a este cargo, por agrupador. Puede usar «Seleccionar todos» en cada grupo o elegir uno a uno.')) ?></p>

    <?php if ($conceptosPorAgrupador === []): ?>
        <div class="alert alert-light border small mb-0">
            <?= Html::encode(Yii::t('app', 'No hay conceptos habilitados para esta organización o aún no eligió organización.')) ?>
        </div>
    <?php else: ?>
        <div class="accordion" id="<?= Html::encode($accordionId) ?>">
            <?php foreach ($conceptosPorAgrupador as $idx => $grupo): ?>
                <?php
                $tipo = $grupo['tipo'];
                $conceptos = $grupo['conceptos'];
                $tid = (int) $tipo->id;
                $collapseId = $accordionId . '-c-' . $tid;
                $headingId = $accordionId . '-h-' . $tid;
                $allChecked = true;
                foreach ($conceptos as $c) {
                    if (!isset($selectedSet[(int) $c->id])) {
                        $allChecked = false;
                        break;
                    }
                }
                ?>
                <div class="accordion-item border">
                    <h2 class="accordion-header d-flex align-items-stretch p-0 flex-nowrap" id="<?= Html::encode($headingId) ?>">
                        <button
                            class="accordion-button <?= $idx === 0 ? '' : 'collapsed' ?> flex-grow-1 rounded-0 border-0 shadow-none"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#<?= Html::encode($collapseId) ?>"
                            aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>"
                            aria-controls="<?= Html::encode($collapseId) ?>"
                        >
                            <span class="text-start"><?= Html::encode((string) ($tipo->nombre ?? '')) ?></span>
                        </button>
                        <div
                            class="d-flex align-items-center px-2 px-md-3 border-start bg-body-secondary bg-opacity-50 flex-shrink-0 fs-6"
                            onclick="event.stopPropagation();"
                            role="presentation"
                        >
                            <?php /* fs-6: el input usa 1em; dentro de h2 heredaría un tamaño enorme */ ?>
                            <div class="form-check mb-0 d-flex align-items-center gap-1">
                                <input
                                    class="form-check-input js-cargo-concepto-todos"
                                    type="checkbox"
                                    id="<?= Html::encode($collapseId) ?>-todos"
                                    data-tipo-id="<?= $tid ?>"
                                    <?= $allChecked && $conceptos !== [] ? 'checked' : '' ?>
                                    aria-label="<?= Html::encode(Yii::t('app', 'Seleccionar todos en {tipo}', ['tipo' => (string) ($tipo->nombre ?? '')])) ?>"
                                >
                                <label class="form-check-label text-muted mb-0 user-select-none" for="<?= Html::encode($collapseId) ?>-todos"><?= Html::encode(Yii::t('app', 'Todos')) ?></label>
                            </div>
                        </div>
                    </h2>
                    <div id="<?= Html::encode($collapseId) ?>" class="accordion-collapse collapse <?= $idx === 0 ? 'show' : '' ?>" aria-labelledby="<?= Html::encode($headingId) ?>">
                        <div class="accordion-body pt-2">
                            <div class="row g-2">
                                <?php foreach ($conceptos as $c): ?>
                                    <?php $cid = (int) $c->id; ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-check">
                                            <?= Html::checkbox(
                                                $fieldName,
                                                isset($selectedSet[$cid]),
                                                [
                                                    'value' => (string) $cid,
                                                    'class' => 'form-check-input js-cargo-concepto-check',
                                                    'data-tipo-id' => (string) $tid,
                                                    'id' => 'ncc-' . $accordionId . '-' . $cid,
                                                ]
                                            ) ?>
                                            <label class="form-check-label" for="ncc-<?= Html::encode($accordionId) ?>-<?= $cid ?>"><?= Html::encode((string) ($c->nombre ?? '')) ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
