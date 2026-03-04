<?php

use yii\helpers\Html;

/** @var \yii\web\View $this */
/** @var string $content */

?>
<div class="clearfix"></div>

<?= $this->render('_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?= $this->render('_menu') ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
