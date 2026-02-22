<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_setting".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $key
 * @property string|null $value_json
 * @property string $created_at
 * @property string $updated_at
 */
class CompanySetting extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value_json'], 'default', 'value' => null],
            [['empresa_id', 'key'], 'required'],
            [['empresa_id'], 'integer'],
            [['value_json', 'created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 120],
            [['empresa_id', 'key'], 'unique', 'targetAttribute' => ['empresa_id', 'key']],
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
            'key' => 'Key',
            'value_json' => 'Value Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
