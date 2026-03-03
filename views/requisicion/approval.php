<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Bandeja de Aprobación';
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Grupo</th>
                                <th>Empresa</th>
                                <th>Ciudad</th>
                                <th>Cargo</th>
                                <th>F. Ingreso</th>
                                <th>F. Solicitud</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                            <tr>
                                <td><?= $model->id ?></td>
                                <td><?= Html::encode($model->group_uuid) ?> #<?= $model->vacante_index ?></td>
                                <td><?= Html::encode($model->empresa->nombre ?? '-') ?></td>
                                <td><?= Html::encode($model->ciudad->name ?? '-') ?></td>
                                <td><?= Html::encode($model->cargo->nombre ?? '-') ?></td>
                                <td><?= Yii::$app->formatter->asDate($model->fecha_ingreso) ?></td>
                                <td><?= Yii::$app->formatter->asDatetime($model->fecha_creacion) ?></td>
                                <td class="text-end">
                                    <?= Html::a('Ver', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-outline-info']) ?>
                                    <?= Html::a('Aprobar', ['approve', 'id' => $model->id], ['class' => 'btn btn-sm btn-success', 'data' => ['method' => 'post', 'confirm' => '¿Aprobar esta requisición?']]) ?>
                                    <button type="button" class="btn btn-sm btn-danger btn-reject" data-id="<?= $model->id ?>">Rechazar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (empty($dataProvider->getModels())): ?>
                    <p class="text-muted">No hay requisiciones pendientes de aprobación.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $f = \yii\widgets\ActiveForm::begin(['id' => 'reject-form', 'method' => 'post', 'action' => ['reject', 'id' => 0]]); ?>
            <div class="modal-header">
                <h5 class="modal-title">Rechazar requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Motivo de rechazo (obligatorio)</label>
                    <textarea name="motivo_rechazo" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Rechazar</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$rejectUrl = Url::to(['reject', 'id' => 0]);
$this->registerJs("
$('.btn-reject').on('click', function() {
    var id = $(this).data('id');
    var url = '" . addslashes($rejectUrl) . "'.replace(/0$/, id);
    $('#reject-form').attr('action', url);
    $('#rejectModal').modal('show');
});
");
?>
