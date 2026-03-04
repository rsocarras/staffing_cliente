<?php

/** @var \Da\User\Module $module */

?>
<?php if ($module->enableFlashMessages): ?>
    <div class="row">
        <div class="col-12">
            <?php foreach (Yii::$app->session->getAllFlashes(true) as $type => $message): ?>
                <?php if (in_array($type, ['success', 'danger', 'warning', 'info'], true)): ?>
                    <div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
                        <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>
