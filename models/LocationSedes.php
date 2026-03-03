<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location_sedes".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int|null $city_id
 * @property string|null $codigo
 * @property string $nombre
 * @property string|null $direccion
 * @property int $activo
 * @property int|null $centro_costo
 * @property int|null $centro_costo_staffing
 * @property string|null $codigo_externo
 * @property string $created_at
 * @property string $updated_at
 */
class LocationSedes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location_sedes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'direccion', 'codigo_externo'], 'default', 'value' => null],
            [['codigo', 'codigo_externo'], 'filter', 'filter' => function ($v) { return $v === '' ? null : $v; }],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo', 'city_id', 'centro_costo', 'centro_costo_staffing'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo', 'codigo_externo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['direccion'], 'string', 'max' => 255],
            [['empresa_id', 'codigo'], 'unique', 'targetAttribute' => ['empresa_id', 'codigo']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'city_id' => 'Ciudad',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'direccion' => 'Dirección',
            'activo' => 'Activo',
            'centro_costo' => 'Centro de Costo',
            'centro_costo_staffing' => 'Centro de Costo Staffing',
            'codigo_externo' => 'Código Externo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
