<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Parámetros laborales globales por año y país (`setting`).
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $year
 * @property int|null $location_country_id
 * @property string|null $hora_inicio_nocturna
 * @property string|null $fin_hora_nocturna
 * @property float|string|null $salario_minimo
 * @property float|string|null $salario_minimo_integral
 * @property float|string|null $porcentaje_salud
 * @property float|string|null $porcentaje_pension
 * @property float|string|null $porcentaje_cajas
 * @property float|string|null $provision_prima_anual
 * @property float|string|null $provision_cesantias
 * @property float|string|null $provision_vacaciones
 * @property int|null $max_horas_extra_dia
 * @property int|null $max_horas_extra_semana
 * @property int|null $max_horas_extra_mes
 * @property float|string|null $recargo_dominical_festivo
 * @property float|string|null $recargo_nocturno
 * @property float|string|null $recargo_nocturno_dominical_festivo
 * @property float|string|null $valor_hora_extra_diurna
 * @property float|string|null $valor_hora_extra_nocturna
 * @property float|string|null $valor_hora_extra_dia_festivo
 * @property float|string|null $valor_hora_extra_nocturno_festivo
 * @property float|string|null $valor_dominical_compensatorio
 *
 * @property-read LocationCountry|null $locationCountry
 * @property-read User|null $createdBy
 * @property-read User|null $updatedBy
 */
class Setting extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'setting';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [[
                'created_by',
                'updated_by',
                'year',
                'location_country_id',
                'max_horas_extra_dia',
                'max_horas_extra_semana',
                'max_horas_extra_mes',
            ], 'default', 'value' => null],
            [[
                'salario_minimo',
                'salario_minimo_integral',
                'porcentaje_salud',
                'porcentaje_pension',
                'porcentaje_cajas',
                'provision_prima_anual',
                'provision_cesantias',
                'provision_vacaciones',
                'recargo_dominical_festivo',
                'recargo_nocturno',
                'recargo_nocturno_dominical_festivo',
                'valor_hora_extra_diurna',
                'valor_hora_extra_nocturna',
                'valor_hora_extra_dia_festivo',
                'valor_hora_extra_nocturno_festivo',
                'valor_dominical_compensatorio',
            ], 'default', 'value' => null],
            [['hora_inicio_nocturna', 'fin_hora_nocturna'], 'default', 'value' => null],
            [['year', 'location_country_id'], 'required'],
            [['year'], 'integer', 'min' => 1900, 'max' => 2100],
            [['location_country_id', 'created_by', 'updated_by'], 'integer'],
            [['max_horas_extra_dia'], 'integer', 'min' => 0, 'max' => 255],
            [['max_horas_extra_semana', 'max_horas_extra_mes'], 'integer', 'min' => 0],
            [['created_at', 'updated_at'], 'safe'],
            [['hora_inicio_nocturna', 'fin_hora_nocturna'], 'safe'],
            [['salario_minimo', 'salario_minimo_integral'], 'number'],
            [[
                'porcentaje_salud',
                'porcentaje_pension',
                'porcentaje_cajas',
                'provision_prima_anual',
                'provision_cesantias',
                'provision_vacaciones',
                'recargo_dominical_festivo',
                'recargo_nocturno',
                'recargo_nocturno_dominical_festivo',
                'valor_hora_extra_diurna',
                'valor_hora_extra_nocturna',
                'valor_hora_extra_dia_festivo',
                'valor_hora_extra_nocturno_festivo',
                'valor_dominical_compensatorio',
            ], 'number'],
            [['location_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationCountry::class, 'targetAttribute' => ['location_country_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['year', 'location_country_id'], 'unique', 'targetAttribute' => ['year', 'location_country_id'], 'message' => Yii::t('app', 'Ya existe un registro para este año y país.')],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'Creado el'),
            'updated_at' => Yii::t('app', 'Actualizado el'),
            'created_by' => Yii::t('app', 'Creado por'),
            'updated_by' => Yii::t('app', 'Actualizado por'),
            'year' => Yii::t('app', 'Año'),
            'location_country_id' => Yii::t('app', 'País'),
            'hora_inicio_nocturna' => Yii::t('app', 'Hora inicio nocturna'),
            'fin_hora_nocturna' => Yii::t('app', 'Fin hora nocturna'),
            'salario_minimo' => Yii::t('app', 'Salario mínimo'),
            'salario_minimo_integral' => Yii::t('app', 'Salario mínimo integral'),
            'porcentaje_salud' => Yii::t('app', 'Porcentaje salud'),
            'porcentaje_pension' => Yii::t('app', 'Porcentaje pensión'),
            'porcentaje_cajas' => Yii::t('app', 'Porcentaje cajas'),
            'provision_prima_anual' => Yii::t('app', 'Provisión prima anual'),
            'provision_cesantias' => Yii::t('app', 'Provisión cesantías'),
            'provision_vacaciones' => Yii::t('app', 'Provisión vacaciones'),
            'max_horas_extra_dia' => Yii::t('app', 'Máx. horas extra día'),
            'max_horas_extra_semana' => Yii::t('app', 'Máx. horas extra semana'),
            'max_horas_extra_mes' => Yii::t('app', 'Máx. horas extra mes'),
            'recargo_dominical_festivo' => Yii::t('app', 'Recargo dominical/festivo'),
            'recargo_nocturno' => Yii::t('app', 'Recargo nocturno'),
            'recargo_nocturno_dominical_festivo' => Yii::t('app', 'Recargo nocturno dominical/festivo'),
            'valor_hora_extra_diurna' => Yii::t('app', 'Valor hora extra diurna'),
            'valor_hora_extra_nocturna' => Yii::t('app', 'Valor hora extra nocturna'),
            'valor_hora_extra_dia_festivo' => Yii::t('app', 'Valor hora extra día festivo'),
            'valor_hora_extra_nocturno_festivo' => Yii::t('app', 'Valor hora extra nocturno festivo'),
            'valor_dominical_compensatorio' => Yii::t('app', 'Valor dominical compensatorio'),
        ];
    }

    public function getLocationCountry(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationCountry::class, ['id' => 'location_country_id']);
    }

    public function getCreatedBy(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
