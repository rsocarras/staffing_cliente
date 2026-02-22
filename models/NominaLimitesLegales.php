<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nomina_limites_legales".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $year
 * @property string $config_json
 * @property string $created_at
 * @property string $updated_at
 */
class NominaLimitesLegales extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomina_limites_legales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['empresa_id', 'year', 'config_json'], 'required'],
            [['empresa_id', 'year'], 'integer'],
            [['config_json', 'created_at', 'updated_at'], 'safe'],
            [['empresa_id', 'year'], 'unique', 'targetAttribute' => ['empresa_id', 'year']],
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
            'config_json' => 'Config Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
