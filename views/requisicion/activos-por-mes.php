<?php

use yii\helpers\Html;

$this->title = 'Activos por mes';
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['reportes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>
        <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => ['activos-por-mes']]); ?>
        <div class="row g-2 mb-3">
            <div class="col-auto">
                <input type="number" name="anio" value="<?= (int)$anio ?>" class="form-control" placeholder="Año" min="2020" max="2030">
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
                            <th>Mes</th>
                            <th>Total activados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= Html::encode($r['mes']) ?></td>
                            <td><?= $r['total'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($rows)): ?>
                    <p class="text-muted">No hay datos para el año seleccionado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
