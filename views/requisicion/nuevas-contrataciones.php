<?php

use yii\helpers\Html;

$this->title = 'Nuevas contrataciones';
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['reportes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>
        <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => ['nuevas-contrataciones']]); ?>
        <div class="row g-2 mb-3">
            <div class="col-auto">
                <input type="date" name="desde" value="<?= Html::encode($desde) ?>" class="form-control">
            </div>
            <div class="col-auto">
                <input type="date" name="hasta" value="<?= Html::encode($hasta) ?>" class="form-control">
            </div>
            <div class="col-auto">
                <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php \yii\widgets\ActiveForm::end(); ?>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Persona</th>
                            <th>Documento</th>
                            <th>Empresa</th>
                            <th>Sede</th>
                            <th>Cargo</th>
                            <th>F. Ingreso</th>
                            <th>F. Activación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($models as $m): ?>
                        <tr>
                            <td><?= $m->id ?></td>
                            <td><?= Html::encode($m->nombres . ' ' . $m->apellidos) ?></td>
                            <td><?= Html::encode($m->num_documento) ?></td>
                            <td><?= Html::encode($m->empresa->nombre ?? '-') ?></td>
                            <td><?= Html::encode($m->sede->nombre ?? '-') ?></td>
                            <td><?= Html::encode($m->cargo->nombre ?? '-') ?></td>
                            <td><?= Yii::$app->formatter->asDate($m->fecha_ingreso) ?></td>
                            <td><?= Yii::$app->formatter->asDatetime($m->fecha_update) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($models)): ?>
                    <p class="text-muted">No hay registros en el rango seleccionado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
