<?php

use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Profile $model */

$form = ActiveForm::begin([
    'id' => 'form-edit-profile-modal',
    'action' => '',
    'method' => 'post',
    'options' => ['enctype' => 'multipart/form-data'],
    'enableClientValidation' => false,
]);

$empresasId = $model->empresas_id;
$areas = $empresasId ? \app\models\Area::find()->where(['empresas_id' => $empresasId])->orderBy('nombre')->all() : [];
$cargos = $empresasId ? \app\models\Cargos::find()->where(['empresa_id' => $empresasId, 'activo' => 1])->orderBy('nombre')->all() : [];
?>

<div id="profile-edit-form-errors" class="alert alert-danger d-none mb-3"></div>

<!-- Profile -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Profile</h6>
            <span class="fs-13">Foto de perfil</span>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="d-flex align-items-center flex-wrap gap-3 mb-3">
            <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                <img id="profile-photo-preview" class="rounded-circle object-fit-cover" alt="" src="<?= Html::encode($model->getPhotoPublicUrl()) ?>">
            </div>
            <div class="d-inline-flex flex-column align-items-start">
                <?= $form->field($model, 'photoFile', [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options' => ['class' => 'mb-0'],
                ])->fileInput([
                    'id' => 'profile-photo-input',
                    'accept' => 'image/png,image/jpeg,image/gif,image/webp',
                    'class' => 'form-control form-control-sm',
                ])->label('Cambiar foto', ['class' => 'form-label']) ?>
                <span class="fs-13 text-muted">PNG, JPG, GIF o WebP. Máx. 2 MB. Recomendado 80×80 px.</span>
            </div>
        </div>
    </div>
</div>

<hr class="mt-0 mb-3">

<!-- Basic Information -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Información básica</h6>
            <span class="fs-13">Tu información personal</span>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nombre completo' . '<span class="text-danger ms-1">*</span>', ['encode' => false]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'tipo_doc')->dropDownList(Profile::optsTipoDoc(), ['prompt' => ''])->label('Tipo documento') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'num_doc')->textInput(['maxlength' => true])->label('Número documento' . '<span class="text-danger ms-1">*</span>', ['encode' => false]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'public_email')->textInput(['maxlength' => true, 'type' => 'email'])->label('Email' . '<span class="text-danger ms-1">*</span>', ['encode' => false]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->label('Teléfono') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'position')->textInput(['maxlength' => true])->label('Cargo') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'area_id')->dropDownList(ArrayHelper::map($areas, 'id', 'nombre'), ['prompt' => 'Ninguna'])->label('Área') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'cargo_id')->dropDownList(ArrayHelper::map($cargos, 'id', 'nombre'), ['prompt' => 'Ninguno'])->label('Cargo (catálogo)') ?>
            </div>
        </div>
    </div>
</div>

<hr class="mt-0 mb-3">

<!-- Address Information -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Información de dirección</h6>
            <span class="fs-13">Detalles de tu dirección</span>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Dirección') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'city')->textInput(['maxlength' => true])->label('Ciudad') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label('Ubicación') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'birthday')->input('date')->label('Fecha de nacimiento') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sexo')->dropDownList(Profile::optsSexo(), ['prompt' => ''])->label('Sexo') ?>
            </div>
        </div>
    </div>
</div>

<hr class="mt-0 mb-3">

<!-- Bio / About -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Información adicional</h6>
            <span class="fs-13">Bio y descripción</span>
        </div>
    </div>
    <div class="col-xl-8">
        <?= $form->field($model, 'bio')->textarea(['rows' => 3])->label(false) ?>
        <br>
        <?= $form->field($model, 'about')->textarea(['rows' => 3])->label(false) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>