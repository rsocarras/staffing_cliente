<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
?>

<!DOCTYPE html>
<?= $this->render('partials/theme-settings') ?>

<head>
    <?= $this->render('partials/title-meta') ?>
    <?= $this->render('partials/head-css') ?>
</head>

<?= $this->render('partials/body') ?>

<!-- Begin Wrapper -->
<div class="main-wrapper">

    <?= $this->render('partials/topbar') ?>
    <?= $this->render('partials/sidebar') ?>

    <?php
        $trimmedContent = ltrim($content);
        $controllerId = Yii::$app->controller ? Yii::$app->controller->id : null;
        $skipAutoWrapper = ($controllerId === 'pages');
        $alreadyWrapped = $skipAutoWrapper || str_starts_with($trimmedContent, '<div class="page-wrapper">');
    ?>

    <?php if ($alreadyWrapped): ?>
        <?= $content ?> <!-- Main content of the page -->
    <?php else: ?>
        <div class="page-wrapper">

            <!-- Start Content -->
            <div class="content">

                <?= $content ?> <!-- Main content of the page -->

            </div>
        </div>
    <?php endif; ?>

</div>
<!-- End Wrapper -->

<?= $this->render('partials/modal-popup') ?>
<?= $this->render('partials/vendor-scripts') ?>
</body>

</html>