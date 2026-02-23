<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception|Throwable $exception */

$this->title = $name;
?>

<div class="page-wrapper">
    <div class="content">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <?php if (YII_DEBUG && $exception): ?>
            <pre class="bg-light p-3 border rounded"><?= Html::encode((string)$exception) ?></pre>
        <?php endif; ?>
    </div>
</div>

