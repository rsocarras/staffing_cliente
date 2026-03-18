<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Modelo para la tabla "candidato".
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo_documento
 * @property string $num_documento
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $birthday
 * @property string|null $sexo
 * @property string $estado
 * @property string|null $observaciones
 * @property int|null $creado_por
 * @property int|null $actualizado_por
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User|null $creadoPor
 * @property User|null $actualizadoPor
 */
class Candidato extends \yii\db\ActiveRecord
{
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_INACTIVO = 'inactivo';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'candidato';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('CURRENT_TIMESTAMP'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'creado_por',
                'updatedByAttribute' => 'actualizado_por',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'tipo_documento', 'num_documento'], 'required'],
            [['correo', 'telefono', 'birthday', 'sexo', 'observaciones'], 'default', 'value' => null],
            [['tipo_documento'], 'default', 'value' => 'CC'],
            [['estado'], 'default', 'value' => self::ESTADO_ACTIVO],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['creado_por', 'actualizado_por'], 'integer'],
            [['observaciones'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombres', 'apellidos'], 'string', 'max' => 250],
            [['correo'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 45],
            [['tipo_documento'], 'string', 'max' => 10],
            [['num_documento'], 'string', 'max' => 30],
            [['sexo'], 'string', 'max' => 2],
            [['estado'], 'string', 'max' => 20],
            [['estado'], 'in', 'range' => array_keys(self::optsEstado())],
            [['creado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creado_por' => 'id']],
            [['actualizado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['actualizado_por' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'tipo_documento' => 'Tipo documento',
            'num_documento' => 'Número documento',
            'correo' => 'Correo',
            'telefono' => 'Teléfono',
            'birthday' => 'Fecha nacimiento',
            'sexo' => 'Sexo',
            'estado' => 'Estado',
            'observaciones' => 'Observaciones',
            'creado_por' => 'Creado por',
            'actualizado_por' => 'Actualizado por',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
        ];
    }

    /**
     * Opciones para estado.
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_ACTIVO => 'Activo',
            self::ESTADO_INACTIVO => 'Inactivo',
        ];
    }

    /**
     * Opciones para sexo.
     */
    public static function optsSexo()
    {
        return [
            'M' => 'Masculino',
            'F' => 'Femenino',
            'O' => 'Otro',
        ];
    }

    /**
     * Nombre completo del candidato.
     * @return string
     */
    public function getNombreCompleto()
    {
        return trim($this->nombres . ' ' . $this->apellidos);
    }

    /**
     * Gets query for [[creadoPor]].
     */
    public function getCreadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'creado_por']);
    }

    /**
     * Gets query for [[actualizadoPor]].
     */
    public function getActualizadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'actualizado_por']);
    }
}
