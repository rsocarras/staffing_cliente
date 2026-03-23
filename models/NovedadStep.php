<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $novedad_flujo_id
 * @property string $codigo
 * @property string|null $nombre
 * @property string $tipo_paso
 * @property int|null $profile_id
 * @property int $orden
 * @property string $estado
 * @property int|null $started_at
 * @property int|null $completed_at
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NovedadFlujo $novedadFlujo
 * @property Profile|null $profile
 */
class NovedadStep extends ActiveRecord
{
    const TIPO_APROBACION = 'aprobacion';
    const TIPO_REVISION = 'revision';
    const TIPO_NOTIFICACION = 'notificacion';
    const TIPO_OTRO = 'otro';

    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_EN_CURSO = 'en_curso';
    const ESTADO_COMPLETADO = 'completado';
    const ESTADO_OMITIDO = 'omitido';
    const ESTADO_DEVUELTO = 'devuelto';

    public static function tableName()
    {
        return 'novedad_step';
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
            [
                'profile_id',
                'filter',
                'filter' => static function ($v) {
                    return $v === '' || $v === null ? null : (int) $v;
                },
            ],
            [['novedad_flujo_id', 'codigo'], 'required'],
            [['novedad_flujo_id', 'profile_id', 'orden', 'started_at', 'completed_at', 'created_at', 'updated_at'], 'integer'],
            [['nombre'], 'string'],
            [['codigo'], 'string', 'max' => 64],
            [['tipo_paso'], 'string', 'max' => 30],
            [['estado'], 'string', 'max' => 20],
            [
                ['estado'],
                'in',
                'range' => [
                    self::ESTADO_PENDIENTE,
                    self::ESTADO_EN_CURSO,
                    self::ESTADO_COMPLETADO,
                    self::ESTADO_OMITIDO,
                    self::ESTADO_DEVUELTO,
                ],
            ],
            [
                ['tipo_paso'],
                'in',
                'range' => [
                    self::TIPO_APROBACION,
                    self::TIPO_REVISION,
                    self::TIPO_NOTIFICACION,
                    self::TIPO_OTRO,
                ],
            ],
            [['nombre', 'profile_id', 'started_at', 'completed_at'], 'default', 'value' => null],
            [['tipo_paso'], 'default', 'value' => self::TIPO_REVISION],
            ['tipo_paso', 'validateTipoAprobacion'],
            [['orden'], 'default', 'value' => 0],
            [['estado'], 'default', 'value' => self::ESTADO_PENDIENTE],
            [
                ['novedad_flujo_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => NovedadFlujo::class,
                'targetAttribute' => ['novedad_flujo_id' => 'id'],
            ],
            [
                ['profile_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Profile::class,
                'targetAttribute' => ['profile_id' => 'user_id'],
            ],
            [
                ['codigo', 'novedad_flujo_id'],
                'unique',
                'targetAttribute' => ['codigo', 'novedad_flujo_id'],
                'message' => 'Ya existe un paso con este código en el flujo.',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'novedad_flujo_id' => 'Flujo',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'tipo_paso' => 'Tipo de paso',
            'profile_id' => 'Responsable',
            'orden' => 'Orden',
            'estado' => 'Estado',
            'started_at' => 'Inicio',
            'completed_at' => 'Fin',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    public static function tipoPasoLista()
    {
        return [
            self::TIPO_APROBACION => 'Aprobación',
            self::TIPO_REVISION => 'Revisión',
            self::TIPO_NOTIFICACION => 'Notificación',
            self::TIPO_OTRO => 'Otro',
        ];
    }

    public static function estadoLista()
    {
        return [
            self::ESTADO_PENDIENTE => 'Pendiente',
            self::ESTADO_EN_CURSO => 'En curso',
            self::ESTADO_COMPLETADO => 'Completado',
            self::ESTADO_OMITIDO => 'Omitido',
            self::ESTADO_DEVUELTO => 'Devuelto',
        ];
    }

    public function getNovedadFlujo()
    {
        return $this->hasOne(NovedadFlujo::class, ['id' => 'novedad_flujo_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

    /**
     * Un solo paso de tipo Aprobación por flujo y debe ir al final.
     */
    public function validateTipoAprobacion($attribute, $params = null): void
    {
        if ($this->tipo_paso !== self::TIPO_APROBACION) {
            return;
        }
        $q = static::find()->where(['novedad_flujo_id' => $this->novedad_flujo_id, 'tipo_paso' => self::TIPO_APROBACION]);
        if (!$this->isNewRecord) {
            $q->andWhere(['!=', 'id', $this->id]);
        }
        if ($q->exists()) {
            $this->addError($attribute, 'Ya existe un paso de Aprobación en este flujo.');
            return;
        }
        $qMayor = static::find()
            ->where(['novedad_flujo_id' => $this->novedad_flujo_id])
            ->andWhere(['>', 'orden', (int) $this->orden]);
        if (!$this->isNewRecord) {
            $qMayor->andWhere(['!=', 'id', $this->id]);
        }
        if ($qMayor->exists()) {
            $this->addError($attribute, 'El paso de Aprobación debe ser el último del flujo (ordene los pasos antes de guardar).');
        }
    }

    /**
     * Valida la regla global del flujo tras reordenar (o desde consola).
     */
    public static function mensajeValidacionAprobacionFlujo(int $flujoId): ?string
    {
        $steps = static::find()
            ->where(['novedad_flujo_id' => $flujoId])
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
        if ($steps === []) {
            return null;
        }
        $aprobacion = [];
        foreach ($steps as $s) {
            if ($s->tipo_paso === self::TIPO_APROBACION) {
                $aprobacion[] = $s;
            }
        }
        if ($aprobacion === []) {
            return null;
        }
        if (count($aprobacion) > 1) {
            return 'Solo puede existir un paso de tipo Aprobación en el flujo.';
        }
        $last = end($steps);
        if (!$last || (int) $last->id !== (int) $aprobacion[0]->id) {
            return 'El paso de Aprobación debe ser el último del flujo.';
        }
        return null;
    }
}
