<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cargos".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int|null $area_id
 * @property int|null $sub_area_id
 * @property string|null $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Area $area
 * @property Area $subArea
 * @property MallaCargoAsignacion[] $mallaCargoAsignacions
 * @property MallaDistribucionHoras[] $mallaDistribucionHoras
 * @property Profile[] $profiles
 */
class Cargos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion', 'area_id', 'sub_area_id'], 'default', 'value' => null],
            [['codigo'], 'filter', 'filter' => function ($v) { return $v === '' ? null : $v; }],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo', 'area_id', 'sub_area_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['descripcion'], 'string', 'max' => 255],
            [['empresa_id', 'codigo'], 'unique', 'targetAttribute' => ['empresa_id', 'codigo']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['sub_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['sub_area_id' => 'id']],
            [['sub_area_id'], 'validateSubArea'],
        ];
    }

    /**
     * Valida que la sub-área pertenezca al área seleccionada.
     */
    public function validateSubArea($attribute, $params, $validator)
    {
        if ($this->sub_area_id && $this->area_id) {
            $subArea = Area::findOne($this->sub_area_id);
            if ($subArea && (int) $subArea->area_padre !== (int) $this->area_id) {
                $this->addError($attribute, 'La sub-área debe pertenecer al área seleccionada.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'area_id' => 'Área',
            'sub_area_id' => 'Sub-área',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Area]].
     */
    public function getArea()
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }

    /**
     * Gets query for [[SubArea]].
     */
    public function getSubArea()
    {
        return $this->hasOne(Area::class, ['id' => 'sub_area_id']);
    }

    /**
     * Gets query for [[MallaDistribucionHoras]].
     */
    public function getMallaDistribucionHoras()
    {
        return $this->hasMany(MallaDistribucionHoras::class, ['cargo_id' => 'id']);
    }

    public function getMallaCargoAsignacions()
    {
        return $this->hasMany(MallaCargoAsignacion::class, ['cargo_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['cargo_id' => 'id']);
    }
}
