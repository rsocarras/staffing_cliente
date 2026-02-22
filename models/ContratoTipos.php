<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato_tipos".
 *
 * @property int $id
 * @property int|null $empresa_id
 * @property string $code
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $requiere_fecha_fin
 * @property int $es_indefinido
 * @property int|null $duracion_dias_default
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 */
class ContratoTipos extends \yii\db\ActiveRecord
{


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
            [['empresa_id', 'descripcion', 'duracion_dias_default'], 'default', 'value' => null],
            [['es_indefinido'], 'default', 'value' => 0],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'requiere_fecha_fin', 'es_indefinido', 'duracion_dias_default', 'activo'], 'integer'],
            [['code', 'nombre'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['descripcion'], 'string', 'max' => 255],
            [['empresa_id', 'code'], 'unique', 'targetAttribute' => ['empresa_id', 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'code' => 'Code',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'requiere_fecha_fin' => 'Requiere Fecha Fin',
            'es_indefinido' => 'Es Indefinido',
            'duracion_dias_default' => 'Duracion Dias Default',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
