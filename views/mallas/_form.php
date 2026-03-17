<?php

use app\models\MallasHorarios;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Mallas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mallas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>

    <?= $this->render('_form_fields', ['model' => $model, 'form' => $form]) ?>

    <?php
    $config = [];
    if (!empty($model->config_json)) {
        $decoded = json_decode((string) $model->config_json, true);
        if (is_array($decoded)) {
            $config = $decoded;
        }
    }
    $activeDays = $config['dias_activos'] ?? [];
    $weekStart = $config['week_range_ref']['inicio'] ?? '';
    $weekEnd = $config['week_range_ref']['fin'] ?? '';
    $shiftTemplate = $config['shift_template'] ?? '';
    $manualWork = $config['resumen_manual']['trabajo_total'] ?? '';
    $manualBreak = $config['resumen_manual']['descansos_total'] ?? '';

    $rows = [];
    foreach ($model->mallasHorarios as $h) {
        $rows[] = [
            'day' => (int) $h->dia_semana,
            'type' => (string) ($h->tipo_bloque ?: MallasHorarios::TIPO_WORK),
            'start' => substr((string) $h->hora_inicio, 0, 5),
            'end' => substr((string) $h->hora_fin, 0, 5),
            'break' => (int) $h->minutos_descanso,
        ];
    }
    ?>

    <div class="card card-body mb-3">
        <h5 class="mb-3">Configuración semanal</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Week Range (inicio)</label>
                <input type="date" class="form-control" name="week_range_inicio" value="<?= Html::encode($weekStart) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Week Range (fin)</label>
                <input type="date" class="form-control" name="week_range_fin" value="<?= Html::encode($weekEnd) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Shift Template</label>
                <input type="text" class="form-control" name="shift_template" value="<?= Html::encode($shiftTemplate) ?>" placeholder="fixed, rotating, etc.">
            </div>
        </div>
    </div>

    <div class="card card-body mb-3">
        <h5 class="mb-3">Días configurados (1=Domingo, 7=Sábado)</h5>
        <div class="d-flex flex-wrap gap-3">
            <?php
            $days = [1 => 'Dom', 2 => 'Lun', 3 => 'Mar', 4 => 'Mié', 5 => 'Jue', 6 => 'Vie', 7 => 'Sáb'];
            foreach ($days as $dayNum => $label):
                $checked = in_array($dayNum, $activeDays, true);
            ?>
                <label class="form-check-label border rounded px-2 py-1">
                    <input class="form-check-input me-1" type="checkbox" name="dias_activos[]" value="<?= $dayNum ?>" <?= $checked ? 'checked' : '' ?>>
                    <?= Html::encode($label) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card card-body mb-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Bloques de horario (turno partido permitido)</h5>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-add-block">Agregar bloque</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm align-middle" id="tabla-bloques">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Tipo</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Descanso (min)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <input type="hidden" id="horarios-json" name="horarios_json">
    </div>

    <div class="card card-body mb-3">
        <h5 class="mb-3">Resumen manual semanal</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Trabajo total manual</label>
                <input type="text" class="form-control" name="resumen_trabajo_manual" value="<?= Html::encode($manualWork) ?>" placeholder="08:00, 40h, etc.">
            </div>
            <div class="col-md-6">
                <label class="form-label">Descansos total manual</label>
                <input type="text" class="form-control" name="resumen_descanso_manual" value="<?= Html::encode($manualBreak) ?>" placeholder="01:30, 6h, etc.">
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar borrador', ['class' => 'btn btn-secondary', 'name' => 'save_action', 'value' => 'draft']) ?>
        <?= Html::submitButton('Publicar para aprobación RRHH', ['class' => 'btn btn-success', 'name' => 'save_action', 'value' => 'publish']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$seedRows = Json::htmlEncode($rows);
$blockTypes = Json::htmlEncode(array_keys(MallasHorarios::optsTipoBloque()));
$js = <<<JS
(function () {
    var rows = {$seedRows};
    var blockTypes = {$blockTypes};
    var tbody = document.querySelector('#tabla-bloques tbody');
    var addBtn = document.getElementById('btn-add-block');
    var form = document.querySelector('.mallas-form form');
    var hidden = document.getElementById('horarios-json');
    var dayOptions = [
        {id: 1, label: '1 - Domingo'},
        {id: 2, label: '2 - Lunes'},
        {id: 3, label: '3 - Martes'},
        {id: 4, label: '4 - Miércoles'},
        {id: 5, label: '5 - Jueves'},
        {id: 6, label: '6 - Viernes'},
        {id: 7, label: '7 - Sábado'}
    ];

    function createSelect(options, value) {
        var select = document.createElement('select');
        select.className = 'form-select form-select-sm';
        options.forEach(function (opt) {
            var option = document.createElement('option');
            option.value = opt.id || opt;
            option.textContent = opt.label || opt;
            if (String(option.value) === String(value)) {
                option.selected = true;
            }
            select.appendChild(option);
        });
        return select;
    }

    function addRow(data) {
        var tr = document.createElement('tr');
        var dayTd = document.createElement('td');
        var typeTd = document.createElement('td');
        var startTd = document.createElement('td');
        var endTd = document.createElement('td');
        var breakTd = document.createElement('td');
        var actionTd = document.createElement('td');

        var daySelect = createSelect(dayOptions, data.day || 1);
        daySelect.dataset.field = 'day';
        dayTd.appendChild(daySelect);

        var typeSelect = createSelect(blockTypes, data.type || 'WORK');
        typeSelect.dataset.field = 'type';
        typeTd.appendChild(typeSelect);

        var startInput = document.createElement('input');
        startInput.type = 'time';
        startInput.className = 'form-control form-control-sm';
        startInput.value = data.start || '08:00';
        startInput.dataset.field = 'start';
        startTd.appendChild(startInput);

        var endInput = document.createElement('input');
        endInput.type = 'time';
        endInput.className = 'form-control form-control-sm';
        endInput.value = data.end || '17:00';
        endInput.dataset.field = 'end';
        endTd.appendChild(endInput);

        var breakInput = document.createElement('input');
        breakInput.type = 'number';
        breakInput.min = '0';
        breakInput.className = 'form-control form-control-sm';
        breakInput.value = data.break || 0;
        breakInput.dataset.field = 'break';
        breakTd.appendChild(breakInput);

        var delBtn = document.createElement('button');
        delBtn.type = 'button';
        delBtn.className = 'btn btn-outline-danger btn-sm';
        delBtn.textContent = 'Quitar';
        delBtn.addEventListener('click', function () {
            tr.remove();
            syncHidden();
        });
        actionTd.appendChild(delBtn);

        tr.appendChild(dayTd);
        tr.appendChild(typeTd);
        tr.appendChild(startTd);
        tr.appendChild(endTd);
        tr.appendChild(breakTd);
        tr.appendChild(actionTd);
        tbody.appendChild(tr);

        tr.querySelectorAll('input, select').forEach(function (el) {
            el.addEventListener('change', syncHidden);
        });
        syncHidden();
    }

    function collectRows() {
        var payload = [];
        Array.prototype.slice.call(tbody.querySelectorAll('tr')).forEach(function (tr, index) {
            payload.push({
                day: Number(tr.querySelector('[data-field="day"]').value),
                type: tr.querySelector('[data-field="type"]').value,
                start: tr.querySelector('[data-field="start"]').value,
                end: tr.querySelector('[data-field="end"]').value,
                break: Number(tr.querySelector('[data-field="break"]').value || 0),
                order: index
            });
        });
        return payload;
    }

    function syncHidden() {
        hidden.value = JSON.stringify(collectRows());
    }

    addBtn.addEventListener('click', function () {
        addRow({});
    });

    if (!rows.length) {
        addRow({});
    } else {
        rows.forEach(addRow);
    }

    form.addEventListener('submit', function () {
        syncHidden();
    });
})();
JS;
$this->registerJs($js);
?>
