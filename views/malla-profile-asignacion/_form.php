<?php

use app\models\Mallas;
use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MallaProfileAsignacion $model */
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

$profiles = ArrayHelper::map(
    Profile::find()
        ->where(['empresas_id' => $model->empresa_id, 'estado' => Profile::ESTADO_ACTIVO])
        ->orderBy(['name' => SORT_ASC])
        ->all(),
    'user_id',
    function (Profile $profile) {
        return trim(($profile->name ?: 'Sin nombre') . ' - ' . $profile->num_doc);
    }
);
?>

<div class="malla-profile-asignacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>
    <?= $form->field($model, 'profile_id')->dropDownList($profiles, ['prompt' => 'Seleccione empleado']) ?>
    <?= $form->field($model, 'malla_id')->dropDownList($mallas, ['prompt' => 'Seleccione malla']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
