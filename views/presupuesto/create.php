<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Presupuesto $model */
/** @var string $matrixJson */
/** @var int[] $selectedConceptos */
/** @var array<int, string> $conceptosCatalogo */

$this->title = 'Crear presupuesto';
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?= $this->render('_form', [
                    'model' => $model,
                    'matrixJson' => $matrixJson,
                    'selectedConceptos' => $selectedConceptos,
                    'conceptosCatalogo' => $conceptosCatalogo,
                ]) ?>
            </div>
        </div>
    </div>
</div>
