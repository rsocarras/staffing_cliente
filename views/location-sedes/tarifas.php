<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */
/** @var array<int, string> $cargoOptions */
/** @var array<int, array<string, mixed>> $cargoTarifaValues */

$this->title = Yii::t('app', 'Tarifas por cargo: {sede}', ['sede' => (string) $model->nombre]);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-md-flex d-block align-items-center justify-content-between">
                    <div class="my-auto mb-2 mb-md-0">
                        <h4 class="fs-20 fw-bold mb-1"><?= Html::encode($this->title) ?></h4>
                        <nav>
                            <ol class="breadcrumb mb-0 py-0">
                                <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item">Configuración</li>
                                <li class="breadcrumb-item">
                                    <a href="<?= Url::to(['index']) ?>"><?= Html::encode(Yii::t('app', 'Sedes')) ?></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?= Html::encode(Yii::t('app', 'Tarifas')) ?></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <?= Html::a(
                            '<i class="ti ti-arrow-left me-1"></i>' . Yii::t('app', 'Volver a sedes'),
                            ['index'],
                            ['class' => 'btn btn-light']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                <?= Html::encode((string) Yii::$app->session->getFlash('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body py-3">
                <div class="small text-muted"><?= Html::encode(Yii::t('app', 'Sede')) ?></div>
                <div class="fw-semibold"><?= Html::encode((string) $model->nombre) ?></div>
            </div>
        </div>

        <?php $form = ActiveForm::begin([
            'action' => ['tarifas', 'id' => $model->id],
            'method' => 'post',
            'options' => ['class' => 'location-sedes-tarifas-form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{hint}\n{error}",
                'labelOptions' => ['class' => 'form-label fw-semibold mb-2'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback d-block small'],
            ],
        ]); ?>

        <?= $this->render('_cargo_tarifas_form', [
            'cargoOptions' => $cargoOptions,
            'cargoTarifaValues' => $cargoTarifaValues,
        ]) ?>

        <div class="form-group mt-4 d-flex flex-wrap gap-2">
            <?= Html::submitButton(
                '<i class="ti ti-device-floppy me-1" aria-hidden="true"></i>' . Yii::t('app', 'Guardar tarifas'),
                [
                    'class' => 'btn btn-primary',
                    'disabled' => $cargoOptions === [],
                ]
            ) ?>
            <?= Html::a(
                '<i class="ti ti-x me-1" aria-hidden="true"></i>' . Yii::t('app', 'Cancelar'),
                ['index'],
                ['class' => 'btn btn-light']
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
