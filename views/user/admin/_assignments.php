<?php

use Da\User\Widget\AssignmentsWidget;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */
/** @var string[] $params */
/** @var \Da\User\Module $module */

?>
<?php $this->beginContent($module->viewPath . '/admin/update.php', ['user' => $user]) ?>

<div class="alert alert-info alert-dismissible fade show">
    <?= Yii::t('usuario', 'You can assign multiple roles or permissions to user by using the form below') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<?= AssignmentsWidget::widget(['userId' => $user->id, 'params' => $params]) ?>

<?php $this->endContent() ?>
