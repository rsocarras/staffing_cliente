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
            <thead><tr><th>ID</th><th>Tipo</th><th>Área</th><th>Cargo</th><th>Estado</th><th>Inicio</th><th>Fin</th></tr></thead>
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
                <tr><td colspan="7" class="text-muted text-center py-3"><?= Html::encode(\Yii::t('app', 'Sin contratos aún.')) ?></td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (!$canManageContratos): ?>
    <div class="alert alert-info mb-0"><?= Html::encode(\Yii::t('app', 'No tiene permisos para crear contratos desde aquí.')) ?></div>
<?php else: ?>
    <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
        <h6 class="fw-semibold mb-3"><?= Html::encode(\Yii::t('app', 'Agregar contrato')) ?></h6>
        <?php $formC = ActiveForm::begin([
            'action' => $createContratoUrl,
            'method' => 'post',
            'options' => ['class' => 'contrato-form-empleado-modal'],
        ]); ?>
        <?= Html::hiddenInput('_return_to', 'empleados') ?>
        <?= $formC->field($contratoNew, 'empresa_id')->hiddenInput()->label(false) ?>
        <?= $formC->field($contratoNew, 'profile_id')->hiddenInput()->label(false) ?>

        <div class="row g-3">
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'contrato_tipo_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapTipos, ['prompt' => '—', 'class' => 'form-select']) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'estado', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapEstados, ['class' => 'form-select']) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'area_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapAreas, [
                    'prompt' => '—',
                    'class' => 'form-select',
                    'id' => 'contrato-emp-area-id',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'sub_area_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapSub, [
                    'prompt' => '—',
                    'class' => 'form-select',
                    'id' => 'contrato-emp-sub-area-id',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'cargo_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapCargos, [
                    'prompt' => '—',
                    'class' => 'form-select',
                    'id' => 'contrato-emp-cargo-id',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'sede_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapSedes, ['prompt' => '—', 'class' => 'form-select']) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'fecha_inicio', ['labelOptions' => ['class' => 'form-label fw-medium']])->textInput(['type' => 'date', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6">
                <?= $formC->field($contratoNew, 'fecha_fin', ['labelOptions' => ['class' => 'form-label fw-medium']])->textInput(['type' => 'date', 'class' => 'form-control']) ?>
            </div>
        </div>
        <div class="mt-3">
            <?= Html::submitButton(\Yii::t('app', 'Guardar contrato'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php endif; ?>
