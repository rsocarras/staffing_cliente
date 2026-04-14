<?php

use Yii;
use app\models\Presupuesto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\PresupuestoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string|null $pageTitle */
/** @var bool|null $isPending */

$this->title = $pageTitle ?? 'Presupuestos';
if (isset($isPending) && $isPending) {
    $this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
    $this->params['breadcrumbs'][] = 'Pendientes';
} else {
    $this->params['breadcrumbs'][] = $this->title;
}

$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;

$createAjaxUrl = Url::to(['presupuesto/create-ajax']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$modelPresupuestoModal = new \app\models\Presupuesto();
$modelPresupuestoModal->estado = \app\models\Presupuesto::ESTADO_BORRADOR;
$modelPresupuestoModal->loadDefaultValues();
if (!$modelPresupuestoModal->fecha_inicio_vigencia) {
    $modelPresupuestoModal->fecha_inicio_vigencia = date('Y-m-d');
}
if (!$modelPresupuestoModal->fecha_fin_vigencia) {
    $modelPresupuestoModal->fecha_fin_vigencia = date('Y-m-d', strtotime('+1 year'));
}

$empresaId = is_numeric($tenantEmpresaId) ? (int) $tenantEmpresaId : null;
$conceptosCatalogoModal = [];
if ($empresaId !== null) {
    $workflow = new \app\services\PresupuestoWorkflowService();
    foreach ($workflow->listConceptosForEmpresa($empresaId) as $c) {
        $conceptosCatalogoModal[(int) $c->id] = $c->nombre;
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <?php if (Yii::$app->user->can('presupuesto_create')): ?>
                    <?= Html::a('<i class="ti ti-plus me-1"></i> Crear presupuesto', 'javascript:void(0);', ['class' => 'btn btn-primary', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#modal-create-presupuesto']) ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('presupuesto_index')): ?>
                    <?= Html::a('<i class="ti ti-clock me-1"></i> Pendientes', ['pending'], ['class' => 'btn btn-outline-primary']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><h5 class="card-title mb-0">Filtros</h5></div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['index']]); ?>
                <div class="row g-2">
                    <div class="col-md-2">
                        <?= $form->field($searchModel, 'estado')->dropDownList(Presupuesto::optsEstado(), ['prompt' => 'Estado'])->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($searchModel, 'location_sede_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map(
                                \app\models\LocationSedes::find()->where([
                                    'empresa_id' => $tenantEmpresaId,
                                    'activo' => 1,
                                ])->orderBy(['nombre' => SORT_ASC])->all(),
                                'id',
                                'nombre'
                            ),
                            ['prompt' => 'Sede']
                        )->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($searchModel, 'empresa_cliente_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map(
                                \app\models\EmpresaCliente::getActivos($tenantEmpresaId ? (int) $tenantEmpresaId : null),
                                'id',
                                'nombre'
                            ),
                            ['prompt' => 'Cliente']
                        )->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($searchModel, 'vigencia_desde')->input('date')->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($searchModel, 'vigencia_hasta')->input('date')->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($searchModel, 'created_by')->input('number', ['min' => 1, 'placeholder' => 'ID creador'])->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= Html::submitButton('<i class="ti ti-search"></i> Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => null,
                    'tableOptions' => ['class' => 'table table-nowrap'],
                    'columns' => [
                        'id',
                        'nombre',
                        [
                            'attribute' => 'location_sede_id',
                            'label' => 'Sede',
                            'value' => function ($m) {
                                return $m->locationSede ? $m->locationSede->nombre : '';
                            },
                        ],
                        [
                            'attribute' => 'estado',
                            'format' => 'raw',
                            'value' => function ($m) {
                                return Html::tag(
                                    'span',
                                    Html::encode($m->getEstadoLabel()),
                                    ['class' => 'badge badge-soft-' . $m->getEstadoBadgeSoftClass()]
                                );
                            },
                        ],
                        'version',
                        'fecha_inicio_vigencia',
                        'fecha_fin_vigencia',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update}',
                            'visibleButtons' => [
                                'view' => function () {
                                    return Yii::$app->user->can('presupuesto_view');
                                },
                                'update' => function ($model) {
                                    return Yii::$app->user->can('presupuesto_update') && $model->isEditable();
                                },
                            ],
                            'urlCreator' => function ($action, $model) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            },
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Presupuesto -->
<div class="modal fade" id="modal-create-presupuesto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl presupuesto-create-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start flex-shrink-0">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-calculator fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo presupuesto</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Complete los datos del presupuesto de horas.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0 d-flex flex-column presupuesto-create-modal-body">
                <div class="presupuesto-create-scroll px-4 pt-3 pb-2">
                    <div id="presupuesto-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                    <?= $this->render('_form', [
                        'model'              => $modelPresupuestoModal,
                        'matrixJson'         => '{}',
                        'selectedConceptos'  => [],
                        'conceptosCatalogo'  => $conceptosCatalogoModal,
                        'isModal'            => true,
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2 flex-shrink-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-presupuesto">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar borrador</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCss(<<<CSS
#modal-create-presupuesto .presupuesto-create-dialog {
    max-width: min(1140px, 96vw);
    margin: 1rem auto;
}
#modal-create-presupuesto .presupuesto-create-dialog .modal-content {
    display: flex;
    flex-direction: column;
    max-height: calc(100vh - 2rem);
    overflow: hidden;
}
#modal-create-presupuesto .presupuesto-create-modal-body {
    flex: 1 1 auto;
    min-height: 0;
    overflow: hidden !important;
}
#modal-create-presupuesto .presupuesto-create-scroll {
    max-height: min(72vh, calc(100vh - 200px));
    overflow-y: auto !important;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    overscroll-behavior: contain;
    touch-action: pan-y;
    position: relative;
    z-index: 0;
}
@media (max-height: 700px) {
    #modal-create-presupuesto .presupuesto-create-scroll {
        max-height: calc(100vh - 180px);
    }
}
CSS);

$this->registerJs(<<<JS
$(function () {
    var createAjaxUrl = '{$createAjaxUrl}';

    var modalEl = document.getElementById('modal-create-presupuesto');
    if (modalEl) {
        modalEl.addEventListener('show.bs.modal', function () {
            if (this.parentElement !== document.body) {
                document.body.appendChild(this);
            }
        });
    }

    $('#btn-save-presupuesto').on('click', function () {
        $('#form-presupuesto').trigger('submit');
    });

    $('#form-presupuesto').off('submit.presupuestoCreateModal').on('submit.presupuestoCreateModal', function (e) {
        e.preventDefault();

        var \$form = $(this);
        var \$btn = $('#btn-save-presupuesto');
        var \$errors = $('#presupuesto-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var \$disabled = \$form.find('select:disabled, input:disabled');
        \$disabled.prop('disabled', false);

        $.ajax({
            url: createAjaxUrl,
            type: 'POST',
            data: \$form.serialize(),
            dataType: 'json',
            success: function (res) {
                if (!res.success) {
                    var errors = [];
                    if (res.errors) {
                        Object.keys(res.errors).forEach(function (key) {
                            var value = res.errors[key];
                            errors.push($.isArray(value) ? value.join(' ') : value);
                        });
                    }
                    \$errors.html(errors.join('<br>') || 'No fue posible guardar el presupuesto.').removeClass('d-none');
                    \$disabled.prop('disabled', true);
                    return;
                }
                window.location.href = res.viewUrl;
            },
            error: function () {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
                \$disabled.prop('disabled', true);
            },
            complete: function () {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });
});
JS, \yii\web\View::POS_READY);
?>
