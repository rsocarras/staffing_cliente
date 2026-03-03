<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cargos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $this->render('_form_fields', [
        'model' => $model,
        'form' => $form,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$subAreasUrl = Url::to(['cargos/get-sub-areas']);
$areaId = $model->area_id ?: '';
$subAreaId = $model->sub_area_id ?: '';
$this->registerJs(<<<JS
(function() {
    var subAreasUrl = '{$subAreasUrl}';
    var areaId = '{$areaId}';
    var subAreaId = '{$subAreaId}';

    function loadSubAreas(aid, preserveVal) {
        var \$sel = $('#cargos-sub_area_id');
        \$sel.html('<option value="">Seleccione sub-área</option>');
        if (!aid) return;
        $.get(subAreasUrl, { area_id: aid }, function(data) {
            data.forEach(function(a) {
                \$sel.append('<option value="'+a.id+'">'+a.nombre+'</option>');
            });
            if (preserveVal) \$sel.val(preserveVal);
        });
    }

    $('#cargos-area_id').on('change', function() {
        loadSubAreas($(this).val());
    });

    if (areaId) loadSubAreas(areaId, subAreaId);
})();
JS
, \yii\web\View::POS_READY);
?>
