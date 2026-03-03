<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Checklist - Requisición #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Checklist';
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><?= Html::encode($this->title) ?></h4>
            <?= Html::a('Volver', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php if ($model->checklistCompleto()): ?>
            <div class="alert alert-success">Checklist completo. Puede activar la contratación desde la vista de la requisición.</div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ítem</th>
                            <th>Obligatorio</th>
                            <th>Estado</th>
                            <th>Completado</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($statuses as $status): ?>
                        <tr>
                            <td><?= Html::encode($status->checklistItem->nombre) ?></td>
                            <td><?= $status->checklistItem->es_obligatorio ? 'Sí' : 'No' ?></td>
                            <td>
                                <?php if ($status->completado): ?>
                                    <span class="badge bg-success">Completado</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Pendiente</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $status->completado_at ? Yii::$app->formatter->asDatetime($status->completado_at) : '-' ?></td>
                            <td class="text-end">
                                <?php
                                $form = \yii\widgets\ActiveForm::begin([
                                    'action' => ['completar-checklist'],
                                    'method' => 'post',
                                    'options' => ['class' => 'd-inline']
                                ]);
                                echo Html::hiddenInput('requisicion_id', $model->id);
                                echo Html::hiddenInput('checklist_item_id', $status->checklist_item_id);
                                echo Html::hiddenInput('completado', $status->completado ? '0' : '1');
                                echo Html::submitButton($status->completado ? 'Desmarcar' : 'Completar', ['class' => 'btn btn-sm ' . ($status->completado ? 'btn-outline-warning' : 'btn-success')]);
                                \yii\widgets\ActiveForm::end();
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($statuses)): ?>
                    <p class="text-muted">No hay ítems de checklist. Agregue ítems obligatorios en la tabla checklist_item.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
