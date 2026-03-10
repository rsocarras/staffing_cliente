<?php

use yii\helpers\Html;

/** @var array $rows */
/** @var string $tableId */
?>

<div class="table-responsive">
    <table class="table table-nowrap bg-white border mb-0" id="<?= Html::encode($tableId) ?>">
        <thead>
            <tr>
                <th>Sede</th>
                <th>Tipo sede</th>
                <th>Área</th>
                <th>Subárea</th>
                <th>Cargo</th>
                <th class="text-end">Planta</th>
                <th class="text-end">Ocupados</th>
                <th class="text-end">Vacantes</th>
                <th class="text-end">Activos</th>
                <th class="text-end">Incapacidad</th>
                <th class="text-end">Licencia</th>
                <th class="text-end">Suspendidos</th>
                <th class="text-end">% cobertura</th>
                <th>Estado</th>
                <th>Extensión</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= Html::encode($row['sede_nombre']) ?></td>
                <td><?= Html::encode(ucfirst($row['tipo_sede'])) ?></td>
                <td><?= Html::encode($row['area_nombre']) ?></td>
                <td><?= Html::encode($row['sub_area_nombre']) ?></td>
                <td><?= Html::encode($row['cargo_nombre']) ?></td>
                <td class="text-end"><?= Yii::$app->formatter->asDecimal($row['planta_autorizada'], 2) ?></td>
                <td class="text-end"><?= Yii::$app->formatter->asDecimal($row['ocupados'], 2) ?></td>
                <td class="text-end <?= $row['vacantes'] < 0 ? 'text-danger fw-semibold' : '' ?>">
                    <?= Yii::$app->formatter->asDecimal($row['vacantes'], 2) ?>
                </td>
                <td class="text-end"><?= Yii::$app->formatter->asDecimal($row['activos_normales'], 2) ?></td>
                <td class="text-end"><span class="badge badge-soft-info"><?= Yii::$app->formatter->asDecimal($row['incapacidad'], 2) ?></span></td>
                <td class="text-end"><span class="badge badge-soft-warning"><?= Yii::$app->formatter->asDecimal($row['licencia'], 2) ?></span></td>
                <td class="text-end"><span class="badge badge-soft-danger"><?= Yii::$app->formatter->asDecimal($row['suspendidos'], 2) ?></span></td>
                <td class="text-end"><?= Yii::$app->formatter->asDecimal($row['cobertura'], 2) ?>%</td>
                <td>
                    <span class="badge badge-soft-<?= Html::encode($row['badge_class']) ?>">
                        <?= Html::encode(ucfirst($row['estado_visual'])) ?>
                    </span>
                </td>
                <td>
                    <?php if ($row['can_create_requisicion']): ?>
                        <span class="badge bg-light text-dark">TODO Crear requisición</span>
                    <?php else: ?>
                        <span class="text-muted">Sin acción</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
