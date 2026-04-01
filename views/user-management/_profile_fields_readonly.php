<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/** @var app\models\Profile $profile */
/** @var array $profileFormOptions */
/** @var string|null $photoEditHint Texto bajo la vista previa de foto (opcional). */
/** @var bool $hideTechnicalFields Oculta ruta de foto en BD, Gravatar ID y datos JSON (vista empleado / solo lectura). */
/** @var bool $resumenStyleLayout Tarjetas con icono e input-group (mismo estilo que el tab Resumen del modal empleado). */

$hideTechnicalFields = !empty($hideTechnicalFields);
$resumenStyleLayout = !empty($resumenStyleLayout);

$dash = '—';
$lbl = static function (Profile $profile, string $attr) use ($dash): string {
    return Html::encode($profile->getAttributeLabel($attr));
};

$txt = static function ($val) use ($dash): string {
    if ($val === null || $val === '') {
        return $dash;
    }

    return Html::encode((string) $val);
};

$mapSedes = ArrayHelper::map($profileFormOptions['sedes'] ?? [], 'id', 'nombre');
$mapCargos = ArrayHelper::map($profileFormOptions['cargos'] ?? [], 'id', 'nombre');
$mapCc = ArrayHelper::map($profileFormOptions['centrosCosto'] ?? [], 'id', function ($row) {
    return trim(($row->codigo ?? '') . ' — ' . ($row->nombre ?? ''));
});
$mapCu = ArrayHelper::map($profileFormOptions['centrosUtilidad'] ?? [], 'id', function ($row) {
    return trim(($row->codigo ?? '') . ' — ' . ($row->nombre ?? ''));
});
$mapAreas = ArrayHelper::map($profileFormOptions['areas'] ?? [], 'id', 'nombre');
$tzOpts = $profileFormOptions['timezones'] ?? [];

$fkName = static function ($id, array $map) use ($dash): string {
    if ($id === null || $id === '') {
        return $dash;
    }
    $i = (int) $id;

    return Html::encode((string) ($map[$i] ?? ('#' . $i)));
};

$tipoOpts = $profileFormOptions['tipoDoc'] ?? Profile::optsTipoDoc();
$sexoOpts = $profileFormOptions['sexo'] ?? Profile::optsSexo();
$estadoOpts = $profileFormOptions['estado'] ?? Profile::optsEstado();

$empresaRaw = '';
if ($profile->empresas !== null) {
    $empresaRaw = (string) ($profile->empresas->name ?? $profile->empresas->social_name ?? '');
}
$empresaNombre = $empresaRaw !== '' ? Html::encode($empresaRaw) : Html::encode($dash);

$areaNombre = $profile->area !== null ? Html::encode((string) ($profile->area->nombre ?? '')) : $fkName($profile->area_id, $mapAreas);
$sedeNombre = $profile->sede !== null ? Html::encode((string) ($profile->sede->nombre ?? '')) : $fkName($profile->sede_id, $mapSedes);
$locSedeNombre = $profile->locationSede !== null ? Html::encode((string) ($profile->locationSede->nombre ?? '')) : $fkName($profile->location_sede_id, $mapSedes);
$cargoNombre = $profile->cargo !== null ? Html::encode((string) ($profile->cargo->nombre ?? '')) : $fkName($profile->cargo_id, $mapCargos);
$ccNombre = $profile->centroCosto !== null
    ? Html::encode(trim(($profile->centroCosto->codigo ?? '') . ' — ' . ($profile->centroCosto->nombre ?? '')))
    : $fkName($profile->centro_costo_id, $mapCc);
$cuNombre = $profile->centroUtilidad !== null
    ? Html::encode(trim(($profile->centroUtilidad->codigo ?? '') . ' — ' . ($profile->centroUtilidad->nombre ?? '')))
    : $fkName($profile->centro_utilidad_id, $mapCu);

$timezoneDisplay = ($profile->timezone !== null && $profile->timezone !== '' && isset($tzOpts[$profile->timezone]))
    ? Html::encode((string) $tzOpts[$profile->timezone])
    : $txt($profile->timezone);

$estadoLabelPlain = $profile->estado ? (string) ($estadoOpts[$profile->estado] ?? $profile->estado) : '—';
$estadoBadgeClass = $profile->estado ? Profile::estadoBadgeSoftClass($profile->estado) : '';
?>

