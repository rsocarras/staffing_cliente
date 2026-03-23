<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "novedad_tipo".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $icono
 * @property int $orden
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

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
            [['activo'], 'default', 'value' => 1],
            [['nombre'], 'required'],
            [['orden', 'activo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['icono'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
