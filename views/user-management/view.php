<?php

use app\models\Contrato;
use app\models\Profile;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var User $model */
/** @var Profile $profile */
/** @var \yii\rbac\Role[] $allRoles */
/** @var array $profileFormOptions */
/** @var Contrato[] $contratos */
/** @var Contrato $contratoNew */
/** @var array $contratoOptions */
/** @var bool $canManageContratos */

$this->title = 'Usuario: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => Url::to(['/usuarios'])];
$this->params['breadcrumbs'][] = $this->title;

$subAreasUrl = Url::to(['/sistema/contratos/sub-areas']);
$cargosUrl = Url::to(['/sistema/contratos/cargos-por-estructura']);
$mapTipos = ArrayHelper::map($contratoOptions['contratoTipos'] ?? [], 'id', 'nombre');
$mapSedes = ArrayHelper::map($contratoOptions['sedes'] ?? [], 'id', 'nombre');
$mapAreas = ArrayHelper::map($contratoOptions['areas'] ?? [], 'id', 'nombre');
$mapSub = ArrayHelper::map($contratoOptions['subAreas'] ?? [], 'id', 'nombre');
$mapCargos = ArrayHelper::map($contratoOptions['cargos'] ?? [], 'id', 'nombre');
$mapEstados = $contratoOptions['estados'] ?? [];

$roleNames = (array) $model->roleNames;
$cuentaEstado = $model->blocked_at ? 'Inactivo' : 'Activo';
$isConfirmedChecked = !empty($model->confirmed_at);
?>