<?php if ($resumenStyleLayout): ?>
    <?php
    $ro = 0;
    $nextRo = static function () use (&$ro): string {
        $ro++;

        return 'emp-perfil-ro-' . $ro;
    };
    ?>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-user fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Identificación')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Foto y datos básicos del colaborador.')) ?></p>
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3 mb-3">
            <div class="flex-grow-1 min-w-0 w-100">
                <?php $fidName = $nextRo(); ?>
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($fidName) ?>"><?= $lbl($profile, 'name') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-user text-primary"></i></span>
                    <input id="<?= Html::encode($fidName) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->name) ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-id fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Empresa y documento')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Empresa, tipo y número de documento.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= Html::encode(\Yii::t('app', 'Empresa')) ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-building-community text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $empresaNombre ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'tipo_doc') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-file-text text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= Html::encode((string) ($tipoOpts[$profile->tipo_doc] ?? $profile->tipo_doc ?? $dash)) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'num_doc') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-numbers text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->num_doc) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <?php $fidEst = $nextRo(); ?>
                <label class="form-label fw-medium mb-1 d-block" for="<?= Html::encode($fidEst) ?>"><?= $lbl($profile, 'estado') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-flag text-primary"></i></span>
                    <div id="<?= Html::encode($fidEst) ?>" class="form-control bg-light d-flex align-items-center min-h-auto py-2" tabindex="-1">
                        <?php if ($profile->estado && $estadoBadgeClass !== ''): ?>
                            <span class="badge badge-soft-<?= Html::encode($estadoBadgeClass) ?>"><?= Html::encode($estadoLabelPlain) ?></span>
                        <?php else: ?>
                            <span class="text-body"><?= Html::encode($estadoLabelPlain) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-mail fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Correo y teléfono')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Correos públicos y contacto.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'public_email') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-mail text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->public_email) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'gravatar_email') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-at text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->gravatar_email) ?>">
                </div>
            </div>
            <?php if (!$hideTechnicalFields): ?>
                <div class="col-md-6">
                    <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'gravatar_id') ?></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="ti ti-hash text-primary"></i></span>
                        <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->gravatar_id) ?>">
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'telefono') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-phone text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->telefono) ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-secondary text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-heart fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Datos personales')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Sexo, fechas y ubicación personal.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'sexo') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-user text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= Html::encode((string) (($profile->sexo !== null && $profile->sexo !== '' && isset($sexoOpts[$profile->sexo])) ? $sexoOpts[$profile->sexo] : ($profile->sexo ?: $dash))) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'birthday') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-cake text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->birthday) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'position') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-briefcase text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->position) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'city') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-building-store text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->city) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'timezone') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-clock text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $timezoneDisplay ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'location') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-world text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->location) ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-building fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Organización')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Sede, área, cargo y centros.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'area_id') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-layout-grid text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $areaNombre ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'sede_id') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-map-pin text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $sedeNombre ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'location_sede_id') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-map-2 text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $locSedeNombre ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'cargo_id') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-id-badge text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $cargoNombre ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'centro_costo_id') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-calculator text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $ccNombre ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'centro_utilidad_id') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-chart-dots text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $cuNombre ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-map-2 fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Dirección')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Dirección completa.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'address') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white align-items-start pt-2"><i class="ti ti-home text-primary"></i></span>
                    <textarea id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" class="form-control bg-light" readonly rows="2"><?= Html::encode((string) ($profile->address ?? '')) ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-indigo text-indigo rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-notes fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Biografía')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Bio y descripción.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'bio') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white align-items-start pt-2"><i class="ti ti-quote text-primary"></i></span>
                    <textarea id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" class="form-control bg-light" readonly rows="2" placeholder="<?= Html::encode(\Yii::t('app', 'Sin biografía')) ?>"><?= Html::encode((string) ($profile->bio ?? '')) ?></textarea>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'about') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white align-items-start pt-2"><i class="ti ti-align-left text-primary"></i></span>
                    <textarea id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" class="form-control bg-light" readonly rows="2" placeholder="<?= Html::encode(\Yii::t('app', 'Sin descripción')) ?>"><?= Html::encode((string) ($profile->about ?? '')) ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-pink text-pink rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-share fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Redes y web')) ?></h6>
                <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Enlaces públicos.')) ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'instagram') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-brand-instagram text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->instagram) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'tiktok') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-brand-tiktok text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->tiktok) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'linkedin') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-brand-linkedin text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->linkedin) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'youtube') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-brand-youtube text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->youtube) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'website') ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-link text-primary"></i></span>
                    <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->website) ?>">
                </div>
            </div>
        </div>
    </div>

    <?php if (!$hideTechnicalFields): ?>
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-dark text-dark rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-code fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Técnico')) ?></h6>
                    <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Ruta de foto y datos JSON.')) ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'photo_') ?></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="ti ti-photo text-primary"></i></span>
                        <input id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" type="text" class="form-control bg-light" readonly value="<?= $txt($profile->photo_) ?>">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium mb-1" for="<?= Html::encode($nextRo()) ?>"><?= $lbl($profile, 'data_json') ?></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white align-items-start pt-2"><i class="ti ti-braces text-primary"></i></span>
                        <textarea id="<?= Html::encode('emp-perfil-ro-' . $ro) ?>" class="form-control bg-light font-monospace small" readonly rows="4"><?= Html::encode((string) ($profile->data_json ?? '')) ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= Html::encode(\Yii::t('app', 'Empresa')) ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $empresaNombre ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'tipo_doc') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= Html::encode((string) ($tipoOpts[$profile->tipo_doc] ?? $profile->tipo_doc ?? $dash)) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'num_doc') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->num_doc) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'name') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->name) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'estado') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= Html::encode((string) ($estadoOpts[$profile->estado] ?? $profile->estado ?? $dash)) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'public_email') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->public_email) ?>" placeholder="<?= Html::encode(\Yii::t('app', 'Sin correo público')) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'gravatar_email') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->gravatar_email) ?>" placeholder="<?= Html::encode(\Yii::t('app', 'Sin correo Gravatar')) ?>">
        </div>
        <?php if (!$hideTechnicalFields): ?>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'gravatar_id') ?></label>
                <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->gravatar_id) ?>">
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'telefono') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->telefono) ?>" placeholder="<?= Html::encode(\Yii::t('app', 'Sin teléfono')) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'sexo') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= Html::encode((string) (($profile->sexo !== null && $profile->sexo !== '' && isset($sexoOpts[$profile->sexo])) ? $sexoOpts[$profile->sexo] : ($profile->sexo ?: $dash))) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'birthday') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->birthday) ?>" placeholder="<?= Html::encode(\Yii::t('app', 'Sin fecha')) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'position') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->position) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'city') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->city) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'timezone') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $timezoneDisplay ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'location') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->location) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'area_id') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $areaNombre ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'sede_id') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $sedeNombre ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'location_sede_id') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $locSedeNombre ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'cargo_id') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $cargoNombre ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'centro_costo_id') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $ccNombre ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'centro_utilidad_id') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $cuNombre ?>">
        </div>
        <div class="col-12">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'address') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->address) ?>">
        </div>
        <div class="col-12">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'bio') ?></label>
            <textarea class="form-control bg-light" readonly rows="2" placeholder="<?= Html::encode(\Yii::t('app', 'Sin biografía')) ?>"><?= Html::encode((string) ($profile->bio ?? '')) ?></textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'about') ?></label>
            <textarea class="form-control bg-light" readonly rows="2" placeholder="<?= Html::encode(\Yii::t('app', 'Sin descripción')) ?>"><?= Html::encode((string) ($profile->about ?? '')) ?></textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'instagram') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->instagram) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'tiktok') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->tiktok) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'linkedin') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->linkedin) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'youtube') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->youtube) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'website') ?></label>
            <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->website) ?>">
        </div>
        <?php if (!$hideTechnicalFields): ?>
            <div class="col-md-6">
                <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'photo_') ?></label>
                <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->photo_) ?>">
            </div>
        <?php endif; ?>
        <?php if (!$hideTechnicalFields): ?>
            <div class="col-12">
                <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'data_json') ?></label>
                <textarea class="form-control bg-light font-monospace small" readonly rows="4" placeholder="<?= Html::encode(\Yii::t('app', 'Sin datos JSON')) ?>"><?= Html::encode((string) ($profile->data_json ?? '')) ?></textarea>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>