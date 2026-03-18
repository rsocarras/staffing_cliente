<?php
use app\models\Mallas;
use app\models\Profile;
use app\models\MallaProfileAsignacion;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var MallaProfileAsignacion $model */
/** @var ActiveForm $form */

$empresaId = $model->empresa_id ? (int) $model->empresa_id : null;

$mallas = [];
$profiles = [];

if ($empresaId) {
    $mallas = ArrayHelper::map(
        Mallas::find()
            ->where([
                'empresa_id' => $empresaId,
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
            ->where(['empresas_id' => $empresaId, 'estado' => Profile::ESTADO_ACTIVO])
            ->orderBy(['name' => SORT_ASC])
            ->all(),
        'user_id',
        function (Profile $profile) {
            return trim(($profile->name ?: 'Sin nombre') . ' - ' . $profile->num_doc);
        }
    );
}
?>

<?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'profile_id')->dropDownList($profiles, ['prompt' => 'Seleccione empleado']) ?>
<?= $form->field($model, 'malla_id')->dropDownList($mallas, ['prompt' => 'Seleccione malla']) ?>

