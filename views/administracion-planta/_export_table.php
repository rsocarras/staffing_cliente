<?php

use yii\helpers\Html;

/** @var string $title */
/** @var array $columns */
/** @var array $rows */
/** @var bool $printMode */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?= Html::encode($title) ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #222; margin: 24px; }
        h1 { font-size: 18px; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d9d9d9; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1><?= Html::encode($title) ?></h1>
    <table>
        <thead>
            <tr>
                <?php foreach ($columns as $label): ?>
                    <th><?= Html::encode($label) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <?php foreach (array_keys($columns) as $key): ?>
                    <td><?= Html::encode(isset($row[$key]) ? (string) $row[$key] : '-') ?></td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($printMode): ?>
    <script>
        window.onload = function () {
            window.print();
        };
    </script>
    <?php endif; ?>
</body>
</html>
