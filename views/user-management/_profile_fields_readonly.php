<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/** @var app\models\Profile $profile */
/** @var array $profileFormOptions */
/** @var string|null $photoEditHint Texto bajo la vista previa de foto (opcional). */

$dash = '—';
$photoEditHintText = (isset($photoEditHint) && $photoEditHint !== '')
    ? (string) $photoEditHint
    : \Yii::t('app', 'La foto solo se puede cambiar desde «Editar usuario».');
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
?>

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
    <div class="col-md-6">
        <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'gravatar_id') ?></label>
        <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->gravatar_id) ?>">
    </div>
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
    <div class="col-md-6">
        <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'photo_') ?></label>
        <input type="text" class="form-control bg-light" readonly value="<?= $txt($profile->photo_) ?>">
    </div>
    <div class="col-12">
        <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'photoFile') ?> / <?= Html::encode(\Yii::t('app', 'Vista previa')) ?></label>
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <img src="<?= Html::encode($profile->getPhotoPublicUrl()) ?>" alt="" class="rounded border" style="max-height: 72px; width: auto;">
            <span class="text-muted small"><?= Html::encode($photoEditHintText) ?></span>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label fw-medium mb-2 d-block"><?= $lbl($profile, 'data_json') ?></label>
        <textarea class="form-control bg-light font-monospace small" readonly rows="4" placeholder="<?= Html::encode(\Yii::t('app', 'Sin datos JSON')) ?>"><?= Html::encode((string) ($profile->data_json ?? '')) ?></textarea>
    </div>
</div>