<div class="page-wrapper">
    <div class="content">
        <?php if (\Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show"><?= Html::encode((string) \Yii::$app->session->getFlash('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (\Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show"><?= Html::encode((string) \Yii::$app->session->getFlash('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card mb-3">
            <div class="card-body py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h4 class="mb-0 fw-bold"><?= Html::encode($this->title) ?></h4>
                <div class="d-flex gap-2">
                    <?= Html::a('Volver al listado', Url::to(['/usuarios']), ['class' => 'btn btn-light']) ?>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-tabs-custom mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="user-view-tab-usuario" data-bs-toggle="tab" data-bs-target="#user-view-usuario" type="button" role="tab">Usuario</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="user-view-tab-perfil" data-bs-toggle="tab" data-bs-target="#user-view-perfil" type="button" role="tab">Perfil</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="user-view-tab-contrato" data-bs-toggle="tab" data-bs-target="#user-view-contrato" type="button" role="tab">Contrato</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="user-view-usuario" role="tabpanel">
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-user fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Datos del usuario</h6>
                            <p class="text-muted small mb-0">Vista de solo lectura (edite desde el listado de usuarios).</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium" for="view-user-username"><?= Html::encode($model->getAttributeLabel('username')) ?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-at text-primary"></i></span>
                                <input id="view-user-username" type="text" class="form-control bg-light" value="<?= Html::encode((string) $model->username) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium" for="view-user-email"><?= Html::encode($model->getAttributeLabel('email')) ?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-mail text-primary"></i></span>
                                <input id="view-user-email" type="email" class="form-control bg-light" value="<?= Html::encode((string) $model->email) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Estado de la cuenta</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-circle-check text-primary"></i></span>
                                <input type="text" class="form-control bg-light" value="<?= Html::encode($cuentaEstado) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="view-user-confirmed" <?= $isConfirmedChecked ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="view-user-confirmed">Usuario confirmado (puede iniciar sesión)</label>
                            </div>
                            <?php if ($model->confirmed_at): ?>
                                <p class="text-muted small mb-0 mt-1"><?= Html::encode(\Yii::t('app', 'Confirmado el {fecha}', ['fecha' => \Yii::$app->formatter->asDatetime((int) $model->confirmed_at)])) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium"><?= Html::encode(\Yii::t('app', 'Contraseña')) ?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-lock text-primary"></i></span>
                                <input type="text" class="form-control bg-light" value="<?= Html::encode(\Yii::t('app', 'No se muestra por seguridad.')) ?>" readonly tabindex="-1">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-shield fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Roles</h6>
                            <p class="text-muted small mb-0">Asignación actual (solo lectura).</p>
                        </div>
                    </div>
                    <div class="rounded-3 border bg-white p-3" style="max-height: 200px; overflow-y: auto;">
                        <?php foreach ($allRoles as $name => $role): ?>
                            <?php
                            $rid = 'user-view-role-' . preg_replace('/[^a-z0-9_]/', '_', $name);
                            ?>
                            <div class="form-check py-2 border-bottom border-opacity-25">
                                <?= Html::checkbox('view_role_' . $rid, in_array($name, $roleNames, true), [
                                    'value' => $name,
                                    'id' => $rid,
                                    'class' => 'form-check-input',
                                    'disabled' => true,
                                ]) ?>
                                <label class="form-check-label ms-2" for="<?= Html::encode($rid) ?>">
                                    <?= Html::encode($name) ?>
                                    <?php if (!empty($role->description)): ?>
                                        <span class="text-muted small">— <?= Html::encode($role->description) ?></span>
                                    <?php endif; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($allRoles)): ?>
                            <p class="text-muted mb-0">No hay roles definidos.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="user-view-perfil" role="tabpanel">
                <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
                    <h6 class="fw-semibold mb-3">Datos del perfil</h6>
                    <?= $this->render('_profile_fields_readonly', [
                        'profile' => $profile,
                        'profileFormOptions' => $profileFormOptions,
                    ]) ?>
                </div>
            </div>

            <div class="tab-pane fade" id="user-view-contrato" role="tabpanel">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white"><h6 class="mb-0">Contratos registrados</h6></div>
                    <div class="card-body p-0">
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
                                    <tr><td colspan="7" class="text-muted text-center py-3">Sin contratos aún.</td></tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php if (!$canManageContratos): ?>
                    <div class="alert alert-info mb-0">No tiene permisos para crear contratos desde aquí.</div>
                <?php else: ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white"><h6 class="mb-0">Agregar contrato</h6></div>
                        <div class="card-body">
                            <?php $formC = ActiveForm::begin([
                                'action' => Url::to(['/usuarios/create-user-contrato', 'id' => $model->id]),
                                'method' => 'post',
                            ]); ?>
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
                                        'id' => 'contrato-user-area-id',
                                    ]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $formC->field($contratoNew, 'sub_area_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapSub, [
                                        'prompt' => '—',
                                        'class' => 'form-select',
                                        'id' => 'contrato-user-sub-area-id',
                                    ]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $formC->field($contratoNew, 'cargo_id', ['labelOptions' => ['class' => 'form-label fw-medium']])->dropDownList($mapCargos, [
                                        'prompt' => '—',
                                        'class' => 'form-select',
                                        'id' => 'contrato-user-cargo-id',
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
                                <?= Html::submitButton('Guardar contrato', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
(function () {
  var subUrl = '{$subAreasUrl}';
  var cargoUrl = '{$cargosUrl}';

  function fillSelect(sel, items, prompt) {
    var v = sel.value;
    sel.innerHTML = '';
    var o = document.createElement('option');
    o.value = '';
    o.textContent = prompt;
    sel.appendChild(o);
    items.forEach(function (row) {
      var opt = document.createElement('option');
      opt.value = row.id;
      opt.textContent = row.nombre;
      sel.appendChild(opt);
    });
    sel.value = '';
  }

  $('#contrato-user-area-id').on('change', function () {
    var areaId = $(this).val();
    var \$sub = $('#contrato-user-sub-area-id');
    var \$cargo = $('#contrato-user-cargo-id');
    \$sub.empty().append('<option value=\"\">—</option>');
    \$cargo.empty().append('<option value=\"\">—</option>');
    if (!areaId) return;
    $.getJSON(subUrl, { area_id: areaId }, function (rows) {
      fillSelect(\$sub[0], rows || [], '—');
    });
  });

  $('#contrato-user-sub-area-id').on('change', function () {
    var areaId = $('#contrato-user-area-id').val();
    var subId = $(this).val();
    var \$cargo = $('#contrato-user-cargo-id');
    \$cargo.empty().append('<option value=\"\">—</option>');
    if (!areaId) return;
    $.getJSON(cargoUrl, { area_id: areaId, sub_area_id: subId || '' }, function (rows) {
      fillSelect(\$cargo[0], rows || [], '—');
    });
  });
})();
JS;
$this->registerJs($js);
?>
