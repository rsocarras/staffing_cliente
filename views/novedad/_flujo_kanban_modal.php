<?php

use app\models\Novedad;
use app\models\NovedadStep;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */
/** @var string|null $flujoNombre */
/** @var app\models\NovedadStep[] $steps */
?>

<?php if (!Novedad::hasNovedadFlujoIdColumn() || !$model->getAttribute('novedad_flujo_id')): ?>
    <div class="alert alert-info border-0 mb-0">
        Esta novedad no tiene un flujo asignado. Podés asignarlo al editar la novedad.
    </div>
<?php elseif ($steps === []): ?>
    <div class="alert alert-warning border-0 mb-0">
        No hay pasos en este flujo. Configurá los pasos en <strong>Configuración → Flujos de novedad</strong>.
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm mb-0">
        <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
            <h6 class="mb-0 fw-semibold">
                <i class="ti ti-layout-kanban me-2 text-primary"></i>
                <?= Html::encode('Flujo de la novedad') ?>
            </h6>
            <?php if ($flujoNombre): ?>
                <p class="text-muted small mb-0 mt-1"><?= Html::encode($flujoNombre) ?></p>
            <?php endif; ?>
            <p id="novedad-flujo-kanban-hint" class="text-muted small mb-0 mt-2">Cada columna es un paso del flujo. En la tarjeta elegí <strong>Avanzar</strong> o <strong>Volver</strong>; el color y la etiqueta corresponden al <strong>estado del paso</strong> (configuración del flujo).</p>
            <div class="d-flex flex-wrap align-items-center gap-2 mt-2 pt-2 border-top border-light">
                <span class="text-muted small me-1">Estados del paso:</span>
                <?php
                $legend = [
                    NovedadStep::ESTADO_PENDIENTE => ['bg-warning text-dark', 'Pendiente'],
                    NovedadStep::ESTADO_EN_CURSO => ['bg-primary', 'En curso'],
                    NovedadStep::ESTADO_COMPLETADO => ['bg-success', 'Completado'],
                    NovedadStep::ESTADO_OMITIDO => ['bg-secondary', 'Omitido'],
                    NovedadStep::ESTADO_DEVUELTO => ['bg-danger', 'Devuelto'],
                ];
                foreach ($legend as $pair) {
                    [$cls, $txt] = $pair;
                    echo '<span class="badge ' . Html::encode($cls) . '">' . Html::encode($txt) . '</span>';
                }
                ?>
            </div>
        </div>
        <div class="card-body pt-2">
            <div id="novedad-flujo-kanban-banner" class="mb-2"></div>
            <div class="novedad-flujo-kanban overflow-auto pb-2">
                <div
                    class="d-flex gap-3 align-items-stretch"
                    id="novedad-flujo-kanban-columns"
                    data-novedad-id="<?= (int) $model->id ?>"
                >
                    <div class="text-muted py-3 small">Cargando tablero…</div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
