<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planilla_error".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $import_id
 * @property int $row_number
 * @property string|null $col_name
 * @property string|null $error_code
 * @property string $message
 * @property string|null $raw_value
 * @property string $created_at
 *
 * @property Empresas $empresa
 * @property PlanillaImport $import
 */
class PlanillaError extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planilla_error';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['col_name', 'error_code', 'raw_value'], 'default', 'value' => null],
            [['empresa_id', 'import_id', 'row_number', 'message'], 'required'],
            [['empresa_id', 'import_id', 'row_number'], 'integer'],
            [['created_at'], 'safe'],
            [['col_name'], 'string', 'max' => 190],
            [['error_code'], 'string', 'max' => 50],
            [['message', 'raw_value'], 'string', 'max' => 255],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['import_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanillaImport::class, 'targetAttribute' => ['import_id' => 'id']],
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
            'import_id' => 'Import ID',
            'row_number' => 'Row Number',
            'col_name' => 'Col Name',
            'error_code' => 'Error Code',
            'message' => 'Message',
            'raw_value' => 'Raw Value',
            'created_at' => 'Created At',
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
     * Gets query for [[Import]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImport()
    {
        return $this->hasOne(PlanillaImport::class, ['id' => 'import_id']);
    }

}
