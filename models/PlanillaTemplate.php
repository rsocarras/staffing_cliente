<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planilla_template".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $version
 * @property string $nombre
 * @property string $columnas_json
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PlanillaImport[] $planillaImports
 */
class PlanillaTemplate extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planilla_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre', 'columnas_json'], 'required'],
            [['empresa_id', 'version', 'activo'], 'integer'],
            [['columnas_json', 'created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 190],
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
            'version' => 'Version',
            'nombre' => 'Nombre',
            'columnas_json' => 'Columnas Json',
            'activo' => 'Activo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[PlanillaImports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillaImports()
    {
        return $this->hasMany(PlanillaImport::class, ['template_id' => 'id']);
    }

}
