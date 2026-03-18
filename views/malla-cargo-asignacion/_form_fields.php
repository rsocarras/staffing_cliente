<?php
use app\models\Cargos;
use app\models\Mallas;
use app\models\MallaCargoAsignacion;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var MallaCargoAsignacion $model */
/** @var ActiveForm $form */

$empresaId = $model->empresa_id ? (int) $model->empresa_id : null;

$mallas = [];
$cargos = [];
if ($empresaId) {
    $mallas = ArrayHelper::map(
        Mallas::find()
            ->where(['empresa_id' => $empresaId, 'estado_aprobacion' => Mallas::ESTADO_APROBADA, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all(),
        'id',
        'nombre'
    );

    $cargos = ArrayHelper::map(
        Cargos::find()
            ->where(['empresa_id' => $empresaId, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all(),
        'id',
        'nombre'
    );
}
?>

<?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'cargo_id')->dropDownList($cargos, ['prompt' => 'Seleccione cargo']) ?>
<?= $form->field($model, 'malla_id')->dropDownList($mallas, ['prompt' => 'Seleccione malla']) ?>

