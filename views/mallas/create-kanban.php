<?php

use app\models\Mallas;
use app\models\MallasHorarios;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\Mallas $model */
/** @var bool $readOnly */
/** @var array|null $weekContext */

$readOnly = $readOnly ?? false;
$weekContext = is_array($weekContext ?? null) ? $weekContext : [];

$this->title = $model->isNewRecord ? 'Creador de Turno Semanal' : 'Editor de Turno Semanal';
$this->params['breadcrumbs'][] = ['label' => 'Mallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$days = [
    ['id' => 1, 'label' => 'Domingo', 'short' => 'DOM'],
    ['id' => 2, 'label' => 'Lunes', 'short' => 'LUN'],
    ['id' => 3, 'label' => 'Martes', 'short' => 'MAR'],
    ['id' => 4, 'label' => 'Miércoles', 'short' => 'MIE'],
    ['id' => 5, 'label' => 'Jueves', 'short' => 'JUE'],
    ['id' => 6, 'label' => 'Viernes', 'short' => 'VIE'],
    ['id' => 7, 'label' => 'Sábado', 'short' => 'SAB'],
];

$weekDays = [];
foreach ((array) ($weekContext['days'] ?? []) as $item) {
    $weekDays[(int) ($item['id'] ?? 0)] = $item;
}

$days = array_map(static function (array $day) use ($weekDays) {
    $meta = $weekDays[(int) $day['id']] ?? [];

    return array_merge($day, [
        'date' => (string) ($meta['date'] ?? ''),
        'dayNumber' => (string) ($meta['dayNumber'] ?? ''),
        'monthShort' => (string) ($meta['monthShort'] ?? ''),
        'weekdayIndex' => (int) ($meta['weekdayIndex'] ?? 0),
        'isSunday' => (bool) ($meta['isSunday'] ?? false),
        'isHoliday' => (bool) ($meta['isHoliday'] ?? false),
        'isSpecial' => (bool) ($meta['isSpecial'] ?? false),
        'holidayName' => (string) ($meta['holidayName'] ?? ''),
        'specialLabel' => (string) ($meta['specialLabel'] ?? ''),
    ]);
}, $days);

$initialBoard = [
    'id' => $model->isNewRecord ? null : (int) $model->id,
    'nombre' => (string) ($model->nombre ?? ''),
    'descripcion' => (string) ($model->descripcion ?? ''),
    'tipo' => (string) ($model->tipo ?: Mallas::TIPO_FIJA),
    'activo' => (int) ($model->activo ?? 1),
    'estado' => (string) ($model->estado_aprobacion ?: Mallas::ESTADO_DRAFT),
    'estadoLabel' => (string) $model->displayEstadoAprobacion(),
    'persistUrl' => $model->isNewRecord ? null : Url::current(),
];

$selectedWeekStart = (string) ($weekContext['weekStart'] ?? date('Y-m-d'));
$selectedWeekEnd = (string) ($weekContext['weekEnd'] ?? $selectedWeekStart);
$weekRangeLabel = (string) ($weekContext['weekRangeLabel'] ?? '');

$initialBlocks = array_map(static function (MallasHorarios $row) {
    return [
        'id' => (int) $row->id,
        'malla_id' => (int) $row->malla_id,
        'day' => (int) $row->dia_semana,
        'type' => (string) $row->tipo_bloque,
        'start' => substr((string) $row->hora_inicio, 0, 5),
        'end' => substr((string) $row->hora_fin, 0, 5),
        'break' => (int) $row->minutos_descanso,
        'order' => (int) $row->orden,
    ];
}, $model->mallasHorarios);

$urls = [
    'index' => Url::to(['index']),
    'createPage' => Url::to(['create-kanban']),
    'initBoard' => Url::to(['/mallas-horarios/init-board-ajax']),
    'saveBoard' => Url::to(['/mallas-horarios/save-board-ajax']),
    'createBlock' => Url::to(['/mallas-horarios/create-block-ajax']),
    'updateBlock' => Url::to(['/mallas-horarios/update-block-ajax']),
    'deleteBlock' => Url::to(['/mallas-horarios/delete-block-ajax']),
    'clearDay' => Url::to(['/mallas-horarios/clear-day-ajax']),
];

$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();

$hourRows = [];
for ($hour = 0; $hour < 24; $hour++) {
    $hourRows[] = [
        'value' => sprintf('%02d:00', $hour),
        'label' => sprintf('%02d:00', $hour),
    ];
}

$css = <<<'CSS'
.scheduler-shell {
    background: #ffffff;
    border: 1px solid #e5e9f2;
    border-radius: 16px;
    box-shadow: none;
    padding: 14px;
}

.scheduler-hero {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: flex-start;
    margin-bottom: 12px;
}

.scheduler-hero__eyebrow {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 4px;
}

.scheduler-hero h1 {
    font-size: 1.9rem;
    line-height: 1.02;
    margin: 0 0 6px;
    color: #0f172a;
    letter-spacing: -0.04em;
}

.scheduler-hero p {
    margin: 0;
    font-size: 0.88rem;
    color: #5b6b84;
    max-width: 700px;
}

.scheduler-statusline {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 8px;
}

.scheduler-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border-radius: 999px;
    padding: 5px 10px;
    font-size: 0.76rem;
    font-weight: 700;
    border: 1px solid transparent;
}

.scheduler-status-badge[data-state="draft"] {
    background: #fff4d6;
    color: #b45309;
    border-color: #fcd34d;
}

.scheduler-status-badge[data-state="pendiente_aprobacion"] {
    background: #dbeafe;
    color: #1d4ed8;
    border-color: #93c5fd;
}

.scheduler-status-badge[data-state="aprobada"] {
    background: #dcfce7;
    color: #166534;
    border-color: #86efac;
}

.scheduler-status-badge[data-state="rechazada"] {
    background: #fee2e2;
    color: #b91c1c;
    border-color: #fca5a5;
}

.scheduler-board-id {
    color: #64748b;
    font-size: 0.78rem;
    font-weight: 600;
}

.scheduler-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.scheduler-actions .btn {
    min-width: 128px;
    min-height: 38px;
    border-radius: 10px;
    font-weight: 700;
    padding: 0.38rem 0.9rem;
}

.scheduler-actions .btn-primary {
    box-shadow: 0 10px 22px rgba(37, 99, 235, 0.2);
}

.scheduler-banner {
    display: none;
    margin-bottom: 10px;
    border-radius: 12px;
    border: 1px solid rgba(148, 163, 184, 0.2);
    padding: 0.55rem 0.8rem;
}

.scheduler-meta-grid {
    display: grid;
    grid-template-columns: 2fr 2fr 1fr 1fr;
    gap: 10px;
    margin-bottom: 10px;
}

.scheduler-field {
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    border: 1px solid #d8e3f1;
    border-radius: 14px;
    padding: 10px 12px;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7);
}

.scheduler-field label {
    display: block;
    margin-bottom: 6px;
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #6b7d96;
}

.scheduler-field .form-control,
.scheduler-field .form-select {
    border-radius: 10px;
    border-color: #d6e2f1;
    min-height: 38px;
    box-shadow: none;
    padding-top: 0.38rem;
    padding-bottom: 0.38rem;
}

.scheduler-shell--readonly .scheduler-field .form-control[readonly],
.scheduler-shell--readonly .scheduler-field .form-select:disabled {
    background: #f8fafc;
    color: #475569;
    opacity: 1;
}

.scheduler-calendar__hintbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 8px;
    padding: 8px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #f8fbff;
}

.scheduler-calendar__toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.scheduler-week-filter {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 0;
    border: none;
    border-radius: 0;
    background: transparent;
}

