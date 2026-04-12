<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array<string, app\models\NovedadConcepto[]> $agrupados */

$this->title = Yii::t('app', 'Conceptos de novedad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Novedades'), 'url' => Url::to(['/sistema/novedades'])];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            <small class="text-muted"><?= Html::encode(Yii::t('app', 'Conceptos asociados a la empresa, agrupados por tipo.')) ?></small>
        </div>
        <div class="card-body">
            <?php if (empty($agrupados)): ?>
                <div class="alert alert-info mb-0"><?= Html::encode(Yii::t('app', 'No hay conceptos asociados a la empresa actual.')) ?></div>
            <?php else: ?>
                <div class="accordion" id="accordionConceptosAgrupados">
                    <?php $idx = 0; ?>
                    <?php foreach ($agrupados as $grupo => $conceptos): ?>
                        <?php
                        $headingId = 'headingGrupo' . $idx;
                        $collapseId = 'collapseGrupo' . $idx;
                        $isFirst = $idx === 0;
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?= Html::encode($headingId) ?>">
                                <button
                                    class="accordion-button <?= $isFirst ? '' : 'collapsed' ?>"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#<?= Html::encode($collapseId) ?>"
                                    aria-expanded="<?= $isFirst ? 'true' : 'false' ?>"
                                    aria-controls="<?= Html::encode($collapseId) ?>"
                                >
                                    <?= Html::encode($grupo) ?>
                                    <span class="ms-2 text-muted small">(<?= count($conceptos) ?>)</span>
                                </button>
                            </h2>
                            <div
                                id="<?= Html::encode($collapseId) ?>"
                                class="accordion-collapse collapse <?= $isFirst ? 'show' : '' ?>"
                                aria-labelledby="<?= Html::encode($headingId) ?>"
                                data-bs-parent="#accordionConceptosAgrupados"
                            >
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped align-middle mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th style="width: 70px;">#</th>
                                                <th><?= Html::encode(Yii::t('app', 'Concepto')) ?></th>
                                                <th><?= Html::encode(Yii::t('app', 'Código')) ?></th>
                                                <th><?= Html::encode(Yii::t('app', 'Estado')) ?></th>
                                                <th style="width: 180px;"><?= Html::encode(Yii::t('app', 'Acciones')) ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($conceptos as $concepto): ?>
                                                <tr>
                                                    <td><?= Html::encode((string) $concepto->id) ?></td>
                                                    <td><?= Html::encode((string) $concepto->nombre) ?></td>
                                                    <td><?= Html::encode((string) ($concepto->codigo ?? '—')) ?></td>
                                                    <td>
                                                        <?php if ((int) $concepto->activo === 1): ?>
                                                            <span class="badge bg-success-subtle text-success"><?= Html::encode(Yii::t('app', 'Activo')) ?></span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger-subtle text-danger"><?= Html::encode(Yii::t('app', 'Inactivo')) ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?= Html::a(
                                                            Yii::t('app', 'Ver detalle'),
                                                            ['/sistema/novedad-conceptos/view', 'id' => $concepto->id],
                                                            ['class' => 'btn btn-sm btn-outline-primary']
                                                        ) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $idx++; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
