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
?>

<?= Html::activeHiddenInput($profile, 'empresas_id', [
    'name' => 'Profile[empresas_id]',
    'value' => (int) ($profileFormOptions['empresaId'] ?? $profile->empresas_id ?? 0),
]) ?>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'tipo_doc') ?></label>
        <?= Html::activeDropDownList($profile, 'tipo_doc', $profileFormOptions['tipoDoc'] ?? Profile::optsTipoDoc(), [
            'class' => 'form-select',
            'name' => 'Profile[tipo_doc]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'tipo_doc') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'num_doc') ?></label>
        <?= Html::activeTextInput($profile, 'num_doc', ['class' => 'form-control', 'name' => 'Profile[num_doc]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'num_doc') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'name') ?></label>
        <?= Html::activeTextInput($profile, 'name', ['class' => 'form-control', 'name' => 'Profile[name]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'name') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'estado') ?></label>
        <?= Html::activeDropDownList($profile, 'estado', $profileFormOptions['estado'] ?? Profile::optsEstado(), [
            'class' => 'form-select',
            'name' => 'Profile[estado]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'estado') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'public_email') ?></label>
        <?= Html::activeTextInput($profile, 'public_email', ['class' => 'form-control', 'name' => 'Profile[public_email]', 'type' => 'email']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'public_email') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'gravatar_email') ?></label>
        <?= Html::activeTextInput($profile, 'gravatar_email', ['class' => 'form-control', 'name' => 'Profile[gravatar_email]', 'type' => 'email']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'gravatar_email') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'gravatar_id') ?></label>
        <?= Html::activeTextInput($profile, 'gravatar_id', ['class' => 'form-control', 'name' => 'Profile[gravatar_id]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'gravatar_id') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'telefono') ?></label>
        <?= Html::activeTextInput($profile, 'telefono', ['class' => 'form-control', 'name' => 'Profile[telefono]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'telefono') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'sexo') ?></label>
        <?= Html::activeDropDownList($profile, 'sexo', ['' => '—'] + ($profileFormOptions['sexo'] ?? Profile::optsSexo()), [
            'class' => 'form-select',
            'name' => 'Profile[sexo]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'sexo') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'birthday') ?></label>
        <?= Html::activeTextInput($profile, 'birthday', ['class' => 'form-control', 'name' => 'Profile[birthday]', 'type' => 'date']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'birthday') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'position') ?></label>
        <?= Html::activeTextInput($profile, 'position', ['class' => 'form-control', 'name' => 'Profile[position]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'position') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'city') ?></label>
        <?= Html::activeTextInput($profile, 'city', ['class' => 'form-control', 'name' => 'Profile[city]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'city') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'timezone') ?></label>
        <?= Html::activeDropDownList($profile, 'timezone', ['' => '—'] + $mapTimezones, [
            'class' => 'form-select',
            'name' => 'Profile[timezone]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'timezone') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'location') ?></label>
        <?= Html::activeTextInput($profile, 'location', ['class' => 'form-control', 'name' => 'Profile[location]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'location') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'area_id') ?></label>
        <?= Html::activeDropDownList($profile, 'area_id', ['' => '—'] + $mapAreas, [
            'class' => 'form-select',
            'name' => 'Profile[area_id]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'area_id') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'sede_id') ?></label>
        <?= Html::activeDropDownList($profile, 'sede_id', ['' => '—'] + $mapSedes, [
            'class' => 'form-select',
            'name' => 'Profile[sede_id]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'sede_id') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'location_sede_id') ?></label>
        <?= Html::activeDropDownList($profile, 'location_sede_id', ['' => '—'] + $mapSedes, [
            'class' => 'form-select',
            'name' => 'Profile[location_sede_id]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'location_sede_id') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'cargo_id') ?></label>
        <?= Html::activeDropDownList($profile, 'cargo_id', ['' => '—'] + $mapCargos, [
            'class' => 'form-select',
            'name' => 'Profile[cargo_id]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'cargo_id') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'centro_costo_id') ?></label>
        <?= Html::activeDropDownList($profile, 'centro_costo_id', ['' => '—'] + $mapCc, [
            'class' => 'form-select',
            'name' => 'Profile[centro_costo_id]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'centro_costo_id') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'centro_utilidad_id') ?></label>
        <?= Html::activeDropDownList($profile, 'centro_utilidad_id', ['' => '—'] + $mapCu, [
            'class' => 'form-select',
            'name' => 'Profile[centro_utilidad_id]',
        ]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'centro_utilidad_id') ?></div>
    </div>
    <div class="col-12">
        <label class="form-label"><?= $reqLabel($profile, 'address') ?></label>
        <?= Html::activeTextInput($profile, 'address', ['class' => 'form-control', 'name' => 'Profile[address]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'address') ?></div>
    </div>
    <div class="col-12">
        <label class="form-label"><?= $reqLabel($profile, 'bio') ?></label>
        <?= Html::activeTextarea($profile, 'bio', ['class' => 'form-control', 'name' => 'Profile[bio]', 'rows' => 2]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'bio') ?></div>
    </div>
    <div class="col-12">
        <label class="form-label"><?= $reqLabel($profile, 'about') ?></label>
        <?= Html::activeTextarea($profile, 'about', ['class' => 'form-control', 'name' => 'Profile[about]', 'rows' => 2]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'about') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'instagram') ?></label>
        <?= Html::activeTextInput($profile, 'instagram', ['class' => 'form-control', 'name' => 'Profile[instagram]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'instagram') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'tiktok') ?></label>
        <?= Html::activeTextInput($profile, 'tiktok', ['class' => 'form-control', 'name' => 'Profile[tiktok]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'tiktok') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'linkedin') ?></label>
        <?= Html::activeTextInput($profile, 'linkedin', ['class' => 'form-control', 'name' => 'Profile[linkedin]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'linkedin') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'youtube') ?></label>
        <?= Html::activeTextInput($profile, 'youtube', ['class' => 'form-control', 'name' => 'Profile[youtube]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'youtube') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'website') ?></label>
        <?= Html::activeTextInput($profile, 'website', ['class' => 'form-control', 'name' => 'Profile[website]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'website') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'photo_') ?></label>
        <?= Html::activeTextInput($profile, 'photo_', ['class' => 'form-control', 'name' => 'Profile[photo_]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'photo_') ?></div>
    </div>
    <div class="col-md-6">
        <label class="form-label"><?= $reqLabel($profile, 'photoFile') ?></label>
        <?= Html::activeFileInput($profile, 'photoFile', ['class' => 'form-control', 'name' => 'Profile[photoFile]']) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'photoFile') ?></div>
    </div>
    <div class="col-12">
        <label class="form-label"><?= $reqLabel($profile, 'data_json') ?></label>
        <?= Html::activeTextarea($profile, 'data_json', ['class' => 'form-control font-monospace small', 'name' => 'Profile[data_json]', 'rows' => 3]) ?>
        <div class="invalid-feedback d-block"><?= Html::error($profile, 'data_json') ?></div>
    </div>
</div>
