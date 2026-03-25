<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $novedad_concepto_form_campos_id
 * @property string $valor
 * @property string|null $etiqueta
 * @property int $orden
 *
 * @property NovedadConceptoFormCampo $campo
 */
class NovedadConceptoFormCamposOpcion extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_concepto_form_campos_opcion';
    }

    public function rules(): array
    {
        return [
            [['etiqueta'], 'default', 'value' => null],
            [['orden'], 'default', 'value' => 0],
            [['novedad_concepto_form_campos_id', 'valor'], 'required'],
            [['novedad_concepto_form_campos_id', 'orden'], 'integer'],
            [['valor'], 'string', 'max' => 200],
            [['etiqueta'], 'string', 'max' => 200],
            [['novedad_concepto_form_campos_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConceptoFormCampo::class, 'targetAttribute' => ['novedad_concepto_form_campos_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'novedad_concepto_form_campos_id' => Yii::t('app', 'Campo'),
            'valor' => Yii::t('app', 'Valor'),
            'etiqueta' => Yii::t('app', 'Etiqueta'),
            'orden' => Yii::t('app', 'Orden'),
        ];
    }

    public function getCampo(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConceptoFormCampo::class, ['id' => 'novedad_concepto_form_campos_id']);
    }
}