.scheduler-week-filter label {
    margin: 0;
    font-size: 0.66rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #64748b;
}

.scheduler-week-filter .form-control {
    min-height: 34px;
    border-radius: 8px;
    border-color: #d6e2f1;
    box-shadow: none;
    min-width: 148px;
}

.scheduler-week-filter__range {
    color: #475569;
    font-size: 0.76rem;
    font-weight: 700;
    white-space: nowrap;
}

.scheduler-special-summary {
    margin-bottom: 10px;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 8px;
}

.scheduler-special-summary__card {
    background: #f8fbff;
    border: 1px solid #dbe4f0;
    border-radius: 12px;
    padding: 9px 11px;
    display: flex;
    align-items: baseline;
    gap: 10px;
}

.scheduler-special-summary__card small {
    display: block;
    margin-bottom: 0;
    font-size: 0.64rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #64748b;
}

.scheduler-special-summary__card strong {
    display: block;
    min-width: 64px;
    font-size: 1.05rem;
    line-height: 1;
    letter-spacing: -0.03em;
    color: #0f172a;
}

.scheduler-special-summary__card p {
    margin: 2px 0 0;
    color: #64748b;
    font-weight: 700;
    font-size: 0.72rem;
    line-height: 1.2;
}

.scheduler-special-summary__body {
    min-width: 0;
}

.scheduler-calendar__hint {
    color: #60728d;
    font-weight: 600;
    font-size: 0.88rem;
}

.scheduler-calendar {
    border: 1px solid #dbe4f0;
    border-radius: 18px;
    overflow: auto;
    background: #ffffff;
}

.scheduler-calendar__frame {
    min-width: 1080px;
}

.scheduler-calendar__head {
    display: grid;
    grid-template-columns: 72px repeat(7, minmax(138px, 1fr));
    background: #f8fbff;
    border-bottom: 1px solid #dbe4f0;
}

.scheduler-calendar__corner {
    border-right: 1px solid #dbe4f0;
    background: #f8fbff;
}

.scheduler-calendar__head-day {
    padding: 10px 10px;
    border-right: 1px solid #dbe4f0;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 8px;
}

.scheduler-calendar__head-day:last-child {
    border-right: none;
}

.scheduler-calendar__head-day small {
    display: block;
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #74849b;
    margin-bottom: 4px;
}

.scheduler-calendar__head-day strong {
    display: block;
    font-size: 1rem;
    letter-spacing: -0.03em;
    color: #0f172a;
}

.scheduler-calendar__date {
    display: inline-flex;
    margin-top: 4px;
    font-size: 0.74rem;
    font-weight: 700;
    color: #64748b;
}

