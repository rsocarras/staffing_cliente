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
            [['codigo', 'direccion'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo', 'city_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
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
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
