<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$puedeEditar = $model->isEstadoCargaBorrador();
?>
<div class="novedad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($puedeEditar): ?>
            <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', '¿Confirma eliminar esta novedad?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <span class="text-muted small"><?= Html::encode(Yii::t('app', 'Solo lectura: la carga ya no está en borrador.')) ?></span>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa_id',
            'profile_id',
            'concepto_id',
            'novedad_tipo_id',
            'estado',
            'datos',
            'schema_snapshot',
            'alertas',
            'paso_actual_id',
            'es_masivo',
            'lote_masivo_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
