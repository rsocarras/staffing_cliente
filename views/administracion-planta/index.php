<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\search\StaffingPlantaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $filterOptions */
/** @var string $activeTab */
?>

<?php
$this->title = 'Administración de planta';
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
                <p class="mb-0 text-muted">Vista administrativa de planta autorizada por sede, área, subárea y cargo.</p>
            </div>
            <div class="d-flex gap-2">
                <?php if (Yii::$app->user->can('administracion_planta_manage') || Yii::$app->user->can('admin') || Yii::$app->user->can('administrator')): ?>
                    <?= Html::a('<i class="ti ti-plus me-1"></i>Nueva planta', ['create'], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?= Html::a('<i class="ti ti-file-export me-1"></i>Excel', ['export', 'scope' => 'planta', 'format' => 'excel'] + Yii::$app->request->queryParams, ['class' => 'btn btn-outline-success']) ?>
                <?= Html::a('<i class="ti ti-printer me-1"></i>PDF / Imprimir', ['export', 'scope' => 'planta', 'format' => 'pdf'] + Yii::$app->request->queryParams, ['class' => 'btn btn-outline-dark', 'target' => '_blank']) ?>
            </div>
        </div>

        <?= $this->render('_tabs', ['activeTab' => $activeTab]) ?>

        <div class="card mb-4">
            <div class="card-body">
                <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['index'], 'options' => ['class' => 'row g-3']]); ?>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'region_id')->dropDownList(ArrayHelper::map($filterOptions['regiones'], 'id', 'name'), ['prompt' => 'Región']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'city_id')->dropDownList(ArrayHelper::map($filterOptions['ciudades'], 'id', 'name'), ['prompt' => 'Ciudad']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'location_sede_id')->dropDownList(ArrayHelper::map($filterOptions['sedes'], 'id', 'nombre'), ['prompt' => 'Sede']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'tipo_sede')->dropDownList($filterOptions['tipoSede'], ['prompt' => 'Tipo sede']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'area_id')->dropDownList(ArrayHelper::map($filterOptions['areas'], 'id', 'nombre'), ['prompt' => 'Área', 'id' => 'staffingplantasearch-area_id']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'sub_area_id')->dropDownList(ArrayHelper::map($filterOptions['subAreas'], 'id', 'nombre'), ['prompt' => 'Subárea', 'id' => 'staffingplantasearch-sub_area_id']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'cargo_id')->dropDownList(ArrayHelper::map($filterOptions['cargos'], 'id', 'nombre'), ['prompt' => 'Cargo', 'id' => 'staffingplantasearch-cargo_id']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($searchModel, 'activo')->dropDownList(['1' => 'Activos', '0' => 'Inactivos'], ['prompt' => 'Estado']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($searchModel, 'texto')->textInput(['placeholder' => 'Buscar por sede, cargo o área']) ?>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="planta-admin-table">
                        <thead>
                            <tr>
                                <th>Sede</th>
                                <th>Tipo sede</th>
                                <th>Área</th>
                                <th>Subárea</th>
                                <th>Cargo</th>
                                <th class="text-end">Planta autorizada</th>
                                <th>Activo</th>
                                <th>Actualizado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                            <tr>
                                <td><?= Html::encode($model->locationSede ? $model->locationSede->nombre : '-') ?></td>
                                <td><?= Html::encode($model->locationSede ? $model->locationSede->getTipoSedeLabel() : '-') ?></td>
                                <td><?= Html::encode($model->area ? $model->area->nombre : '-') ?></td>
                                <td><?= Html::encode($model->subArea ? $model->subArea->nombre : '-') ?></td>
                                <td><?= Html::encode($model->cargo ? $model->cargo->nombre : '-') ?></td>
                                <td class="text-end"><?= Yii::$app->formatter->asDecimal($model->cantidad_autorizada, 2) ?></td>
                                <td><?= (int) $model->activo === 1 ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-secondary">No</span>' ?></td>
                                <td><?= Yii::$app->formatter->asDatetime($model->updated_at) ?></td>
                                <td class="text-end">
                                    <?= Html::a('<i class="ti ti-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16']) ?>
                                    <?php if (Yii::$app->user->can('administracion_planta_manage') || Yii::$app->user->can('admin') || Yii::$app->user->can('administrator')): ?>
                                        <?= Html::a('<i class="ti ti-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16']) ?>
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
    $('#planta-admin-table').DataTable({pageLength: 25, order: [[7,'desc']]});

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

    $(document).on('change', '#staffingplantasearch-area_id', function() {
        var areaId = $(this).val();
        rebuildSelect('#staffingplantasearch-sub_area_id', [], 'Subárea');
        rebuildSelect('#staffingplantasearch-cargo_id', [], 'Cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$subAreasUrl}', {area_id: areaId}, function(data) {
            rebuildSelect('#staffingplantasearch-sub_area_id', data, 'Subárea');
        });
    });

    $(document).on('change', '#staffingplantasearch-sub_area_id', function() {
        var areaId = $('#staffingplantasearch-area_id').val();
        var subAreaId = $(this).val();
        rebuildSelect('#staffingplantasearch-cargo_id', [], 'Cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$cargosUrl}', {area_id: areaId, sub_area_id: subAreaId}, function(data) {
            rebuildSelect('#staffingplantasearch-cargo_id', data, 'Cargo');
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
