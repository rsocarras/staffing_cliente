<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $estado
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NovedadStep[] $novedadSteps
 * @property NovedadStepHistoryLog[] $novedadStepHistoryLogs
 */
class NovedadFlujo extends ActiveRecord
{
    const ESTADO_BORRADOR = 'borrador';
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_INACTIVO = 'inactivo';

    public static function tableName()
    {
        return 'novedad_flujo';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['estado'], 'string', 'max' => 20],
            [
                ['estado'],
                'in',
                'range' => [
                    self::ESTADO_BORRADOR,
                    self::ESTADO_ACTIVO,
                    self::ESTADO_INACTIVO,
                ],
            ],
            [['descripcion'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => self::ESTADO_BORRADOR],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    public static function estadoLista()
    {
        return [
            self::ESTADO_BORRADOR => 'Borrador',
            self::ESTADO_ACTIVO => 'Activo',
            self::ESTADO_INACTIVO => 'Inactivo',
        ];
    }

    /**
     * Clase Bootstrap (variante badge-soft-*) según estado del flujo.
     */
    public static function estadoBadgeSoftClass(string $estado): string
    {
        switch ($estado) {
            case self::ESTADO_ACTIVO:
                return 'success';
            case self::ESTADO_INACTIVO:
                return 'danger';
            case self::ESTADO_BORRADOR:
                return 'warning';
            default:
                return 'secondary';
        }
    }

    public function getNovedadSteps()
    {
        return $this->hasMany(NovedadStep::class, ['novedad_flujo_id' => 'id'])->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC]);
    }

    public function getNovedadStepHistoryLogs()
    {
        return $this->hasMany(NovedadStepHistoryLog::class, ['novedad_flujo_id' => 'id']);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        NovedadStep::deleteAll(['novedad_flujo_id' => $this->id]);
        NovedadStepHistoryLog::deleteAll(['novedad_flujo_id' => $this->id]);
        return true;
    }
}
