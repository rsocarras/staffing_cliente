<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Días festivos por país (p. ej. Colombia), sincronizados desde fuente externa.
 *
 * @property int $id
 * @property string $country_code Código ISO 3166-1 alpha-2 (p. ej. CO)
 * @property string $holiday_date Fecha del festivo (Y-m-d)
 * @property string $name_es Nombre en español
 * @property string $name_en Nombre en inglés
 * @property string $source Identificador de origen de los datos
 * @property string $synced_at Momento de la última sincronización
 * @property string $created_at
 * @property string $updated_at
 */
class CalendarHoliday extends ActiveRecord
{
    public const COUNTRY_COLOMBIA = 'CO';

    public const SOURCE_FESTIVOS_API = 'festivos_api';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendar_holiday';
    }

    /**
     * Festivos de Colombia en un año calendario.
     */
    public static function findColombiaByYear(int $year): ActiveQuery
    {
        $from = sprintf('%04d-01-01', $year);
        $to = sprintf('%04d-12-31', $year);

        return static::find()
            ->where(['country_code' => self::COUNTRY_COLOMBIA])
            ->andWhere(['between', 'holiday_date', $from, $to])
            ->orderBy(['holiday_date' => SORT_ASC]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_code', 'holiday_date', 'name_es', 'source', 'synced_at'], 'required'],
            [['name_en'], 'default', 'value' => ''],
            [['country_code'], 'default', 'value' => self::COUNTRY_COLOMBIA],
            [['source'], 'default', 'value' => self::SOURCE_FESTIVOS_API],
            [['holiday_date'], 'date', 'format' => 'php:Y-m-d'],
            [['synced_at', 'created_at', 'updated_at'], 'safe'],
            [['country_code'], 'string', 'length' => 2],
            [['name_es', 'name_en'], 'string', 'max' => 190],
            [['source'], 'string', 'max' => 32],
            [
                ['country_code', 'holiday_date'],
                'unique',
                'targetAttribute' => ['country_code', 'holiday_date'],
                'message' => 'Ya existe un festivo para este país en esa fecha.',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'País (ISO)',
            'holiday_date' => 'Fecha',
            'name_es' => 'Nombre (ES)',
            'name_en' => 'Nombre (EN)',
            'source' => 'Origen',
            'synced_at' => 'Sincronizado en',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    /**
     * Indica si la fecha dada es festivo en Colombia (según registros en BD).
     */
    public static function esFestivoColombia(string $dateYmd): bool
    {
        return static::find()
            ->where([
                'country_code' => self::COUNTRY_COLOMBIA,
                'holiday_date' => $dateYmd,
            ])
            ->exists();
    }
}
