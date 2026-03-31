<?php

declare(strict_types=1);

use app\models\Novedad;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var Novedad $model */
?>
<div class="novedad-no-editable-alert px-1">
    <div class="alert alert-warning border-0 mb-0">
        <p class="mb-2 fw-medium"><?= Html::encode(Yii::t('app', 'Esta novedad no se puede editar')) ?></p>
        <p class="small text-muted mb-0">
            <?= Html::encode(Yii::t(
                'app',
                'Solo las novedades con carga en «borrador» pueden modificarse o eliminarse. Use «Ver» para consultar los datos.'
            )) ?>
        </p>
    </div>
</div>
