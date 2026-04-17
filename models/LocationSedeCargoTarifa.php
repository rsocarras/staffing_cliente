<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Tarifas horarias por sede + cargo.
 *
 * @property int $id
 * @property int $location_sede_id
 * @property int $cargo_id
 * @property float|null $valor_hora_diurna
 * @property float|null $valor_hora_diurna_domingo_festivos
 * @property float|null $valor_hora_nocturna
 * @property float|null $valor_hora_nocturna_domingo_festiva
 * @property float|null $valor_movilizacion
 * @property float|null $valor_hora_especial
 * @property string $created_at
 *
 * @property LocationSedes $locationSede
 * @property Cargos $cargo
 */
class LocationSedeCargoTarifa extends ActiveRecord
{
    /** @var list<string> */
    public const TARIFF_ATTRIBUTES = [
        'valor_hora_diurna',
        'valor_hora_diurna_domingo_festivos',
        'valor_hora_nocturna',
        'valor_hora_nocturna_domingo_festiva',
        'valor_movilizacion',
        'valor_hora_especial',
    ];

    /**
     * @return list<string>
     */
    public static function tariffColumnNames(): array
    {
        return self::TARIFF_ATTRIBUTES;
    }

    /**
     * Normaliza entrada monetaria (es-CO en UI o decimal plano tras JS) a float con 2 decimales.
     *
     * @param mixed $v
     */
    public static function normalizeAmountInput($v): ?float
    {
        if ($v === null || $v === '') {
            return null;
        }
        if (is_int($v) || is_float($v)) {
            return round((float) $v, 2);
        }
        $s = trim((string) $v);
        if ($s === '') {
            return null;
        }
        if (strpos($s, ',') === false && preg_match('/^\d{1,3}(\.\d{3})+$/', $s)) {
            return round((float) str_replace('.', '', $s), 2);
        }
        if (preg_match('/^-?\d+(?:\.\d+)?$/', $s)) {
            return round((float) $s, 2);
        }
        $t = str_replace('.', '', $s);
        $t = str_replace(',', '.', $t);

        return is_numeric($t) ? round((float) $t, 2) : null;
    }

    public static function tableName(): string
    {
        return 'location_sede_cargo_tarifa';
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'location_sede_id' => Yii::t('app', 'Sede'),
            'cargo_id' => Yii::t('app', 'Cargo'),
            'valor_hora_diurna' => Yii::t('app', 'Valor hora diurna'),
            'valor_hora_diurna_domingo_festivos' => Yii::t('app', 'Valor hora diurna domingo/festivos'),
            'valor_hora_nocturna' => Yii::t('app', 'Valor hora nocturna'),
            'valor_hora_nocturna_domingo_festiva' => Yii::t('app', 'Valor hora nocturna domingo/festivo'),
            'valor_movilizacion' => Yii::t('app', 'Valor movilización'),
            'valor_hora_especial' => Yii::t('app', 'Valor hora especial'),
            'created_at' => Yii::t('app', 'Creado'),
        ];
    }

    public function getLocationSede(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    public function getCargo(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }
}
