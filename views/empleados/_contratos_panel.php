<?php

use app\models\Contrato;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var Contrato[] $contratos */
/** @var Contrato $contratoNew */
/** @var array $contratoOptions */
/** @var bool $canManageContratos */
/** @var int $userId */
/** @var bool $readOnlyView Si true (p. ej. modal Ver colaborador), no se muestra el formulario de alta ni acciones de edición. */

$readOnlyView = !empty($readOnlyView);
$createContratoUrl = Url::to(['/usuarios/create-user-contrato', 'id' => $userId]);
$mapTipos = ArrayHelper::map($contratoOptions['contratoTipos'] ?? [], 'id', 'nombre');
$mapSedes = ArrayHelper::map($contratoOptions['sedes'] ?? [], 'id', 'nombre');
$mapAreas = ArrayHelper::map($contratoOptions['areas'] ?? [], 'id', 'nombre');
$mapSub = ArrayHelper::map($contratoOptions['subAreas'] ?? [], 'id', 'nombre');
$mapCargos = ArrayHelper::map($contratoOptions['cargos'] ?? [], 'id', 'nombre');
$mapEstados = $contratoOptions['estados'] ?? [];
?>

<div class="rounded-3 border border-dashed p-0 mb-3 bg-light overflow-hidden">
    <div class="px-3 py-2 border-bottom bg-white">
        <h6 class="fw-semibold mb-0"><?= Html::encode(\Yii::t('app', 'Contratos registrados')) ?></h6>
        <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Contratos de este colaborador en la empresa actual.')) ?></p>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Área</th>
                    <th>Cargo</th>
                    <th>Estado</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contratos as $c): ?>
                    <tr>
                        <td><?= (int) $c->id ?></td>
                        <td><?= Html::encode($c->contratoTipo->nombre ?? ('#' . $c->contrato_tipo_id)) ?></td>
                        <td><?= Html::encode($c->area->nombre ?? ('#' . $c->area_id)) ?></td>
                        <td><?= Html::encode($c->cargo->nombre ?? ('#' . $c->cargo_id)) ?></td>
                        <td><?= Html::encode($c->getDisplayEstado()) ?></td>
                        <td><?= Html::encode($c->fecha_inicio) ?></td>
                        <td><?= Html::encode($c->fecha_fin ?? '—') ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($contratos)): ?>
                    <tr>
                        <td colspan="7" class="text-muted text-center py-3"><?= Html::encode(\Yii::t('app', 'Sin contratos aún.')) ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>