<?php

use app\models\Cargos;
use app\models\NovedadConcepto;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var NovedadConcepto $model */
/** @var Cargos[] $cargos */
/** @var int[] $asignados */
/** @var bool $permiteValorDefecto */
/** @var string $valorPorDefecto */
$permiteValorDefecto = (bool) ($permiteValorDefecto ?? false);
$valorPorDefecto = (string) ($valorPorDefecto ?? '');

$this->title = Yii::t('app', 'Detalle de concepto: {nombre}', ['nombre' => $model->nombre]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Novedades'), 'url' => Url::to(['/sistema/novedades'])];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conceptos'), 'url' => Url::to(['/sistema/novedad-conceptos'])];
$this->params['breadcrumbs'][] = $model->nombre;
?>

<div class="container-fluid">
    <style>
        .concepto-cargo-item {
            border: 1px solid var(--bs-border-color);
            border-radius: .5rem;
            padding: .65rem .75rem;
            min-height: 74px;
        }
        .concepto-cargo-item .form-check-input {
            margin-top: .2rem;
            width: 1.1rem;
            height: 1.1rem;
            flex: 0 0 auto;
        }
        .concepto-cargo-item .cargo-nombre {
            display: block;
            font-weight: 500;
            line-height: 1.2;
            word-break: break-word;
        }
    </style>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Html::encode((string) Yii::$app->session->getFlash('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= Html::encode((string) Yii::$app->session->getFlash('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= Html::encode($model->nombre) ?></h5>
            <?= Html::a(Yii::t('app', 'Volver'), ['/sistema/novedad-conceptos'], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <small class="text-muted d-block"><?= Html::encode(Yii::t('app', 'ID')) ?></small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block"><?= Html::encode(Yii::t('app', 'Agrupador')) ?></small>
                    <span class="fw-medium"><?= Html::encode((string) ($model->novedadTipo->nombre ?? '—')) ?></span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block"><?= Html::encode(Yii::t('app', 'Código')) ?></small>
                    <span class="fw-medium"><?= Html::encode((string) ($model->codigo ?? '—')) ?></span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block"><?= Html::encode(Yii::t('app', 'Estado')) ?></small>
                    <?php if ((int) $model->activo === 1): ?>
                        <span class="badge bg-success-subtle text-success"><?= Html::encode(Yii::t('app', 'Activo')) ?></span>
                    <?php else: ?>
                        <span class="badge bg-danger-subtle text-danger"><?= Html::encode(Yii::t('app', 'Inactivo')) ?></span>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block"><?= Html::encode(Yii::t('app', 'Descripción')) ?></small>
                    <div class="border rounded p-2 bg-light small">
                        <?= $model->descripcion ? nl2br(Html::encode((string) $model->descripcion)) : Html::encode('—') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h6 class="mb-0"><?= Html::encode(Yii::t('app', 'Asignación por cargos')) ?></h6>
            <small class="text-muted"><?= Html::encode(Yii::t('app', 'Selecciona los cargos de la empresa que pueden usar este concepto.')) ?></small>
        </div>
        <div class="card-body">
            <?php if (empty($cargos) && !$permiteValorDefecto): ?>
                <div class="alert alert-warning mb-0"><?= Html::encode(Yii::t('app', 'No hay cargos disponibles para la empresa actual.')) ?></div>
            <?php elseif (empty($cargos) && $permiteValorDefecto): ?>
                <form method="post">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Html::encode(Yii::$app->request->csrfToken) ?>">
                    <div class="mb-3">
                        <label class="form-label fw-medium" for="valor-por-defecto-pe"><?= Html::encode(Yii::t('app', 'Valor por defecto')) ?></label>
                        <input
                            id="valor-por-defecto-pe"
                            type="number"
                            name="valor_por_defecto"
                            class="form-control"
                            style="max-width: 14rem;"
                            step="0.01"
                            min="0"
                            value="<?= Html::encode($valorPorDefecto) ?>"
                            placeholder="<?= Html::encode(Yii::t('app', 'Opcional')) ?>"
                        >
                        <small class="text-muted d-block mt-1">
                            <?= Html::encode(Yii::t(
                                'app',
                                'Monto sugerido al crear la solicitud; el empleado puede cambiarlo. Solo aplica a conceptos extralegales PE_*.'
                            )) ?>
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <?= Html::encode(Yii::t('app', 'Guardar')) ?>
                    </button>
                </form>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Html::encode(Yii::$app->request->csrfToken) ?>">
                    <?php if ($permiteValorDefecto): ?>
                        <div class="mb-4 pb-3 border-bottom">
                            <label class="form-label fw-medium" for="valor-por-defecto-pe"><?= Html::encode(Yii::t('app', 'Valor por defecto')) ?></label>
                            <input
                                id="valor-por-defecto-pe"
                                type="number"
                                name="valor_por_defecto"
                                class="form-control"
                                style="max-width: 14rem;"
                                step="0.01"
                                min="0"
                                value="<?= Html::encode($valorPorDefecto) ?>"
                                placeholder="<?= Html::encode(Yii::t('app', 'Opcional')) ?>"
                            >
                            <small class="text-muted d-block mt-1">
                                <?= Html::encode(Yii::t(
                                    'app',
                                    'Monto sugerido al crear la solicitud; el empleado puede cambiarlo. Igual que en la configuración del administrador para conceptos PE_*.'
                                )) ?>
                            </small>
                        </div>
                    <?php endif; ?>
                    <div class="row g-2">
                        <?php foreach ($cargos as $cargo): ?>
                            <div class="col-md-4 col-sm-6">
                                <label class="d-flex align-items-start gap-2 w-100 concepto-cargo-item">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="cargo_ids[]"
                                        value="<?= Html::encode((string) $cargo->id) ?>"
                                        <?= in_array((int) $cargo->id, $asignados, true) ? 'checked' : '' ?>
                                    >
                                    <span class="flex-grow-1">
                                        <span class="cargo-nombre"><?= Html::encode($cargo->nombre) ?></span>
                                        <?php if (!empty($cargo->codigo)): ?>
                                            <small class="text-muted d-block mt-1"><?= Html::encode($cargo->codigo) ?></small>
                                        <?php endif; ?>
                                    </span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <?= Html::encode(Yii::t('app', 'Guardar asignación')) ?>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
