<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mallas".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $tipo
 * @property int $activo
 * @property string|null $config_json
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MallasHorarios[] $mallasHorarios
 */
class Mallas extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_FIJA = 'fija';
    const TIPO_ROTATIVA = 'rotativa';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mallas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'config_json'], 'default', 'value' => null],
            [['tipo'], 'default', 'value' => 'fija'],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo'], 'integer'],
            [['tipo'], 'string'],
            [['config_json', 'created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 190],
            [['descripcion'], 'string', 'max' => 255],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
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
            'tipo' => 'Tipo',
            'activo' => 'Activo',
            'config_json' => 'Config Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[MallasHorarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMallasHorarios()
    {
        return $this->hasMany(MallasHorarios::class, ['malla_id' => 'id']);
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_FIJA => 'fija',
            self::TIPO_ROTATIVA => 'rotativa',
        ];
    }

    /**
     * @return string
     */
    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return bool
     */
    public function isTipoFija()
    {
        return $this->tipo === self::TIPO_FIJA;
    }

    public function setTipoToFija()
    {
        $this->tipo = self::TIPO_FIJA;
    }

    /**
     * @return bool
     */
    public function isTipoRotativa()
    {
        return $this->tipo === self::TIPO_ROTATIVA;
    }

    public function setTipoToRotativa()
    {
        $this->tipo = self::TIPO_ROTATIVA;
    }
}
