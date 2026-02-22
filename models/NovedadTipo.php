<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_tipo".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $icono
 * @property int $orden
 * @property int $activo
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Empresas $empresa
 * @property NovedadConcepto[] $novedadConceptos
 * @property NovedadFlujoPaso[] $novedadFlujoPasos
 * @property NovedadTipoCampo[] $novedadTipoCampos
 * @property Novedad[] $novedads
 */
class NovedadTipo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'icono'], 'default', 'value' => null],
            [['updated_at'], 'default', 'value' => 0],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'orden', 'activo', 'created_at', 'updated_at'], 'integer'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['icono'], 'string', 'max' => 50],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
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
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'icono' => 'Icono',
            'orden' => 'Orden',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[NovedadConceptos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadConceptos()
    {
        return $this->hasMany(NovedadConcepto::class, ['novedad_tipo_id' => 'id']);
    }

    /**
     * Gets query for [[NovedadFlujoPasos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadFlujoPasos()
    {
        return $this->hasMany(NovedadFlujoPaso::class, ['novedad_tipo_id' => 'id']);
    }

    /**
     * Gets query for [[NovedadTipoCampos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipoCampos()
    {
        return $this->hasMany(NovedadTipoCampo::class, ['novedad_tipo_id' => 'id']);
    }

    /**
     * Gets query for [[Novedads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedads()
    {
        return $this->hasMany(Novedad::class, ['novedad_tipo_id' => 'id']);
    }

}
