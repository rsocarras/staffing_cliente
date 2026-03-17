<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */
/** @var string $date */
/** @var string $tab */
/** @var array $dayData */
/** @var array $weekData */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Location Sedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="location-sedes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa_id',
            'codigo',
            'nombre',
            'direccion',
            [
                'attribute' => 'tipo_sede',
                'value' => $model->getTipoSedeLabel(),
            ],
            'centro_costo',
            'centro_costo_staffing',
            'codigo_externo',
            'activo',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <hr>
    <h3>Mallas de empleados</h3>
    <form method="get" action="<?= Url::to(['view', 'id' => $model->id]) ?>" class="mb-3 d-flex align-items-center gap-2">
        <input type="hidden" name="tab" value="<?= Html::encode($tab) ?>">
        <label for="sede-date" class="mb-0">Fecha:</label>
        <input id="sede-date" type="date" name="date" class="form-control w-auto" value="<?= Html::encode($date) ?>">
        <button type="submit" class="btn btn-primary btn-sm">Aplicar</button>
    </form>

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link <?= $tab === 'day' ? 'active' : '' ?>" href="<?= Url::to(['view', 'id' => $model->id, 'date' => $date, 'tab' => 'day']) ?>">Por día</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $tab === 'week' ? 'active' : '' ?>" href="<?= Url::to(['view', 'id' => $model->id, 'date' => $date, 'tab' => 'week']) ?>">Por semana</a>
        </li>
    </ul>

    <?php if ($tab === 'week'): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Cargo</th>
                    <th>Malla</th>
                    <?php foreach ($weekData['dates'] as $d): ?>
                        <th><?= Html::encode(date('d M', strtotime($d))) ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($weekData['rows'])): ?>
                    <tr>
                        <td colspan="12" class="text-muted text-center">No hay empleados activos en esta sede.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($weekData['rows'] as $row): ?>
                        <tr>
                            <td><?= Html::encode($row['name']) ?></td>
                            <td><?= Html::encode($row['cargo'] ?: '-') ?></td>
                            <td><?= $row['has_malla'] ? Html::encode($row['malla']->nombre) : '<span class="badge bg-warning">Sin malla asignada</span>' ?></td>
                            <?php foreach ($weekData['dates'] as $d): ?>
                                <?php $day = $row['days'][$d]; ?>
                                <td>
                                    <?php if (empty($day['segments'])): ?>
                                        <span class="text-muted">-</span>
                                    <?php else: ?>
                                        <?= Html::encode(sprintf('%02d:%02d', intdiv($day['segments'][0]['start'], 60), $day['segments'][0]['start'] % 60)) ?>
                                        ...
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Cargo</th>
                    <th>Malla</th>
                    <th>Turnos del día</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($dayData['rows'])): ?>
                    <tr>
                        <td colspan="4" class="text-muted text-center">No hay empleados activos en esta sede.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dayData['rows'] as $row): ?>
                        <tr>
                            <td><?= Html::encode($row['name']) ?></td>
                            <td><?= Html::encode($row['cargo'] ?: '-') ?></td>
                            <td><?= $row['has_malla'] ? Html::encode($row['malla']->nombre) : '<span class="badge bg-warning">Sin malla asignada</span>' ?></td>
                            <td>
                                <?php if (empty($row['segments'])): ?>
                                    <span class="text-muted">Sin turno</span>
                                <?php else: ?>
                                    <?php foreach ($row['segments'] as $segment): ?>
                                        <div><?= Html::encode(sprintf('%02d:%02d', intdiv($segment['start'], 60), $segment['start'] % 60)) ?>
                                            - <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['end'], 60), $segment['end'] % 60)) ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
