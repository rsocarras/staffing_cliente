<?php

use app\models\SupportTicket;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SupportTicket $model */
/** @var array<int, string> $empresaClienteOptions */

$this->title = 'Nueva solicitud de soporte';
?>

<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1"><?= Html::encode($this->title) ?></h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-smart-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= Url::to(['/support-ticket/index']) ?>">Tickets de soporte</a></li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
            <div class="row g-3">
                <div class="col-md-8">
                    <?= $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => 'Resumen corto del problema']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'priority')->dropDownList(SupportTicket::priorityOptions()) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'empresa_cliente_id')->dropDownList($empresaClienteOptions, ['prompt' => 'Seleccionar cliente / NIT']) ?>
                </div>
                <div class="col-12">
                    <?= $form->field($model, 'description')->textarea([
                        'rows' => 8,
                        'placeholder' => 'Describa el requerimiento, impacto y cualquier dato relevante para Staffing.',
                    ]) ?>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Enviar ticket</button>
                <a href="<?= Url::to(['/support-ticket/index']) ?>" class="btn btn-light">Cancelar</a>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
