<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\search\ContratoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $filterOptions */
/** @var array $scope */

$profileItems = ArrayHelper::map($filterOptions['profiles'], 'user_id', function ($item) {
    $parts = array_filter([
        $item->name,
        $item->user ? '@' . $item->user->username : null,
    ]);

    return implode(' | ', $parts);
});
?>

<?php
$this->title = 'Contratos';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                <p class="mb-0 text-muted">Listado contractual por empleado, sede, area y cargo.</p>
            </div>
            <div class="d-flex gap-2">
                <?php if (empty($scope['readonly'])): ?>
                    <?= Html::a('<i class="ti ti-plus me-1"></i>Nuevo contrato', ['create'], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?= Html::a('<i class="ti ti-settings me-1"></i>Tipos de contrato', ['/contrato-tipos/index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['index'], 'options' => ['class' => 'row g-3']]); ?>
                <div class="col-lg-3">
                    <?= $form->field($searchModel, 'profile_id')->dropDownList($profileItems, ['prompt' => 'Empleado']) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($searchModel, 'contrato_tipo_id')->dropDownList(ArrayHelper::map($filterOptions['contratoTipos'], 'id', 'nombre'), ['prompt' => 'Tipo contrato']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'estado')->dropDownList($filterOptions['estados'], ['prompt' => 'Estado']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'vigente')->dropDownList($filterOptions['vigencia'], ['prompt' => 'Vigencia']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'sede_id')->dropDownList(ArrayHelper::map($filterOptions['sedes'], 'id', 'nombre'), ['prompt' => 'Sede']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'region_id')->dropDownList(ArrayHelper::map($filterOptions['regiones'], 'id', 'name'), ['prompt' => 'Region']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'city_id')->dropDownList(ArrayHelper::map($filterOptions['ciudades'], 'id', 'name'), ['prompt' => 'Ciudad']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'area_id')->dropDownList(ArrayHelper::map($filterOptions['areas'], 'id', 'nombre'), ['prompt' => 'Area', 'id' => 'contratosearch-area_id']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'sub_area_id')->dropDownList(ArrayHelper::map($filterOptions['subAreas'], 'id', 'nombre'), ['prompt' => 'Subarea', 'id' => 'contratosearch-sub_area_id']) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($searchModel, 'cargo_id')->dropDownList(ArrayHelper::map($filterOptions['cargos'], 'id', 'nombre'), ['prompt' => 'Cargo', 'id' => 'contratosearch-cargo_id']) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($searchModel, 'texto')->textInput(['placeholder' => 'Buscar por empleado, usuario, sede o cargo']) ?>
                </div>
                <div class="col-lg-4 d-flex align-items-end gap-2">
                    <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="contrato-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empleado</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Vigencia</th>
                                <th>Sede principal</th>
                                <th>Area</th>
                                <th>Subarea</th>
                                <th>Cargo</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Distribucion</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                                <?php
                                $distributionCount = count($model->contratoDistribucionSedes);
                                $distributionLabel = $distributionCount > 0 ? $distributionCount . ' sedes' : 'Principal 100%';
                                ?>
                                <tr>
                                    <td><?= Html::encode($model->id) ?></td>
                                    <td><?= Html::encode($model->getProfileDisplayName()) ?></td>
                                    <td><?= Html::encode($model->contratoTipo ? $model->contratoTipo->nombre : '-') ?></td>
                                    <td><span class="badge badge-soft-<?= Html::encode($model->getEstadoBadgeClass()) ?>"><?= Html::encode($model->getDisplayEstado()) ?></span></td>
                                    <td>
                                        <span class="badge badge-soft-<?= $model->isCurrentByDate() ? 'success' : 'secondary' ?>">
                                            <?= Html::encode($model->getVigenciaLabel()) ?>
                                        </span>
                                    </td>
                                    <td><?= Html::encode($model->sede ? $model->sede->nombre : '-') ?></td>
                                    <td><?= Html::encode($model->area ? $model->area->nombre : '-') ?></td>
                                    <td><?= Html::encode($model->subArea ? $model->subArea->nombre : '-') ?></td>
                                    <td><?= Html::encode($model->cargo ? $model->cargo->nombre : '-') ?></td>
                                    <td><?= Yii::$app->formatter->asDate($model->fecha_inicio) ?></td>
                                    <td><?= $model->fecha_fin ? Yii::$app->formatter->asDate($model->fecha_fin) : '-' ?></td>
                                    <td><span class="badge bg-light text-dark"><?= Html::encode($distributionLabel) ?></span></td>
                                    <td class="text-end">
                                        <?= Html::a('<i class="ti ti-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16']) ?>
                                        <?php if (empty($scope['readonly'])): ?>
                                            <?= Html::a('<i class="ti ti-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16']) ?>
                                            <?= Html::a('<i class="ti ti-trash"></i>', ['delete', 'id' => $model->id], [
                                                'class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16',
                                                'data' => [
                                                    'confirm' => 'Esta seguro de eliminar este contrato?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
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
    <?= $this->render('//layouts/partials/footer') ?>
</div>

<?php
$subAreasUrl = Url::to(['sub-areas']);
$cargosUrl = Url::to(['cargos-por-estructura']);
$js = <<<JS
$(function() {
    $('#contrato-table').DataTable({
        pageLength: 25,
        order: [[0, 'desc']]
    });

    function rebuildSelect(selector, items, prompt) {
        var \$select = $(selector);
        var currentValue = \$select.val();
        \$select.html('<option value="">' + prompt + '</option>');
        items.forEach(function(item) {
            \$select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
        });
        if (currentValue) {
            \$select.val(currentValue);
        }
    }

    $(document).on('change', '#contratosearch-area_id', function() {
        var areaId = $(this).val();
        rebuildSelect('#contratosearch-sub_area_id', [], 'Subarea');
        rebuildSelect('#contratosearch-cargo_id', [], 'Cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$subAreasUrl}', {area_id: areaId}, function(data) {
            rebuildSelect('#contratosearch-sub_area_id', data, 'Subarea');
        });
    });

    $(document).on('change', '#contratosearch-sub_area_id', function() {
        var areaId = $('#contratosearch-area_id').val();
        var subAreaId = $(this).val();
        rebuildSelect('#contratosearch-cargo_id', [], 'Cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$cargosUrl}', {area_id: areaId, sub_area_id: subAreaId}, function(data) {
            rebuildSelect('#contratosearch-cargo_id', data, 'Cargo');
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
