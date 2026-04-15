<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $country_id
 * @property int|null $region_id
 * @property string $name
 * @property int $is_capital
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LocationCountry $country
 * @property Region $region
 */
class City extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id'], 'default', 'value' => null],
            [['is_capital'], 'default', 'value' => 0],
            [['is_active'], 'default', 'value' => 1],
            [['country_id', 'name'], 'required'],
            [['country_id', 'region_id', 'is_capital', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationCountry::class, 'targetAttribute' => ['country_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
            'is_capital' => 'Is Capital',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(LocationCountry::class, ['id' => 'country_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }

    /** Ciudades que deben aparecer primero en cualquier select, en ese orden. */
    private const PRIORITY_CITIES = ['bogota', 'medellin', 'barranquilla'];

    private static function normalizeCityName(string $name): string
    {
        $name = mb_strtolower($name, 'UTF-8');
        return strtr($name, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n']);
    }

    /**
     * Ordena un mapa [id => nombre] poniendo primero Bogotá, Medellín y Barranquilla.
     *
     * @param array<int|string, string> $map
     * @return array<int|string, string>
     */
    public static function sortMapWithPriority(array $map): array
    {
        $priorities = array_flip(static::PRIORITY_CITIES);
        uksort($map, static function ($aId, $bId) use ($map, $priorities) {
            $aPos = $priorities[static::normalizeCityName($map[$aId])] ?? PHP_INT_MAX;
            $bPos = $priorities[static::normalizeCityName($map[$bId])] ?? PHP_INT_MAX;
            if ($aPos !== $bPos) {
                return $aPos - $bPos;
            }
            return strnatcasecmp($map[$aId], $map[$bId]);
        });
        return $map;
    }

    /**
     * Ordena un array de filas (modelos City o arrays con clave 'name') poniendo
     * primero Bogotá, Medellín y Barranquilla.
     *
     * @param array $rows
     * @return array
     */
    public static function sortRowsWithPriority(array $rows): array
    {
        $priorities = array_flip(static::PRIORITY_CITIES);
        usort($rows, static function ($a, $b) use ($priorities) {
            $aName = is_array($a) ? ($a['name'] ?? '') : $a->name;
            $bName = is_array($b) ? ($b['name'] ?? '') : $b->name;
            $aPos = $priorities[static::normalizeCityName($aName)] ?? PHP_INT_MAX;
            $bPos = $priorities[static::normalizeCityName($bName)] ?? PHP_INT_MAX;
            if ($aPos !== $bPos) {
                return $aPos - $bPos;
            }
            return strnatcasecmp($aName, $bName);
        });
        return $rows;
    }

}
