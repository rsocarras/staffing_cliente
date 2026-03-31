<?php

use yii\helpers\Html;

/** @var app\models\Requisicion $model */

$parts = explode('-', $model->group_uuid ?? '');
$shortUuid = $model->group_uuid ? (end($parts) ?: $model->group_uuid) : '-';
?>
<tr>
    <td><?= Html::encode($model->id) ?></td>
    <td>
        <?= Html::a(Html::encode($shortUuid) . ' #' . (int) $model->vacante_index, ['view', 'id' => $model->id], ['title' => $model->group_uuid]) ?>
    </td>
    <td>
        <span class="badge badge-soft-<?= \app\models\Requisicion::estadoBadgeClass($model->estado) ?>">
            <?= Html::encode(\app\models\Requisicion::optsEstado()[$model->estado] ?? $model->estado) ?>
        </span>
    </td>
    <td><?= Html::encode($model->tiempoTotalDesdeCreacion) ?></td>
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
            <?= Html::a('<i class="ti ti-send"></i>', ['submit', 'id' => $model->id], [
                'class' => 'btn btn-icon btn-sm btn-success rounded-pill',
                'title' => 'Enviar a aprobación',
                'data' => [
                    'confirm' => '¿Enviar a aprobación?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </td>
</tr>