.scheduler-calendar__day-badge {
    display: inline-flex;
    margin-top: 6px;
    padding: 3px 8px;
    border-radius: 999px;
    background: #fff4d6;
    color: #b45309;
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.scheduler-calendar__head-total {
    text-align: right;
    min-width: 62px;
}

.scheduler-calendar__head-total span {
    display: block;
    font-size: 0.66rem;
    font-weight: 700;
    color: #8b9bb1;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.scheduler-calendar__head-total strong {
    margin-top: 4px;
    font-size: 0.82rem;
}

.scheduler-calendar__head-total em {
    display: block;
    margin-top: 4px;
    font-style: normal;
    font-size: 0.68rem;
    font-weight: 800;
    color: #b45309;
}

.scheduler-calendar__body {
    display: grid;
    grid-template-columns: 72px minmax(0, 1fr);
    max-height: 760px;
    overflow: auto;
}

.scheduler-calendar__times {
    border-right: 1px solid #dbe4f0;
    background: #fbfdff;
}

.scheduler-calendar__time {
    height: 32px;
    padding: 0 10px;
    border-bottom: 1px solid #edf2f7;
    font-size: 0.74rem;
    font-weight: 700;
    color: #7a8ca5;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    transform: translateY(-5px);
}

.scheduler-calendar__columns {
    display: grid;
    grid-template-columns: repeat(7, minmax(138px, 1fr));
}

.scheduler-calendar__column {
    position: relative;
    border-right: 1px solid #dbe4f0;
    background: #ffffff;
}

.scheduler-calendar__column:last-child {
    border-right: none;
}

.scheduler-calendar__slot-grid {
    display: grid;
    grid-template-rows: repeat(24, 32px);
}

.scheduler-calendar__slot {
    border: none;
    border-bottom: 1px solid #edf2f7;
    background:
        linear-gradient(180deg, rgba(248, 251, 255, 0.4) 0%, rgba(255, 255, 255, 0.2) 100%);
    width: 100%;
    padding: 0;
    cursor: pointer;
}

.scheduler-calendar__slot:hover {
    background: #eef5ff;
}

.scheduler-shell--readonly .scheduler-calendar__slot {
    cursor: default;
}

.scheduler-shell--readonly .scheduler-calendar__slot:hover {
    background:
        linear-gradient(180deg, rgba(248, 251, 255, 0.4) 0%, rgba(255, 255, 255, 0.2) 100%);
}

.scheduler-calendar__events {
    position: absolute;
    inset: 0 4px 0 4px;
    pointer-events: none;
}

.scheduler-calendar__empty {
    position: absolute;
    inset: 12px 6px auto;
    pointer-events: none;
    color: #a0aec0;
    font-size: 0.72rem;
    font-weight: 700;
    text-align: center;
}

.calendar-event {
    position: absolute;
    left: 0;
    right: 0;
    margin: 2px 0;
    border-radius: 12px;
    border: 1px solid transparent;
    padding: 6px 8px;
    text-align: left;
    pointer-events: auto;
    cursor: pointer;
    box-shadow: 0 8px 16px rgba(15, 23, 42, 0.06);
    overflow: hidden;
}

.scheduler-shell--readonly .calendar-event {
    cursor: default;
}

.calendar-event--work {
    background: linear-gradient(180deg, #e4efff 0%, #d6e7ff 100%);
    border-color: #b9d2ff;
    color: #1549a3;
}

.calendar-event--break {
    background: linear-gradient(180deg, #fff5d2 0%, #ffe8a4 100%);
    border-color: #f5d670;
    color: #a45a00;
}

.calendar-event--off {
    background: linear-gradient(180deg, #edf2f7 0%, #dfe8f3 100%);
    border-color: #cad7e5;
    color: #475569;
}

.calendar-event__time {
    display: block;
    font-size: 0.74rem;
    font-weight: 800;
    line-height: 1.2;
}

.calendar-event__meta {
    display: block;
    margin-top: 2px;
    font-size: 0.62rem;
    font-weight: 700;
    opacity: 0.85;
    line-height: 1.2;
}

.calendar-event--off .calendar-event__time {
    margin-top: 6px;
}

.scheduler-summary {
    margin-top: 10px;
    display: grid;
    grid-template-columns: 1.1fr 1fr 1fr 1.4fr;
    gap: 8px;
}

.scheduler-summary__card,
.scheduler-summary__alerts {
    background: #f8fbff;
    border: 1px solid #dbe4f0;
    border-radius: 12px;
    padding: 10px 12px;
    box-shadow: none;
}

.scheduler-summary__card {
    display: flex;
    align-items: baseline;
    gap: 10px;
}

.scheduler-summary__card small,
.scheduler-summary__alerts small {
    display: block;
    margin-bottom: 5px;
    font-size: 0.64rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #64748b;
}

.scheduler-summary__card strong {
    display: block;
    min-width: 64px;
    font-size: 1.15rem;
    line-height: 1;
    letter-spacing: -0.03em;
    color: #0f172a;
}

.scheduler-summary__card p {
    margin: 3px 0 0;
    color: #8b9bb1;
    font-weight: 700;
    font-size: 0.72rem;
    line-height: 1.2;
}

.scheduler-summary__body {
    min-width: 0;
}

.scheduler-summary__alerts {
    border-color: #fecaca;
    background: #fff7f5;
}

.scheduler-summary__alerts ul {
    margin: 0;
    padding-left: 16px;
    color: #b42318;
    font-size: 0.74rem;
}

.scheduler-summary__alerts li + li {
    margin-top: 4px;
}

.scheduler-summary__alerts--empty {
    border-color: #dbe4f0;
    background: #f8fbff;
}

.scheduler-summary__alerts--empty ul {
    padding-left: 0;
    list-style: none;
    color: #64748b;
}

.scheduler-loading {
    opacity: 0.65;
    pointer-events: none;
}

.scheduler-modal__color-preview {
    height: 12px;
    border-radius: 999px;
    margin-top: 10px;
}

.scheduler-modal__color-preview[data-type="WORK"] {
    background: linear-gradient(90deg, #dbeafe 0%, #93c5fd 100%);
}

.scheduler-modal__color-preview[data-type="BREAK"] {
    background: linear-gradient(90deg, #fef3c7 0%, #fcd34d 100%);
}

.scheduler-modal__color-preview[data-type="OFF"] {
    background: linear-gradient(90deg, #e2e8f0 0%, #94a3b8 100%);
}

@media (max-width: 1400px) {
    .scheduler-meta-grid {
        grid-template-columns: 1fr 1fr;
    }

    .scheduler-special-summary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .scheduler-summary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 991px) {
    .scheduler-shell {
        padding: 12px;
        border-radius: 14px;
    }

    .scheduler-hero {
        flex-direction: column;
    }

    .scheduler-hero h1 {
        font-size: 1.7rem;
    }

    .scheduler-actions {
        width: 100%;
        justify-content: stretch;
    }

    .scheduler-actions .btn {
        flex: 1 1 140px;
    }

    .scheduler-calendar__body {
        max-height: 680px;
    }
}

@media (max-width: 767px) {
    .scheduler-special-summary,
    .scheduler-meta-grid,
    .scheduler-summary {
        grid-template-columns: 1fr;
    }

    .scheduler-shell {
        padding: 10px;
    }

    .scheduler-hero h1 {
        font-size: 1.45rem;
    }

    .scheduler-calendar__hintbar {
        align-items: flex-start;
    }

    .scheduler-week-filter {
        width: 100%;
        align-items: flex-start;
        flex-direction: column;
    }
}
CSS;
$this->registerCss($css);

$jsTemplate = <<<'JS'
(function () {
    var boardState = __INITIAL_BOARD__;
    var blocksState = __INITIAL_BLOCKS__;
    var readOnly = __READ_ONLY__;
    var dayMeta = __DAY_META__;
    var weekContext = __WEEK_CONTEXT__;
    var urls = __URLS__;
    var csrfParam = __CSRF_PARAM__;
    var csrfToken = __CSRF_TOKEN__;
    var hourRows = __HOUR_ROWS__;
    var typeOptions = ['WORK', 'BREAK', 'OFF'];
    var stateLabels = {
        draft: 'Borrador',
        pendiente_aprobacion: 'Pendiente aprobación',
        aprobada: 'Aprobada',
        rechazada: 'Rechazada'
    };

    var banner = document.getElementById('scheduler-banner');
    var boardElement = document.getElementById('scheduler-board');
    var nameInput = document.getElementById('kanban-nombre');
    var descriptionInput = document.getElementById('kanban-descripcion');
    var typeInput = document.getElementById('kanban-tipo');
    var activeInput = document.getElementById('kanban-activo');
    var boardIdLabel = document.getElementById('scheduler-board-id');
    var statusBadge = document.getElementById('scheduler-status-badge');
    var saveDraftBtn = document.getElementById('kanban-save-draft');
    var publishBtn = document.getElementById('kanban-publish');
    var cancelBtn = document.getElementById('kanban-cancel');
    var weekStartInput = document.getElementById('scheduler-week-start');
    var modalEl = document.getElementById('scheduler-block-modal');
    var blockModal = modalEl ? new bootstrap.Modal(modalEl) : null;
    var modalTitle = document.getElementById('scheduler-modal-title');
    var modalErrors = document.getElementById('scheduler-modal-errors');
    var modalDayInput = document.getElementById('scheduler-modal-day');
    var modalTypeInput = document.getElementById('scheduler-modal-type');
    var modalStartInput = document.getElementById('scheduler-modal-start');
    var modalEndInput = document.getElementById('scheduler-modal-end');
    var modalDeleteBtn = document.getElementById('scheduler-modal-delete');
    var modalSaveBtn = document.getElementById('scheduler-modal-save');
    var modalColor = document.getElementById('scheduler-modal-color');
    var slotHeight = 32;
    var modalState = {
        mode: 'create',
        blockId: null,
        seedStart: '08:00'
    };

    weekContext.weekStart = weekContext.weekStart || '';
    weekContext.weekEnd = weekContext.weekEnd || '';
    weekContext.holidayDates = Array.isArray(weekContext.holidayDates) ? weekContext.holidayDates : [];
    weekContext.nightStartMinutes = timeToMinutes(weekContext.nightStart || '21:00');
    weekContext.nightEndMinutes = timeToMinutes(weekContext.nightEnd || '06:00');

    function showBanner(kind, messages) {
        var items = Array.isArray(messages) ? messages : [messages];
        banner.className = 'alert scheduler-banner alert-' + kind;
        banner.innerHTML = items.join('<br>');
        banner.style.display = 'block';
    }

    function hideBanner() {
        banner.style.display = 'none';
        banner.innerHTML = '';
    }

    function hasVisibleBanner() {
        return banner.style.display !== 'none' && banner.innerHTML.trim() !== '';
    }

    function setBoardLoading(loading) {
        boardElement.classList.toggle('scheduler-loading', loading);
        cancelBtn.disabled = loading;
        saveDraftBtn.disabled = readOnly || loading;
        publishBtn.disabled = readOnly || loading;
    }

    function ajaxJson(options) {
        var ajaxOptions = Object.assign({}, options || {});
        var data = ajaxOptions.data;

        if ($.isPlainObject(data)) {
            ajaxOptions.data = Object.assign({}, data);
            ajaxOptions.data[csrfParam] = csrfToken;
        } else if (!data) {
            ajaxOptions.data = {};
            ajaxOptions.data[csrfParam] = csrfToken;
        }

        ajaxOptions.headers = Object.assign({}, ajaxOptions.headers || {}, {
            'X-CSRF-Token': csrfToken
        });

        return new Promise(function (resolve, reject) {
            $.ajax(ajaxOptions).done(resolve).fail(reject);
        });
    }

    function boardPayload() {
        return {
            nombre: nameInput.value.trim(),
            descripcion: descriptionInput.value.trim(),
            tipo: typeInput.value,
            activo: activeInput.value
        };
    }

    function hasUnsavedHeaderChanges() {
        var payload = boardPayload();
        if (!boardState.id) {
            return payload.nombre !== '' || payload.descripcion !== '' || blocksState.length > 0;
        }

        return payload.nombre !== String(boardState.nombre || '').trim()
            || payload.descripcion !== String(boardState.descripcion || '').trim()
            || payload.tipo !== String(boardState.tipo || '')
            || String(payload.activo) !== String(boardState.activo);
    }

    function applyBoardState(partial) {
        boardState = Object.assign({}, boardState, partial || {});
        statusBadge.dataset.state = boardState.estado || 'draft';
        statusBadge.textContent = boardState.estadoLabel || stateLabels[boardState.estado] || 'Borrador';
        boardIdLabel.textContent = boardState.id ? ('Malla #' + boardState.id) : 'Sin guardar';
        if (boardState.id) {
            var nextUrl = boardState.persistUrl || boardState.editUrl || (urls.createPage + '?id=' + boardState.id);
            var currentUrl = window.location.pathname + window.location.search;
            if (currentUrl !== nextUrl) {
                window.history.replaceState({}, '', nextUrl);
            }
        }
    }

    function getBlocksForDay(day) {
        return blocksState
            .filter(function (block) { return Number(block.day) === Number(day); })
            .sort(function (a, b) {
                if (String(a.start) !== String(b.start)) {
                    return String(a.start).localeCompare(String(b.start));
                }
                if (Number(a.order) !== Number(b.order)) {
                    return Number(a.order) - Number(b.order);
                }
                return Number(a.id) - Number(b.id);
            });
    }

    function formatMinutes(totalMinutes) {
        var safe = Math.max(0, Number(totalMinutes) || 0);
        var hours = Math.floor(safe / 60);
        var minutes = safe % 60;
        return String(hours).padStart(2, '0') + 'h ' + String(minutes).padStart(2, '0') + 'm';
    }

    function timeToMinutes(value) {
        if (!/^\d{2}:\d{2}$/.test(value)) {
            return null;
        }
        var parts = value.split(':');
        var hours = Number(parts[0]);
        var minutes = Number(parts[1]);
        if (hours < 0 || hours > 23 || minutes < 0 || minutes > 59) {
            return null;
        }
        return (hours * 60) + minutes;
    }

    function addMinutes(value, amount) {
        var total = timeToMinutes(value);
        if (total === null) {
            return value;
        }
        var next = (total + amount) % 1440;
        if (next < 0) {
            next += 1440;
        }
        var hours = Math.floor(next / 60);
        var minutes = next % 60;
        return String(hours).padStart(2, '0') + ':' + String(minutes).padStart(2, '0');
    }

    function defaultRangeByType(type, seedStart) {
        if (type === 'OFF') {
            return { start: '00:00', end: '23:59' };
        }

        var start = /^\d{2}:\d{2}$/.test(seedStart || '')
            ? seedStart
            : (type === 'BREAK' ? '12:00' : '08:00');

        return {
            start: start,
            end: addMinutes(start, 60)
        };
    }

    function durationMinutes(start, end) {
        var startMin = timeToMinutes(start);
        var endMin = timeToMinutes(end);
        if (startMin === null || endMin === null || startMin === endMin) {
            return 0;
        }
        return endMin > startMin ? (endMin - startMin) : ((1440 - startMin) + endMin);
    }

    function isProductiveBlock(block) {
        return block && block.type !== 'BREAK' && block.type !== 'OFF';
    }

    function addDays(dateYmd, amount) {
        var parts = String(dateYmd || '').split('-');
        if (parts.length !== 3) {
            return '';
        }
        var date = new Date(Date.UTC(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2])));
        if (Number.isNaN(date.getTime())) {
            return '';
        }
        date.setUTCDate(date.getUTCDate() + Number(amount || 0));
        return date.toISOString().slice(0, 10);
    }

    function isWithinSelectedWeek(dateYmd) {
        return dateYmd >= weekContext.weekStart && dateYmd <= weekContext.weekEnd;
    }

    function isSpecialDate(dateYmd) {
        if (!dateYmd) {
            return false;
        }
        var dayInfo = dayMeta.find(function (item) {
            return item.date === dateYmd;
        });
        if (dayInfo && dayInfo.isSpecial) {
            return true;
        }
        return Array.isArray(weekContext.holidayDates) && weekContext.holidayDates.indexOf(dateYmd) !== -1;
    }

    function isNightMinute(minute) {
        var start = Number(weekContext.nightStartMinutes);
        var end = Number(weekContext.nightEndMinutes);

        if (Number.isNaN(start) || Number.isNaN(end)) {
            return false;
        }

        if (start === end) {
            return true;
        }

        if (start < end) {
            return minute >= start && minute < end;
        }

        return minute >= start || minute < end;
    }

    function splitSegmentByNight(segment) {
        var points = [segment.start, segment.end];
        [weekContext.nightStartMinutes, weekContext.nightEndMinutes].forEach(function (boundary) {
            var numeric = Number(boundary);
            if (!Number.isNaN(numeric) && numeric > segment.start && numeric < segment.end) {
                points.push(numeric);
            }
        });

        points.sort(function (a, b) {
            return a - b;
        });

        var fragments = [];
        for (var index = 0; index < points.length - 1; index += 1) {
            if (points[index + 1] <= points[index]) {
                continue;
            }
            fragments.push({
                day: segment.day,
                date: segment.date,
                start: points[index],
                end: points[index + 1]
            });
        }

        return fragments;
    }

    function expandSegmentsForAlerts(block) {
        var startMin = timeToMinutes(block.start);
        var endMin = timeToMinutes(block.end);
        if (startMin === null || endMin === null || startMin === endMin) {
            return [];
        }
        if (endMin > startMin) {
            return [{ day: Number(block.day), start: startMin, end: endMin }];
        }
        return [
            { day: Number(block.day), start: startMin, end: 1440 },
            { day: (Number(block.day) % 7) + 1, start: 0, end: endMin }
        ];
    }

    function expandSegmentsForWeek(block) {
        var startMin = timeToMinutes(block.start);
        var endMin = timeToMinutes(block.end);
        var baseDay = Number(block.day);
        var baseDate = (dayMeta.find(function (item) {
            return Number(item.id) === baseDay;
        }) || {}).date || '';

        if (startMin === null || endMin === null || startMin === endMin || !baseDate) {
            return [];
        }

        if (endMin > startMin) {
            return [{
                day: baseDay,
                date: baseDate,
                start: startMin,
                end: endMin
            }];
        }

        var segments = [{
            day: baseDay,
            date: baseDate,
            start: startMin,
            end: 1440
        }];

        if (baseDay === 7) {
            segments.push({
                day: 1,
                date: weekContext.weekStart,
                start: 0,
                end: endMin
            });
            return segments;
        }

        segments.push({
            day: baseDay + 1,
            date: addDays(baseDate, 1),
            start: 0,
            end: endMin
        });

        return segments.filter(function (segment) {
            return isWithinSelectedWeek(segment.date);
        });
    }

    function classifyFragment(fragment) {
        var minutes = fragment.end - fragment.start;
        var midpoint = fragment.start + Math.floor(minutes / 2);
        var night = isNightMinute(midpoint);
        var special = isSpecialDate(fragment.date);

        if (special && night) {
            return 'specialNight';
        }
        if (special) {
            return 'specialDay';
        }
        if (night) {
            return 'ordinaryNight';
        }

        return 'ordinaryDay';
    }

    function computeSummary(blocks) {
        var work = 0;
        var breaks = 0;
        var configured = {};
        var dayTotals = {};
        var alerts = [];
        var categoryTotals = {
            ordinaryDay: 0,
            ordinaryNight: 0,
            specialDay: 0,
            specialNight: 0
        };

        for (var day = 1; day <= 7; day += 1) {
            dayTotals[day] = {
                minutes: 0,
                label: formatMinutes(0),
                specialMinutes: 0,
                specialLabel: formatMinutes(0)
            };
        }

        blocks.forEach(function (block) {
            if (block.type === 'BREAK') {
                breaks += durationMinutes(block.start, block.end);
                return;
            }

            if (!isProductiveBlock(block)) {
                return;
            }

            expandSegmentsForWeek(block).forEach(function (segment) {
                var segmentMinutes = Math.max(0, segment.end - segment.start);
                if (segmentMinutes <= 0) {
                    return;
                }

                work += segmentMinutes;
                dayTotals[segment.day].minutes += segmentMinutes;
                configured[segment.day] = true;

                splitSegmentByNight(segment).forEach(function (fragment) {
                    var fragmentMinutes = Math.max(0, fragment.end - fragment.start);
                    var bucket = classifyFragment(fragment);
                    categoryTotals[bucket] += fragmentMinutes;
                    if (bucket === 'specialDay' || bucket === 'specialNight') {
                        dayTotals[segment.day].specialMinutes += fragmentMinutes;
                    }
                });
            });
        });

        Object.keys(dayTotals).forEach(function (dayKey) {
            dayTotals[dayKey].label = formatMinutes(dayTotals[dayKey].minutes);
            dayTotals[dayKey].specialLabel = formatMinutes(dayTotals[dayKey].specialMinutes);
        });

        var segmentsByDay = {};
        blocks.forEach(function (block) {
            expandSegmentsForAlerts(block).forEach(function (segment) {
                segmentsByDay[segment.day] = segmentsByDay[segment.day] || [];
                segmentsByDay[segment.day].push(segment);
            });
        });

        Object.keys(segmentsByDay).forEach(function (dayKey) {
            var daySegments = segmentsByDay[dayKey].sort(function (a, b) {
                return a.start - b.start;
            });
            for (var i = 1; i < daySegments.length; i += 1) {
                if (daySegments[i].start < daySegments[i - 1].end) {
                    var dayInfo = dayMeta.find(function (item) {
                        return Number(item.id) === Number(dayKey);
                    });
                    alerts.push('Hay solape de bloques en ' + (dayInfo ? dayInfo.label.toLowerCase() : ('día ' + dayKey)) + '.');
                    break;
                }
            }
        });

        return {
            workLabel: formatMinutes(work),
            breakLabel: formatMinutes(breaks),
            configuredLabel: Object.keys(configured).length + '/7',
            ordinaryDayLabel: formatMinutes(categoryTotals.ordinaryDay),
            ordinaryNightLabel: formatMinutes(categoryTotals.ordinaryNight),
            specialDayLabel: formatMinutes(categoryTotals.specialDay),
            specialNightLabel: formatMinutes(categoryTotals.specialNight),
            dayTotals: dayTotals,
            alerts: alerts
        };
    }

    function renderSummary(summary) {
        var resolved = computeSummary(blocksState);
        document.getElementById('summary-ordinary-day').textContent = resolved.ordinaryDayLabel;
        document.getElementById('summary-ordinary-night').textContent = resolved.ordinaryNightLabel;
        document.getElementById('summary-special-day').textContent = resolved.specialDayLabel;
        document.getElementById('summary-special-night').textContent = resolved.specialNightLabel;
        document.getElementById('summary-work').textContent = resolved.workLabel;
        document.getElementById('summary-breaks').textContent = resolved.breakLabel;
        document.getElementById('summary-days').textContent = resolved.configuredLabel;

        var alertsBox = document.getElementById('scheduler-alerts');
        if (resolved.alerts && resolved.alerts.length) {
            alertsBox.className = 'scheduler-summary__alerts';
            alertsBox.innerHTML = '<small>Alertas de conflicto</small><ul>' + resolved.alerts.map(function (item) {
                return '<li>' + item + '</li>';
            }).join('') + '</ul>';
        } else {
            alertsBox.className = 'scheduler-summary__alerts scheduler-summary__alerts--empty';
            alertsBox.innerHTML = '<small>Alertas de conflicto</small><ul><li>Sin conflictos en la programación actual.</li></ul>';
        }

        dayMeta.forEach(function (day) {
            var totalNode = document.querySelector('.js-day-total-value[data-day="' + day.id + '"]');
            var specialNode = document.querySelector('.js-day-special-value[data-day="' + day.id + '"]');
            if (totalNode) {
                totalNode.textContent = (resolved.dayTotals[day.id] || { label: formatMinutes(0) }).label;
            }
            if (specialNode) {
                specialNode.textContent = 'Esp. ' + (resolved.dayTotals[day.id] || { specialLabel: formatMinutes(0) }).specialLabel;
            }
        });
    }

    function findBlock(blockId) {
        return blocksState.find(function (item) {
            return Number(item.id) === Number(blockId);
        }) || null;
    }

    function renderBlock(block) {
        var duration = durationMinutes(block.start, block.end);
        var top = block.type === 'OFF' ? 4 : Math.max(0, (timeToMinutes(block.start) / 60) * slotHeight + 2);
        var height = block.type === 'OFF'
            ? ((hourRows.length * slotHeight) - 8)
            : Math.max(24, ((duration / 60) * slotHeight) - 4);
        var timeLabel = block.type === 'OFF'
            ? 'Día libre'
            : block.start + ' - ' + block.end;
        var metaLabel = block.type === 'OFF'
            ? 'Bloque de jornada libre'
            : formatMinutes(duration);

        return [
            '<button type="button" class="calendar-event calendar-event--' + block.type.toLowerCase() + ' js-open-edit" data-block-id="' + block.id + '" style="top:' + top + 'px;height:' + height + 'px;">',
            '<span class="calendar-event__time">' + timeLabel + '</span>',
            '<span class="calendar-event__meta">' + metaLabel + '</span>',
            '</button>'
        ].join('');
    }

    function renderBoard(summary) {
        dayMeta.forEach(function (day) {
            var list = document.querySelector('.scheduler-calendar__events[data-day="' + day.id + '"]');
            var dayBlocks = getBlocksForDay(day.id);
            if (!dayBlocks.length) {
                list.innerHTML = '<div class="scheduler-calendar__empty">' + (readOnly ? 'Sin bloques configurados' : 'Clic en una franja para crear') + '</div>';
            } else {
                list.innerHTML = dayBlocks.map(renderBlock).join('');
            }
        });
        renderSummary(summary);
    }

    function handleAjaxErrors(res, fallbackMessage) {
        var errors = [];
        if (res && res.errors) {
            Object.keys(res.errors).forEach(function (key) {
                var value = res.errors[key];
                errors.push(Array.isArray(value) ? value.join(' ') : value);
            });
        }
        showBanner('danger', errors.length ? errors : [fallbackMessage]);
    }

    function syncBoardFromResponse(res) {
        hideBanner();
        if (res.board) {
            applyBoardState(res.board);
        }
        if (Array.isArray(res.blocks)) {
            blocksState = res.blocks;
        }
        renderBoard(res.summary || null);
    }

    function resetModalErrors() {
        modalErrors.classList.add('d-none');
        modalErrors.innerHTML = '';
    }

    function showModalErrors(messages) {
        var items = Array.isArray(messages) ? messages : [messages];
        modalErrors.innerHTML = items.join('<br>');
        modalErrors.classList.remove('d-none');
    }

    function syncModalTypeState(resetRange) {
        var selectedType = modalTypeInput.value;
        var isOff = selectedType === 'OFF';
        modalColor.dataset.type = selectedType;
        modalStartInput.disabled = isOff;
        modalEndInput.disabled = isOff;

        if (isOff || resetRange) {
            var defaults = defaultRangeByType(selectedType, modalState.seedStart);
            modalStartInput.value = defaults.start;
            modalEndInput.value = defaults.end;
        }
    }

    function openCreateModal(day, startValue) {
        if (readOnly || !blockModal) {
            return;
        }

        modalState.mode = 'create';
        modalState.blockId = null;
        modalState.seedStart = startValue || '08:00';
        modalTitle.textContent = 'Nuevo bloque horario';
        modalDayInput.value = String(day);
        modalTypeInput.value = 'WORK';
        modalDeleteBtn.classList.add('d-none');
        resetModalErrors();
        syncModalTypeState(true);
        blockModal.show();
    }

    function openEditModal(block) {
        if (readOnly || !blockModal || !block) {
            return;
        }

        modalState.mode = 'edit';
        modalState.blockId = Number(block.id);
        modalState.seedStart = block.start || '08:00';
        modalTitle.textContent = 'Editar bloque horario';
        modalDayInput.value = String(block.day);
        modalTypeInput.value = block.type;
        modalStartInput.value = block.start;
        modalEndInput.value = block.end;
        modalDeleteBtn.classList.remove('d-none');
        resetModalErrors();
        syncModalTypeState(false);
        blockModal.show();
    }

    function readModalPayload() {
        var day = Number(modalDayInput.value);
        var type = modalTypeInput.value;
        var current = modalState.blockId ? findBlock(modalState.blockId) : null;
        var defaults = defaultRangeByType(type, modalState.seedStart);
        var start = type === 'OFF' ? defaults.start : modalStartInput.value;
        var end = type === 'OFF' ? defaults.end : modalEndInput.value;

        if (day < 1 || day > 7) {
            showModalErrors('Selecciona un día válido.');
            return null;
        }

        if (!start || !end) {
            showModalErrors('Completa hora inicio y hora fin.');
            return null;
        }

        if (start === end) {
            showModalErrors('La hora fin debe ser diferente a la hora inicio.');
            return null;
        }

        return {
            day: day,
            type: type,
            start: start,
            end: end,
            order: current && Number(current.day) === day ? current.order : getBlocksForDay(day).length
        };
    }

    function prepareDayForType(day, type, excludeId) {
        var currentDayBlocks = getBlocksForDay(day).filter(function (item) {
            return Number(item.id) !== Number(excludeId);
        });
        var requiresClear = (type === 'OFF' && currentDayBlocks.length > 0)
            || (type !== 'OFF' && currentDayBlocks.some(function (item) { return item.type === 'OFF'; }));

        if (!requiresClear) {
            return Promise.resolve(true);
        }

        var confirmed = window.confirm(type === 'OFF'
            ? 'Ese día ya tiene bloques. Se limpiará para dejarlo como día libre. ¿Continuar?'
            : 'Ese día está marcado como libre. Se limpiará para agregar el nuevo bloque. ¿Continuar?');
        if (!confirmed) {
            return Promise.resolve(false);
        }

        if (!boardState.id) {
            return Promise.resolve(true);
        }

        return clearDay(day, true).then(function () {
            return true;
        }).catch(function () {
            return false;
        });
    }

    function ensureBoard() {
        if (boardState.id) {
            return Promise.resolve({ success: true, board: boardState });
        }

        setBoardLoading(true);
        return ajaxJson({
            url: urls.initBoard,
            type: 'POST',
            dataType: 'json',
            data: {
                board: boardPayload()
            }
        }).then(function (res) {
            setBoardLoading(false);
            if (!res.success) {
                handleAjaxErrors(res, 'No fue posible iniciar el tablero.');
                throw res;
            }
            syncBoardFromResponse(res);
            return res;
        }, function (xhr) {
            setBoardLoading(false);
            if (!hasVisibleBanner()) {
                showBanner('danger', 'No fue posible iniciar el tablero.');
            }
            throw xhr;
        });
    }

    function createBlock(payload, skipPrepare) {
        if (readOnly) {
            return Promise.resolve(false);
        }

        return ensureBoard().then(function () {
            if (skipPrepare) {
                return true;
            }
            return prepareDayForType(payload.day, payload.type, null);
        }).then(function (ready) {
            if (!ready) {
                return false;
            }

            payload.order = getBlocksForDay(payload.day).length;
            setBoardLoading(true);
            return ajaxJson({
                url: urls.createBlock,
                type: 'POST',
                dataType: 'json',
                data: {
                    malla_id: boardState.id,
                    board: boardPayload(),
                    day: payload.day,
                    type: payload.type,
                    start: payload.start,
                    end: payload.end,
                    order: payload.order
                }
            });
        }).then(function (res) {
            if (res === false) {
                return false;
            }

            setBoardLoading(false);
            if (!res.success) {
                handleAjaxErrors(res, 'No fue posible crear el bloque.');
                showModalErrors('No fue posible crear el bloque.');
                return false;
            }
            syncBoardFromResponse(res);
            showBanner('success', res.message || 'Bloque creado.');
            return true;
        }).catch(function () {
            setBoardLoading(false);
            if (!hasVisibleBanner()) {
                showBanner('danger', 'No fue posible crear el bloque.');
            }
            showModalErrors('No fue posible crear el bloque.');
            return false;
        });
    }

    function saveBlock(blockId, payload) {
        if (readOnly) {
            return Promise.resolve(false);
        }

        var current = findBlock(blockId);
        if (!current) {
            showModalErrors('El bloque ya no existe en la vista actual.');
            return Promise.resolve(false);
        }

        var sameDayToOff = payload.type === 'OFF'
            && Number(payload.day) === Number(current.day)
            && getBlocksForDay(payload.day).some(function (item) {
                return Number(item.id) !== Number(blockId);
            });

        if (sameDayToOff) {
            return ensureBoard().then(function () {
                return prepareDayForType(payload.day, payload.type, blockId);
            }).then(function (ready) {
                if (!ready) {
                    return false;
                }

                return createBlock(payload, true);
            }).catch(function () {
                showModalErrors('No fue posible convertir el día en libre.');
                return false;
            });
        }

        return ensureBoard().then(function () {
            return prepareDayForType(payload.day, payload.type, blockId);
        }).then(function (ready) {
            if (!ready) {
                return false;
            }

            payload.order = Number(payload.day) === Number(current.day)
                ? current.order
                : getBlocksForDay(payload.day).length;

            setBoardLoading(true);
            return ajaxJson({
                url: urls.updateBlock,
                type: 'POST',
                dataType: 'json',
                data: Object.assign({ id: blockId }, payload)
            });
        }).then(function (res) {
            if (res === false) {
                return false;
            }

            setBoardLoading(false);
            if (!res.success) {
                handleAjaxErrors(res, 'No fue posible actualizar el bloque.');
                showModalErrors('No fue posible actualizar el bloque.');
                renderBoard();
                return false;
            }
            syncBoardFromResponse(res);
            showBanner('success', res.message || 'Bloque actualizado.');
            return true;
        }).catch(function () {
            setBoardLoading(false);
            if (!hasVisibleBanner()) {
                showBanner('danger', 'No fue posible actualizar el bloque.');
            }
            showModalErrors('No fue posible actualizar el bloque.');
            renderBoard();
            return false;
        });
    }

    function deleteBlock(blockId) {
        if (readOnly) {
            return Promise.resolve(false);
        }

        setBoardLoading(true);
        return ajaxJson({
            url: urls.deleteBlock,
            type: 'POST',
            dataType: 'json',
            data: { id: blockId }
        }).then(function (res) {
            setBoardLoading(false);
            if (!res.success) {
                handleAjaxErrors(res, 'No fue posible eliminar el bloque.');
                showModalErrors('No fue posible eliminar el bloque.');
                return false;
            }
            syncBoardFromResponse(res);
            showBanner('success', res.message || 'Bloque eliminado.');
            return true;
        }, function () {
            setBoardLoading(false);
            if (!hasVisibleBanner()) {
                showBanner('danger', 'No fue posible eliminar el bloque.');
            }
            showModalErrors('No fue posible eliminar el bloque.');
            return false;
        });
    }

    function clearDay(day, silent) {
        if (readOnly) {
            return Promise.resolve(null);
        }

        if (!boardState.id) {
            return Promise.resolve(null);
        }

        setBoardLoading(true);
        return ajaxJson({
            url: urls.clearDay,
            type: 'POST',
            dataType: 'json',
            data: {
                malla_id: boardState.id,
                day: day
            }
        }).then(function (res) {
            setBoardLoading(false);
            if (!res.success) {
                handleAjaxErrors(res, 'No fue posible limpiar el día.');
                throw res;
            }
            syncBoardFromResponse(res);
            if (!silent) {
                showBanner('success', res.message || 'Día limpiado.');
            }
            return res;
        }, function (xhr) {
            setBoardLoading(false);
            if (!hasVisibleBanner()) {
                showBanner('danger', 'No fue posible limpiar el día.');
            }
            throw xhr;
        });
    }

    function saveBoard(mode) {
        if (readOnly) {
            return;
        }

        setBoardLoading(true);
        ajaxJson({
            url: urls.saveBoard,
            type: 'POST',
            dataType: 'json',
            data: {
                malla_id: boardState.id,
                board: boardPayload(),
                mode: mode
            }
        }).then(function (res) {
            setBoardLoading(false);
            if (!res.success) {
                handleAjaxErrors(res, mode === 'publish' ? 'No fue posible publicar la malla.' : 'No fue posible guardar el borrador.');
                return;
            }
            syncBoardFromResponse(res);
            showBanner('success', res.message || 'Cambios guardados.');
            if (mode === 'publish' && res.viewUrl) {
                window.location.href = res.viewUrl;
            }
        }, function () {
            setBoardLoading(false);
            if (!hasVisibleBanner()) {
                showBanner('danger', mode === 'publish' ? 'No fue posible publicar la malla.' : 'No fue posible guardar el borrador.');
            }
        });
    }

    boardElement.addEventListener('click', function (event) {
        if (readOnly) {
            return;
        }

        var slotButton = event.target.closest('.js-open-create');
        if (slotButton) {
            openCreateModal(
                Number(slotButton.dataset.day),
                String(slotButton.dataset.start || '08:00')
            );
            return;
        }

        var editButton = event.target.closest('.js-open-edit');
        if (editButton) {
            openEditModal(findBlock(Number(editButton.dataset.blockId)));
        }
    });

    cancelBtn.addEventListener('click', function () {
        if (readOnly) {
            window.location.href = urls.index;
            return;
        }

        var hasData = boardState.id || nameInput.value.trim() || descriptionInput.value.trim() || blocksState.length;
        if (hasData && !window.confirm('¿Salir del creador semanal? Los cambios no guardados en cabecera podrían perderse.')) {
            return;
        }
        window.location.href = urls.index;
    });

    saveDraftBtn.addEventListener('click', function () {
        if (readOnly) {
            return;
        }
        saveBoard('draft');
    });

    publishBtn.addEventListener('click', function () {
        if (readOnly) {
            return;
        }
        saveBoard('publish');
    });

    if (weekStartInput) {
        weekStartInput.addEventListener('change', function () {
            if (!this.value) {
                return;
            }

            if (!readOnly && hasUnsavedHeaderChanges()) {
                if (!window.confirm('Cambiar la semana recargará el tablero y perderás cambios no guardados. ¿Continuar?')) {
                    this.value = weekContext.weekStart || this.defaultValue || '';
                    return;
                }
            }

            var targetUrl = new URL(window.location.href);
            targetUrl.searchParams.set('week_start', this.value);
            window.location.href = targetUrl.toString();
        });
    }

    modalTypeInput.addEventListener('change', function () {
        syncModalTypeState(true);
    });

    modalSaveBtn.addEventListener('click', function () {
        resetModalErrors();
        var payload = readModalPayload();
        if (!payload) {
            return;
        }

        modalSaveBtn.disabled = true;
        var action = modalState.mode === 'edit'
            ? saveBlock(modalState.blockId, payload)
            : createBlock(payload, false);

        action.then(function (success) {
            modalSaveBtn.disabled = false;
            if (success) {
                blockModal.hide();
            }
        }).catch(function () {
            modalSaveBtn.disabled = false;
        });
    });

    modalDeleteBtn.addEventListener('click', function () {
        if (!modalState.blockId) {
            return;
        }

        if (!window.confirm('¿Eliminar este bloque?')) {
            return;
        }

        modalDeleteBtn.disabled = true;
        deleteBlock(modalState.blockId).then(function (success) {
            modalDeleteBtn.disabled = false;
            if (success) {
                blockModal.hide();
            }
        }).catch(function () {
            modalDeleteBtn.disabled = false;
        });
    });

    modalEl.addEventListener('hidden.bs.modal', function () {
        resetModalErrors();
        modalDeleteBtn.disabled = false;
        modalSaveBtn.disabled = false;
    });

    applyBoardState(boardState);
    renderBoard();
})();
JS;

$js = strtr($jsTemplate, [
    '__INITIAL_BOARD__' => Json::htmlEncode($initialBoard),
    '__INITIAL_BLOCKS__' => Json::htmlEncode($initialBlocks),
    '__READ_ONLY__' => $readOnly ? 'true' : 'false',
    '__DAY_META__' => Json::htmlEncode($days),
    '__WEEK_CONTEXT__' => Json::htmlEncode($weekContext),
    '__URLS__' => Json::htmlEncode($urls),
    '__CSRF_PARAM__' => Json::htmlEncode($csrfParam),
    '__CSRF_TOKEN__' => Json::htmlEncode($csrfToken),
    '__HOUR_ROWS__' => Json::htmlEncode($hourRows),
]);
$this->registerJs($js, View::POS_READY);
?>

<div class="page-wrapper">
    <div class="content pb-0">
        <div class="scheduler-shell<?= $readOnly ? ' scheduler-shell--readonly' : '' ?>">
            <div class="scheduler-statusline">
                <span class="scheduler-status-badge" id="scheduler-status-badge" data-state="draft">
                    <?= Html::encode($initialBoard['estadoLabel'] ?: 'Borrador') ?>
                </span>
                <span class="scheduler-board-id" id="scheduler-board-id">
                    <?= $model->isNewRecord ? 'Sin guardar' : 'Malla #' . (int) $model->id ?>
                </span>
            </div>

            <div class="scheduler-hero">
                <div class="scheduler-hero__copy">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="scheduler-actions">
                    <button type="button" class="btn btn-light" id="kanban-cancel">Cancelar</button>
                    <button type="button" class="btn btn-outline-primary" id="kanban-save-draft"<?= $readOnly ? ' disabled' : '' ?>>Guardar borrador</button>
                    <button type="button" class="btn btn-primary" id="kanban-publish"<?= $readOnly ? ' disabled' : '' ?>>Publicar turno</button>
                </div>
            </div>

            <div class="alert scheduler-banner" id="scheduler-banner"></div>

            <div class="scheduler-meta-grid">
                <div class="scheduler-field">
                    <label for="kanban-nombre">Nombre de la malla</label>
                    <input id="kanban-nombre" type="text" class="form-control" value="<?= Html::encode($initialBoard['nombre']) ?>" placeholder="Ej. Turno semanal administrativo"<?= $readOnly ? ' readonly' : '' ?>>
                </div>
                <div class="scheduler-field">
                    <label for="kanban-descripcion">Descripción</label>
                    <input id="kanban-descripcion" type="text" class="form-control" value="<?= Html::encode($initialBoard['descripcion']) ?>" placeholder="Notas internas, alcance o contexto"<?= $readOnly ? ' readonly' : '' ?>>
                </div>
                <div class="scheduler-field">
                    <label for="kanban-tipo">Tipo</label>
                    <select id="kanban-tipo" class="form-select"<?= $readOnly ? ' disabled' : '' ?>>
                        <?php foreach (Mallas::optsTipo() as $value => $label): ?>
                            <option value="<?= Html::encode($value) ?>" <?= $initialBoard['tipo'] === $value ? 'selected' : '' ?>>
                                <?= Html::encode(ucfirst($label)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="scheduler-field">
                    <label for="kanban-activo">Activo</label>
                    <select id="kanban-activo" class="form-select"<?= $readOnly ? ' disabled' : '' ?>>
                        <option value="1" <?= (int) $initialBoard['activo'] === 1 ? 'selected' : '' ?>>Sí</option>
                        <option value="0" <?= (int) $initialBoard['activo'] === 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="scheduler-calendar__hintbar">
                <div class="scheduler-calendar__hint">
                    <?= $readOnly ? 'Solo lectura' : 'Clic en franja para crear &middot; Clic en bloque para editar' ?>
                </div>
                <div class="scheduler-calendar__toolbar">
                    <div class="scheduler-week-filter">
                        <label for="scheduler-week-start">Semana de</label>
                        <input
                            id="scheduler-week-start"
                            type="date"
                            class="form-control"
                            value="<?= Html::encode($selectedWeekStart) ?>"
                        >
                        <span class="scheduler-week-filter__range"><?= Html::encode($weekRangeLabel ?: ($selectedWeekStart . ' - ' . $selectedWeekEnd)) ?></span>
                    </div>
                </div>
            </div>

            <div class="scheduler-special-summary">
                <div class="scheduler-special-summary__card">
                    <strong id="summary-ordinary-day">00h 00m</strong>
                    <div class="scheduler-special-summary__body">
                        <small>Ordinaria diurna</small>
                    </div>
                </div>
                <div class="scheduler-special-summary__card">
                    <strong id="summary-ordinary-night">00h 00m</strong>
                    <div class="scheduler-special-summary__body">
                        <small>Ordinaria nocturna</small>
                    </div>
                </div>
                <div class="scheduler-special-summary__card">
                    <strong id="summary-special-day">00h 00m</strong>
                    <div class="scheduler-special-summary__body">
                        <small>Dom/Fest diurna</small>
                    </div>
                </div>
                <div class="scheduler-special-summary__card">
                    <strong id="summary-special-night">00h 00m</strong>
                    <div class="scheduler-special-summary__body">
                        <small>Dom/Fest nocturna</small>
                    </div>
                </div>
            </div>

            <div class="scheduler-calendar" id="scheduler-board">
                <div class="scheduler-calendar__frame">
                    <div class="scheduler-calendar__head">
                        <div class="scheduler-calendar__corner"></div>
                        <?php foreach ($days as $day): ?>
                            <div class="scheduler-calendar__head-day" data-day="<?= (int) $day['id'] ?>">
                                <div>
                                    <small><?= Html::encode($day['label']) ?></small>
                                    <strong><?= Html::encode($day['short']) ?></strong>
                                    <?php if (!empty($day['dayNumber'])): ?>
                                        <span class="scheduler-calendar__date">
                                            <?= Html::encode($day['dayNumber'] . ' ' . $day['monthShort']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($day['isSpecial'])): ?>
                                        <span class="scheduler-calendar__day-badge" title="<?= Html::encode($day['holidayName'] ?: $day['specialLabel']) ?>">
                                            <?= Html::encode($day['specialLabel'] ?: 'Especial') ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="scheduler-calendar__head-total">
                                    <span>Total</span>
                                    <strong class="js-day-total-value" data-day="<?= (int) $day['id'] ?>">00h 00m</strong>
                                    <em class="js-day-special-value" data-day="<?= (int) $day['id'] ?>">Esp. 00h 00m</em>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="scheduler-calendar__body">
                        <div class="scheduler-calendar__times">
                            <?php foreach ($hourRows as $row): ?>
                                <div class="scheduler-calendar__time"><?= Html::encode($row['label']) ?></div>
                            <?php endforeach; ?>
                        </div>

                        <div class="scheduler-calendar__columns">
                            <?php foreach ($days as $day): ?>
                                <div class="scheduler-calendar__column" data-day="<?= (int) $day['id'] ?>">
                                    <div class="scheduler-calendar__slot-grid">
                                        <?php foreach ($hourRows as $row): ?>
                                            <button
                                                type="button"
                                                class="scheduler-calendar__slot js-open-create"
                                                data-day="<?= (int) $day['id'] ?>"
                                                data-start="<?= Html::encode($row['value']) ?>"
                                                aria-label="Crear bloque en <?= Html::encode($day['label']) ?> a las <?= Html::encode($row['label']) ?>"
                                                <?= $readOnly ? 'disabled' : '' ?>
                                            ></button>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="scheduler-calendar__events" data-day="<?= (int) $day['id'] ?>"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scheduler-summary">
                <div class="scheduler-summary__card">
                    <strong id="summary-work">00h 00m</strong>
                    <div class="scheduler-summary__body">
                        <small>Trabajo</small>
                    </div>
                </div>
                <div class="scheduler-summary__card">
                    <strong id="summary-breaks">00h 00m</strong>
                    <div class="scheduler-summary__body">
                        <small>Descansos</small>
                    </div>
                </div>
                <div class="scheduler-summary__card">
                    <strong id="summary-days">0/7</strong>
                    <div class="scheduler-summary__body">
                        <small>Días activos</small>
                    </div>
                </div>
                <div class="scheduler-summary__alerts scheduler-summary__alerts--empty" id="scheduler-alerts">
                    <small>Alertas de conflicto</small>
                    <ul>
                        <li>Sin conflictos en la programación actual.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="scheduler-block-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduler-modal-title">Nuevo bloque horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div id="scheduler-modal-errors" class="alert alert-danger d-none"></div>

                <div class="mb-3">
                    <label class="form-label" for="scheduler-modal-day">Día</label>
                    <select class="form-select" id="scheduler-modal-day"<?= $readOnly ? ' disabled' : '' ?>>
                        <?php foreach ($days as $day): ?>
                            <option value="<?= (int) $day['id'] ?>"><?= Html::encode($day['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="scheduler-modal-type">Tipo de bloque</label>
                    <select class="form-select" id="scheduler-modal-type"<?= $readOnly ? ' disabled' : '' ?>>
                        <option value="WORK">WORK</option>
                        <option value="BREAK">BREAK</option>
                        <option value="OFF">OFF</option>
                    </select>
                    <div class="scheduler-modal__color-preview" id="scheduler-modal-color" data-type="WORK"></div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="scheduler-modal-start">Hora inicio</label>
                        <input type="time" class="form-control" id="scheduler-modal-start"<?= $readOnly ? ' disabled' : '' ?>>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="scheduler-modal-end">Hora fin</label>
                        <input type="time" class="form-control" id="scheduler-modal-end"<?= $readOnly ? ' disabled' : '' ?>>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-outline-danger d-none" id="scheduler-modal-delete"<?= $readOnly ? ' disabled' : '' ?>>Eliminar</button>
                <div class="d-flex gap-2 ms-auto">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="scheduler-modal-save"<?= $readOnly ? ' disabled' : '' ?>>Guardar bloque</button>
                </div>
            </div>
        </div>
    </div>
</div>
