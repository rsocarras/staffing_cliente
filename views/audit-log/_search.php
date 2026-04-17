<?php

declare(strict_types=1);

use app\models\AuditLog;
use app\models\search\AuditLogSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var AuditLogSearch $model */
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => ['class' => 'row g-3'],
]); ?>

<div class="col-md-6 col-lg-4 col-xl-3">
    <?= $form->field($model, 'table_name')->textInput([
        'placeholder' => Yii::t('app', 'Tabla'),
        'class' => 'form-control',
    ])->label(Yii::t('app', 'Tabla')) ?>
</div>
<div class="col-md-6 col-lg-4 col-xl-3">
    <?= $form->field($model, 'action')->dropDownList(
        ['' => '—'] + AuditLog::actionOptions(),
        ['class' => 'form-select']
    )->label(Yii::t('app', 'Acción')) ?>
</div>
<div class="col-md-6 col-lg-4 col-xl-3">
    <?= $form->field($model, 'username')->textInput([
        'placeholder' => Yii::t('app', 'Usuario'),
        'class' => 'form-control',
    ])->label(Yii::t('app', 'Usuario')) ?>
</div>
<div class="col-md-6 col-lg-4 col-xl-3">
    <?= $form->field($model, 'record_pk')->textInput([
        'placeholder' => 'JSON / id',
        'class' => 'form-control',
    ])->label(Yii::t('app', 'Clave (texto)')) ?>
</div>
<div class="col-md-6 col-lg-4 col-xl-3">
    <?= $form->field($model, 'created_from')->input('date', ['class' => 'form-control'])->label(Yii::t('app', 'Desde')) ?>
</div>
<div class="col-md-6 col-lg-4 col-xl-3">
    <?= $form->field($model, 'created_to')->input('date', ['class' => 'form-control'])->label(Yii::t('app', 'Hasta')) ?>
</div>
<div class="col-12 d-flex flex-wrap gap-2 align-items-end">
    <?= Html::submitButton(Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Limpiar'), ['index'], ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>
