<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/** @var app\models\Profile $profile */
/** @var array $profileFormOptions */

$reqLabel = static function (Profile $profile, string $attr): string {
    $need = $profile->isAttributeRequired($attr);

    return Html::encode($profile->getAttributeLabel($attr)) . ($need ? ' <span class="text-danger">*</span>' : '');
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
$mapTimezones = $profileFormOptions['timezones'] ?? [];

$sectionHead = static function (string $icon, string $softClass, string $textClass, string $title, string $subtitle): string {
    return '<div class="d-flex align-items-start gap-3 mb-3">'
        . '<span class="avatar avatar-md ' . $softClass . ' ' . $textClass . ' rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width:44px;height:44px;">'
        . '<i class="ti ' . Html::encode($icon) . ' fs-20"></i></span>'
        . '<div><h6 class="fw-semibold mb-1">' . Html::encode($title) . '</h6>'
        . '<p class="text-muted small mb-0">' . Html::encode($subtitle) . '</p></div></div>';
};
?>

<?= Html::activeHiddenInput($profile, 'empresas_id', [
    'name' => 'Profile[empresas_id]',
    'value' => (int) ($profileFormOptions['empresaId'] ?? $profile->empresas_id ?? 0),
]) ?>
<?= Html::activeHiddenInput($profile, 'photo_', [
    'name' => 'Profile[photo_]',
]) ?>

<!-- Foto -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-photo', 'bg-soft-primary', 'text-primary', \Yii::t('app', 'Foto de perfil'), \Yii::t('app', 'Imagen visible en el perfil y listados.')) ?>
    <div class="rounded-3 border bg-white p-3">
        <div class="d-flex align-items-start flex-wrap gap-3">
            <div class="avatar avatar-lg rounded-circle flex-shrink-0 border border-light shadow-sm">
                <img src="<?= Html::encode($profile->getPhotoPublicUrl()) ?>" alt="" class="rounded-circle object-fit-cover" width="72" height="72">
            </div>
            <div class="flex-grow-1 min-w-0">
                <label class="form-label fw-medium mb-1"><?= $reqLabel($profile, 'photoFile') ?></label>
                <?= Html::activeFileInput($profile, 'photoFile', [
                    'class' => 'form-control form-control-sm',
                    'name' => 'Profile[photoFile]',
                    'accept' => 'image/png,image/jpeg,image/gif,image/webp',
                ]) ?>
                <div class="form-text"><?= Html::encode(\Yii::t('app', 'PNG, JPG, GIF o WebP. Máx. 2 MB.')) ?></div>
                <div class="invalid-feedback d-block"><?= Html::error($profile, 'photoFile') ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Identificación -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-id', 'bg-soft-success', 'text-success', \Yii::t('app', 'Identificación'), \Yii::t('app', 'Documento, nombre completo y estado del colaborador.')) ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'tipo_doc') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-id text-success"></i></span>
                <?= Html::activeDropDownList($profile, 'tipo_doc', $profileFormOptions['tipoDoc'] ?? Profile::optsTipoDoc(), [
                    'class' => 'form-select',
                    'name' => 'Profile[tipo_doc]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'tipo_doc') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'num_doc') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-hash text-success"></i></span>
                <?= Html::activeTextInput($profile, 'num_doc', ['class' => 'form-control', 'name' => 'Profile[num_doc]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'num_doc') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'name') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-user text-success"></i></span>
                <?= Html::activeTextInput($profile, 'name', ['class' => 'form-control', 'name' => 'Profile[name]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'name') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'estado') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-toggle-right text-success"></i></span>
                <?= Html::activeDropDownList($profile, 'estado', $profileFormOptions['estado'] ?? Profile::optsEstado(), [
                    'class' => 'form-select',
                    'name' => 'Profile[estado]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'estado') ?></div>
        </div>
    </div>
</div>

<!-- Contacto -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-mail', 'bg-soft-info', 'text-info', \Yii::t('app', 'Contacto'), \Yii::t('app', 'Correos públicos, Gravatar y teléfono.')) ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'public_email') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-mail text-info"></i></span>
                <?= Html::activeTextInput($profile, 'public_email', ['class' => 'form-control', 'name' => 'Profile[public_email]', 'type' => 'email']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'public_email') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'gravatar_email') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-at text-info"></i></span>
                <?= Html::activeTextInput($profile, 'gravatar_email', ['class' => 'form-control', 'name' => 'Profile[gravatar_email]', 'type' => 'email']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'gravatar_email') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'gravatar_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-fingerprint text-info"></i></span>
                <?= Html::activeTextInput($profile, 'gravatar_id', ['class' => 'form-control', 'name' => 'Profile[gravatar_id]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'gravatar_id') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'telefono') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-phone text-info"></i></span>
                <?= Html::activeTextInput($profile, 'telefono', ['class' => 'form-control', 'name' => 'Profile[telefono]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'telefono') ?></div>
        </div>
    </div>
</div>

<!-- Personal y ubicación -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-user', 'bg-soft-warning', 'text-warning', \Yii::t('app', 'Datos personales y ubicación'), \Yii::t('app', 'Sexo, fechas, cargo y zona horaria.')) ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'sexo') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-gender-bigender text-warning"></i></span>
                <?= Html::activeDropDownList($profile, 'sexo', ['' => '—'] + ($profileFormOptions['sexo'] ?? Profile::optsSexo()), [
                    'class' => 'form-select',
                    'name' => 'Profile[sexo]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'sexo') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'birthday') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-cake text-warning"></i></span>
                <?= Html::activeTextInput($profile, 'birthday', ['class' => 'form-control', 'name' => 'Profile[birthday]', 'type' => 'date']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'birthday') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'position') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-briefcase text-warning"></i></span>
                <?= Html::activeTextInput($profile, 'position', ['class' => 'form-control', 'name' => 'Profile[position]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'position') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'city') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-building-community text-warning"></i></span>
                <?= Html::activeTextInput($profile, 'city', ['class' => 'form-control', 'name' => 'Profile[city]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'city') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'timezone') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-world text-warning"></i></span>
                <?= Html::activeDropDownList($profile, 'timezone', ['' => '—'] + $mapTimezones, [
                    'class' => 'form-select',
                    'name' => 'Profile[timezone]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'timezone') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'location') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-map-pin text-warning"></i></span>
                <?= Html::activeTextInput($profile, 'location', ['class' => 'form-control', 'name' => 'Profile[location]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'location') ?></div>
        </div>
    </div>
</div>

<!-- Organización -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-building', 'bg-soft-primary', 'text-primary', \Yii::t('app', 'Organización'), \Yii::t('app', 'Área, sedes, cargo y centros contables.')) ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'area_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-layout-grid text-primary"></i></span>
                <?= Html::activeDropDownList($profile, 'area_id', ['' => '—'] + $mapAreas, [
                    'class' => 'form-select',
                    'name' => 'Profile[area_id]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'area_id') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'sede_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-building text-primary"></i></span>
                <?= Html::activeDropDownList($profile, 'sede_id', ['' => '—'] + $mapSedes, [
                    'class' => 'form-select',
                    'name' => 'Profile[sede_id]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'sede_id') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'location_sede_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-map-2 text-primary"></i></span>
                <?= Html::activeDropDownList($profile, 'location_sede_id', ['' => '—'] + $mapSedes, [
                    'class' => 'form-select',
                    'name' => 'Profile[location_sede_id]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'location_sede_id') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'cargo_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-badge text-primary"></i></span>
                <?= Html::activeDropDownList($profile, 'cargo_id', ['' => '—'] + $mapCargos, [
                    'class' => 'form-select',
                    'name' => 'Profile[cargo_id]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'cargo_id') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'centro_costo_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-calculator text-primary"></i></span>
                <?= Html::activeDropDownList($profile, 'centro_costo_id', ['' => '—'] + $mapCc, [
                    'class' => 'form-select',
                    'name' => 'Profile[centro_costo_id]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'centro_costo_id') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'centro_utilidad_id') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-chart-dots text-primary"></i></span>
                <?= Html::activeDropDownList($profile, 'centro_utilidad_id', ['' => '—'] + $mapCu, [
                    'class' => 'form-select',
                    'name' => 'Profile[centro_utilidad_id]',
                ]) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'centro_utilidad_id') ?></div>
        </div>
    </div>
</div>

<!-- Dirección -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-home', 'bg-soft-info', 'text-info', \Yii::t('app', 'Dirección'), \Yii::t('app', 'Dirección de contacto o correspondencia.')) ?>
    <label class="form-label fw-medium"><?= $reqLabel($profile, 'address') ?></label>
    <div class="input-group">
        <span class="input-group-text bg-white align-items-start pt-2"><i class="ti ti-home text-info"></i></span>
        <?= Html::activeTextInput($profile, 'address', ['class' => 'form-control', 'name' => 'Profile[address]']) ?>
    </div>
    <div class="invalid-feedback d-block"><?= Html::error($profile, 'address') ?></div>
</div>

<!-- Bio -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-notes', 'bg-soft-secondary', 'text-secondary', \Yii::t('app', 'Presentación'), \Yii::t('app', 'Biografía corta y descripción extendida.')) ?>
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'bio') ?></label>
            <?= Html::activeTextarea($profile, 'bio', ['class' => 'form-control', 'name' => 'Profile[bio]', 'rows' => 2]) ?>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'bio') ?></div>
        </div>
        <div class="col-12">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'about') ?></label>
            <?= Html::activeTextarea($profile, 'about', ['class' => 'form-control', 'name' => 'Profile[about]', 'rows' => 2]) ?>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'about') ?></div>
        </div>
    </div>
</div>

<!-- Redes -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <?= $sectionHead('ti-share', 'bg-soft-primary', 'text-primary', \Yii::t('app', 'Redes y web'), \Yii::t('app', 'Enlaces a perfiles sociales y sitio web.')) ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'instagram') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-brand-instagram text-primary"></i></span>
                <?= Html::activeTextInput($profile, 'instagram', ['class' => 'form-control', 'name' => 'Profile[instagram]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'instagram') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'tiktok') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-brand-tiktok text-primary"></i></span>
                <?= Html::activeTextInput($profile, 'tiktok', ['class' => 'form-control', 'name' => 'Profile[tiktok]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'tiktok') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'linkedin') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-brand-linkedin text-primary"></i></span>
                <?= Html::activeTextInput($profile, 'linkedin', ['class' => 'form-control', 'name' => 'Profile[linkedin]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'linkedin') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'youtube') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-brand-youtube text-primary"></i></span>
                <?= Html::activeTextInput($profile, 'youtube', ['class' => 'form-control', 'name' => 'Profile[youtube]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'youtube') ?></div>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium"><?= $reqLabel($profile, 'website') ?></label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-world-www text-primary"></i></span>
                <?= Html::activeTextInput($profile, 'website', ['class' => 'form-control', 'name' => 'Profile[website]']) ?>
            </div>
            <div class="invalid-feedback d-block"><?= Html::error($profile, 'website') ?></div>
        </div>
    </div>
</div>

<!-- JSON -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
    <?= $sectionHead('ti-code', 'bg-soft-secondary', 'text-secondary', \Yii::t('app', 'Datos técnicos'), \Yii::t('app', 'JSON adicional para integraciones (opcional).')) ?>
    <label class="form-label fw-medium"><?= $reqLabel($profile, 'data_json') ?></label>
    <?= Html::activeTextarea($profile, 'data_json', ['class' => 'form-control font-monospace small', 'name' => 'Profile[data_json]', 'rows' => 3]) ?>
    <div class="invalid-feedback d-block"><?= Html::error($profile, 'data_json') ?></div>
</div>