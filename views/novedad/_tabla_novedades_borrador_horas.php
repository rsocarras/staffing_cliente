<?php

use app\models\Novedad;
use yii\helpers\Html;

/** @var Novedad[] $novedades */
/** @var string|null $tableClass clases de la tabla (ej. table-sm para modales) */
/** @var bool $compact tabla más compacta (modales) */

$tableClass = trim((string) ($tableClass ?? 'table table-hover mb-0 align-middle'));
$compact = (bool) ($compact ?? false);
$cellPad = $compact ? 'px-3 py-2' : 'px-4 py-3';
$thPad = $compact ? 'px-3 py-2' : 'px-4 py-3';

$sumaImporte = 0.0;
foreach ($novedades as $n) {
    if ($n->importe !== null && (string) $n->importe !== '') {
        $sumaImporte += (float) $n->importe;
    }
}

?>
<div class="table-responsive">
    <table class="<?= Html::encode($tableClass) ?>">
        <thead class="thead-light">
        <tr>
            <th class="<?= Html::encode($thPad) ?> text-nowrap"><?= Html::encode(Yii::t('app', 'ID')) ?></th>
            <th class="<?= Html::encode($thPad) ?>"><?= Html::encode(Yii::t('app', 'Concepto')) ?></th>
            <th class="<?= Html::encode($thPad) ?> text-nowrap"><?= Html::encode(Yii::t('app', 'Fecha')) ?></th>
            <th class="<?= Html::encode($thPad) ?> text-end text-nowrap"><?= Html::encode(Yii::t('app', 'Cantidad')) ?></th>
            <th class="<?= Html::encode($thPad) ?> text-nowrap"><?= Html::encode(Yii::t('app', 'Unidad')) ?></th>
            <th class="<?= Html::encode($thPad) ?> text-end text-nowrap"><?= Html::encode(Yii::t('app', 'Valor unitario')) ?></th>
            <th class="<?= Html::encode($thPad) ?> text-end text-nowrap"><?= Html::encode(Yii::t('app', 'Importe')) ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($novedades as $n): ?>
            <?php
            /** @var Novedad $n */
            $conc = $n->concepto;
            $nombreConcepto = $conc && trim((string) $conc->nombre) !== ''
                ? (string) $conc->nombre
                : ($conc ? Yii::t('app', 'Concepto #{id}', ['id' => $n->concepto_id]) : '—');
            $fechaFmt = $n->fecha_novedad
                ? Yii::$app->formatter->asDate($n->fecha_novedad)
                : '—';
            $impF = ($n->importe !== null && (string) $n->importe !== '') ? (float) $n->importe : null;
            $importeFmt = ($impF !== null && abs($impF) >= 0.005)
                ? Yii::$app->formatter->asCurrency($impF)
                : '—';
            $vuF = ($n->valor_unitario !== null && (string) $n->valor_unitario !== '') ? (float) $n->valor_unitario : null;
            $vuFmt = ($vuF !== null && abs($vuF) >= 0.000005)
                ? Yii::$app->formatter->asCurrency($vuF)
                : '—';
            $unidadTxt = trim((string) ($n->unidad ?? ''));
            $unidadFmt = $unidadTxt !== '' ? $unidadTxt : '—';
            ?>
            <tr>
                <td class="<?= Html::encode($cellPad) ?> text-muted text-nowrap"><?= (int) $n->id ?></td>
                <td class="<?= Html::encode($cellPad) ?> fw-medium"><?= Html::encode($nombreConcepto) ?></td>
                <td class="<?= Html::encode($cellPad) ?> text-nowrap"><?= Html::encode($fechaFmt) ?></td>
                <td class="<?= Html::encode($cellPad) ?> text-end text-nowrap fw-semibold"><?= $n->cantidad !== null ? Html::encode(Yii::$app->formatter->asDecimal((float) $n->cantidad, 2)) : '—' ?></td>
                <td class="<?= Html::encode($cellPad) ?> text-nowrap"><?= Html::encode($unidadFmt) ?></td>
                <td class="<?= Html::encode($cellPad) ?> text-end text-nowrap"><?= Html::encode($vuFmt) ?></td>
                <td class="<?= Html::encode($cellPad) ?> text-end text-nowrap"><?= Html::encode($importeFmt) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot class="table-light border-top">
        <tr>
            <td colspan="6" class="<?= Html::encode($cellPad) ?> text-end fw-semibold text-nowrap">
                <?= Html::encode(Yii::t('app', 'Total borrador')) ?>
            </td>
            <td class="<?= Html::encode($cellPad) ?> text-end text-nowrap fw-bold">
                <?= Html::encode(Yii::$app->formatter->asCurrency($sumaImporte)) ?>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
