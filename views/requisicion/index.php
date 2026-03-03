<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Requisiciones de Contratación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <?= Html::a('<i class="ti ti-plus me-1"></i> Nueva Requisición', ['create'], ['class' => 'btn btn-primary']) ?>
                <?php if (Yii::$app->user->can('rrhh_cliente') || Yii::$app->user->can('admin')): ?>
                    <?= Html::a('<i class="ti ti-check me-1"></i> Bandeja Aprobación', ['approval'], ['class' => 'btn btn-outline-primary']) ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('rrhh_interno') || Yii::$app->user->can('admin')): ?>
                    <?= Html::a('<i class="ti ti-report me-1"></i> Reportes RRHH', ['reportes'], ['class' => 'btn btn-outline-secondary']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filtros</h5>
            </div>
            <div class="card-body">
                <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => ['index']]); ?>
                <div class="row g-2">
                    <div class="col-md-2"><?= $form->field($searchModel, 'estado')->dropDownList(\app\models\Requisicion::optsEstado(), ['prompt' => 'Todos'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'empresa_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\EmpresaCliente::getActivos(), 'id', 'nombre'), ['prompt' => 'Empresa'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'ciudad_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name'), ['prompt' => 'Ciudad'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'fecha_ingreso_desde')->input('date')->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'fecha_ingreso_hasta')->input('date')->label(false) ?></div>
                    <div class="col-md-2">
                        <?= Html::submitButton('<i class="ti ti-search"></i> Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap" id="requisicion-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Grupo / Vacante</th>
                                <th>Estado</th>
                                <th>Empresa</th>
                                <th>Ciudad</th>
                                <th>Sede</th>
                                <th>Cargo</th>
                                <th>F. Ingreso</th>
                                <th>Persona</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                            <tr>
                                <td><?= $model->id ?></td>
                                <td><?= Html::encode($model->group_uuid) ?> #<?= $model->vacante_index ?></td>
                                <td><span class="badge bg-<?= $model->estado === \app\models\Requisicion::ESTADO_ACTIVE ? 'success' : ($model->estado === \app\models\Requisicion::ESTADO_REJECTED ? 'danger' : 'secondary') ?>"><?= \app\models\Requisicion::optsEstado()[$model->estado] ?? $model->estado ?></span></td>
                                <td><?= Html::encode($model->empresa->nombre ?? '-') ?></td>
                                <td><?= Html::encode($model->ciudad->name ?? '-') ?></td>
                                <td><?= Html::encode($model->sede->nombre ?? '-') ?></td>
                                <td><?= Html::encode($model->cargo->nombre ?? '-') ?></td>
                                <td><?= Yii::$app->formatter->asDate($model->fecha_ingreso) ?></td>
                                <td><?= Html::encode($model->profile ? $model->profile->name : '-') ?></td>
                                <td class="text-end">
                                    <?= Html::a('<i class="ti ti-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-soft-info rounded-pill', 'title' => 'Ver']) ?>
                                    <?php if ($model->isEditable()): ?>
                                        <?= Html::a('<i class="ti ti-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-soft-primary rounded-pill', 'title' => 'Editar']) ?>
                                    <?php endif; ?>
                                    <?php if ($model->estado === \app\models\Requisicion::ESTADO_DRAFT): ?>
                                        <?php $f = \yii\widgets\ActiveForm::begin(['action' => ['submit', 'id' => $model->id], 'method' => 'post', 'options' => ['class' => 'd-inline']]); ?>
                                        <?= Html::submitButton('<i class="ti ti-send"></i>', ['class' => 'btn btn-icon btn-sm btn-success rounded-pill', 'title' => 'Enviar a aprobación', 'onclick' => "return confirm('¿Enviar a aprobación?');"]) ?>
                                        <?php \yii\widgets\ActiveForm::end(); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJs("
$('#requisicion-table').DataTable({
    order: [[0, 'desc']],
    pageLength: 25,
    language: {
        search: 'Buscar:',
        lengthMenu: 'Mostrar _MENU_',
        info: 'Mostrando _START_ a _END_ de _TOTAL_',
        paginate: { first: 'Primero', last: 'Último', next: 'Siguiente', previous: 'Anterior' }
    }
});
", \yii\web\View::POS_READY);
?>
