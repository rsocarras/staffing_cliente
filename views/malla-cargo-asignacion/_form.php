<?php

use app\models\Cargos;
use app\models\Mallas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MallaCargoAsignacion $model */
/** @var yii\widgets\ActiveForm $form */

$mallas = ArrayHelper::map(
    Mallas::find()
        ->where([
            'empresa_id' => $model->empresa_id,
            'estado_aprobacion' => Mallas::ESTADO_APROBADA,
            'activo' => 1,
        ])
        ->orderBy(['nombre' => SORT_ASC])
        ->all(),
    'id',
    'nombre'
);

$cargos = ArrayHelper::map(
    Cargos::find()
        ->where(['empresa_id' => $model->empresa_id, 'activo' => 1])
        ->orderBy(['nombre' => SORT_ASC])
        ->all(),
    'id',
    'nombre'
);
?>

<div class="malla-cargo-asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'cargo_id')->dropDownList($cargos, ['prompt' => 'Seleccione cargo']) ?>
    <?= $form->field($model, 'malla_id')->dropDownList($mallas, ['prompt' => 'Seleccione malla']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
