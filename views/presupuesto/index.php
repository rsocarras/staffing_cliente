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
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <?php if (Yii::$app->user->can('presupuesto_create')): ?>
                    <?= Html::a('<i class="ti ti-plus me-1"></i> Crear presupuesto', ['create'], ['class' => 'btn btn-primary']) ?>
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
                                $cls = 'bg-secondary';
                                if ($m->estado === Presupuesto::ESTADO_APROBADO) {
                                    $cls = 'bg-success';
                                } elseif ($m->estado === Presupuesto::ESTADO_PENDIENTE_APROBACION) {
                                    $cls = 'bg-warning text-dark';
                                } elseif ($m->estado === Presupuesto::ESTADO_RECHAZADO) {
                                    $cls = 'bg-danger';
                                } elseif ($m->estado === Presupuesto::ESTADO_BORRADOR) {
                                    $cls = 'bg-info text-dark';
                                }
                                return Html::tag('span', Html::encode($m->getEstadoLabel()), ['class' => 'badge ' . $cls]);
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
