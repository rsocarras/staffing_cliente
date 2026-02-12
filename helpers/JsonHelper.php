<?php
namespace app\helpers;

use Yii;

class JsonHelper
{
    public static function loadJson(string $fileName): array
    {
        // Store JSON inside web/assets/json/ (public) or @app/data/json (private)
        $file = Yii::getAlias('@webroot') . '/assets/json/' . $fileName;

        if (is_file($file)) {
            $jsonContent = file_get_contents($file);
            return json_decode($jsonContent, true) ?? [];
        }

        return [];
    }
}
