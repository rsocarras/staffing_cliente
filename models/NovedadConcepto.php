<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_concepto".
 *
 * @property int $id
 * @property int|null $novedad_tipo_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $icono
 * @property string|null $codigo
 * @property string|null $categoria
 * @property int $permite_masivo
 * @property string|null $modo_masivo_ext
 * @property int $sync_temporapp
 * @property int $va_a_nomina
 * @property string|null $correo_notif
 * @property int $tiene_handler
 * @property int $activo
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NovedadTipo $novedadTipo
 * @property Novedad[] $novedads
 */
class NovedadConcepto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_concepto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['novedad_tipo_id', 'descripcion', 'icono', 'codigo', 'categoria', 'correo_notif'], 'default', 'value' => null],
            [['updated_at'], 'default', 'value' => 0],
            [['modo_masivo_ext'], 'default', 'value' => 'xlsx'],
            [['activo'], 'default', 'value' => 1],
            [['novedad_tipo_id', 'permite_masivo', 'sync_temporapp', 'va_a_nomina', 'tiene_handler', 'activo', 'created_at', 'updated_at'], 'integer'],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['icono', 'codigo', 'categoria'], 'string', 'max' => 50],
            [['modo_masivo_ext'], 'string', 'max' => 10],
            [['correo_notif'], 'string', 'max' => 200],
            [['codigo'], 'unique'],
            [['novedad_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadTipo::class, 'targetAttribute' => ['novedad_tipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'novedad_tipo_id' => 'Novedad Tipo ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'icono' => 'Icono',
            'codigo' => 'Codigo',
            'categoria' => 'Categoria',
            'permite_masivo' => 'Permite Masivo',
            'modo_masivo_ext' => 'Modo Masivo Ext',
            'sync_temporapp' => 'Sync Temporapp',
            'va_a_nomina' => 'Va A Nomina',
            'correo_notif' => 'Correo Notif',
            'tiene_handler' => 'Tiene Handler',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[NovedadTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipo()
    {
        return $this->hasOne(NovedadTipo::class, ['id' => 'novedad_tipo_id']);
    }

    /**
     * Gets query for [[Novedads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedads()
    {
        return $this->hasMany(Novedad::class, ['concepto_id' => 'id']);
    }

}
