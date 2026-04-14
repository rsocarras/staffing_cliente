<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato_tipos".
 *
 * @property int $id
 * @property string $code
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $requiere_fecha_fin
 * @property int $es_indefinido
 * @property int|null $duracion_dias_default
 * @property int $activo
 * @property string $modalidad_contratacion
 * @property string $created_at
 * @property string $updated_at
 */
class ContratoTipos extends \yii\db\ActiveRecord
{
    public const MODALIDAD_DIRECTO = 'directo';

    public const MODALIDAD_TEMPORAL = 'temporal';

    public const MODALIDAD_AMBOS = 'ambos';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contrato_tipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'duracion_dias_default'], 'default', 'value' => null],
            [['es_indefinido'], 'default', 'value' => 0],
            [['activo'], 'default', 'value' => 1],
            [['modalidad_contratacion'], 'default', 'value' => self::MODALIDAD_AMBOS],
            [['requiere_fecha_fin', 'es_indefinido', 'duracion_dias_default', 'activo'], 'integer'],
            [['code', 'nombre', 'modalidad_contratacion'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['descripcion'], 'string', 'max' => 255],
            [['modalidad_contratacion'], 'in', 'range' => array_keys(self::optsModalidadContratacion())],
            [['code'], 'unique'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function optsModalidadContratacion(): array
    {
        return [
            self::MODALIDAD_DIRECTO => 'Directo',
            self::MODALIDAD_TEMPORAL => 'Temporal',
            self::MODALIDAD_AMBOS => 'Ambas modalidades',
        ];
    }

    /**
     * @return static[]
     */
    public static function findActivosPorModalidad(string $modalidad): array
    {
        if (!in_array($modalidad, [self::MODALIDAD_DIRECTO, self::MODALIDAD_TEMPORAL], true)) {
            return [];
        }

        $schema = static::getTableSchema();
        if ($schema === null || $schema->getColumn('modalidad_contratacion') === null) {
            return static::find()->where(['activo' => 1])->orderBy(['nombre' => SORT_ASC])->all();
        }

        return static::find()
            ->where(['activo' => 1])
            ->andWhere([
                'or',
                ['modalidad_contratacion' => self::MODALIDAD_AMBOS],
                ['modalidad_contratacion' => $modalidad],
            ])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();
    }

    public static function aplicaAModalidad(?self $tipo, string $modalidad): bool
    {
        if ($tipo === null || $modalidad === '') {
            return false;
        }
        if (!in_array($modalidad, [self::MODALIDAD_DIRECTO, self::MODALIDAD_TEMPORAL], true)) {
            return false;
        }
        if (!$tipo->hasAttribute('modalidad_contratacion')) {
            return true;
        }
        $m = (string) $tipo->modalidad_contratacion;
        if ($m === '') {
            return true;
        }

        return $m === self::MODALIDAD_AMBOS || $m === $modalidad;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'requiere_fecha_fin' => 'Requiere Fecha Fin',
            'es_indefinido' => 'Es Indefinido',
            'duracion_dias_default' => 'Duracion Dias Default',
            'activo' => 'Activo',
            'modalidad_contratacion' => 'Modalidad de contratación',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
