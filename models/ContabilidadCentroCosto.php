<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contabilidad_centro_costo".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $codigo
 * @property string $nombre
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EmpleadoVenueHistory[] $empleadoVenueHistories
 * @property MallaDistribucionHoras[] $mallaDistribucionHoras
 * @property Profile[] $profiles
 */
class ContabilidadCentroCosto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contabilidad_centro_costo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'codigo', 'nombre'], 'required'],
            [['empresa_id', 'activo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['empresa_id', 'codigo'], 'unique', 'targetAttribute' => ['empresa_id', 'codigo']],
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
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[EmpleadoVenueHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoVenueHistories()
    {
        return $this->hasMany(EmpleadoVenueHistory::class, ['centro_costo_id' => 'id']);
    }

    /**
     * Gets query for [[MallaDistribucionHoras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMallaDistribucionHoras()
    {
        return $this->hasMany(MallaDistribucionHoras::class, ['centro_costo_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['centro_costo_id' => 'id']);
    }

}
