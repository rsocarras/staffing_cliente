<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

$title = explode('/', Yii::$app->request->getPathInfo());
$title = ucfirst(end($title));

// Meta Tags
echo '<meta charset="utf-8">' . "\n";
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";
echo '<title> ' . Html::encode($title) . ' | Akumajaa</title>' . "\n";
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
echo '<meta name="author" content="Akumajaa">' . "\n";
echo Html::csrfMetaTags() . "\n";
