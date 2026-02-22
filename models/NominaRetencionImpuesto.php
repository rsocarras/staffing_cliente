<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nomina_retencion_impuesto".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $year
 * @property string $key
 * @property string $config_json
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 */
class NominaRetencionImpuesto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomina_retencion_impuesto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'year', 'key', 'config_json'], 'required'],
            [['empresa_id', 'year', 'activo'], 'integer'],
            [['config_json', 'created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 120],
            [['empresa_id', 'year', 'key'], 'unique', 'targetAttribute' => ['empresa_id', 'year', 'key']],
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
            'year' => 'Year',
            'key' => 'Key',
            'config_json' => 'Config Json',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
