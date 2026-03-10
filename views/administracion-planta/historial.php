<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\search\AdministracionPlantaDashboardSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $filterOptions */
/** @var string $activeTab */
?>

<?php
$this->title = 'Historial de planta';
$this->params['breadcrumbs'][] = ['label' => 'Administración de planta', 'url' => ['dashboard']];
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
            </div>
        </div>

        <?= $this->render('_tabs', ['activeTab' => $activeTab]) ?>
        <?= $this->render('_filters', ['searchModel' => $searchModel, 'filterOptions' => $filterOptions, 'exportScope' => 'historial']) ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="historial-planta-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Registro</th>
                                <th>Acción</th>
                                <th>Campo</th>
                                <th>Valor anterior</th>
                                <th>Valor nuevo</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $item): ?>
                            <tr>
                                <td><?= Yii::$app->formatter->asDatetime($item->created_at) ?></td>
                                <td><?= Html::encode($item->planta ? $item->planta->getDimensionLabel() : '#'.$item->planta_id) ?></td>
                                <td><?= Html::encode($item->accion) ?></td>
                                <td><?= Html::encode($item->campo) ?></td>
                                <td><?= Html::encode($item->valor_anterior ?: '-') ?></td>
                                <td><?= Html::encode($item->valor_nuevo ?: '-') ?></td>
                                <td><?= Html::encode($item->user ? $item->user->username : '-') ?></td>
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
$this->registerJs("$('#historial-planta-table').DataTable({pageLength: 25, order: [[0,'desc']]});", \yii\web\View::POS_READY);
?>
