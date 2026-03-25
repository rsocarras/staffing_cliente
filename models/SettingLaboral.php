<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Fila de parámetros laborales en `setting` (año/país, franja nocturna).
 * Distinto de {@see Setting} (key/value legacy en este proyecto).
 *
 * @property int $id
 * @property int|null $year
 * @property int|null $location_country_id
 * @property string|null $hora_inicio_nocturna
 * @property string|null $fin_hora_nocturna
 */
class SettingLaboral extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'setting';
    }
}
