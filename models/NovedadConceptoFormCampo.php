<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $novedad_concepto_form_id
 * @property int $orden
 * @property string $campo_id
 * @property string $label
 * @property string $tipo_dato
 * @property int $requerido
 * @property int $calculado
 * @property string|null $formula
 * @property int|null $max_length
 * @property string|null $val_min
 * @property string|null $val_max
 * @property float|null $alerta_max
 * @property string|null $fuente_opciones
 * @property string|null $depende_de
 * @property string|null $visible_si_campo
 * @property string|null $visible_si_op
 * @property string|null $visible_si_valor
 * @property string $created_at
 * @property string $updated_at
 *
 * @property NovedadConceptoForm $novedadConceptoForm
 * @property NovedadConceptoFormCamposOpcion[] $opciones
 */
class NovedadConceptoFormCampo extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_concepto_form_campos';
    }

    public function rules(): array
    {
        return [
            [['formula', 'max_length', 'val_min', 'val_max', 'alerta_max', 'fuente_opciones', 'depende_de', 'visible_si_campo', 'visible_si_op', 'visible_si_valor'], 'default', 'value' => null],
            [['novedad_concepto_form_id', 'campo_id', 'label', 'tipo_dato'], 'required'],
            [['novedad_concepto_form_id', 'orden', 'requerido', 'calculado', 'max_length'], 'integer'],
            [['alerta_max'], 'number'],
            [['visible_si_valor'], 'string'],
            [['campo_id', 'val_min', 'val_max', 'fuente_opciones', 'depende_de', 'visible_si_campo'], 'string', 'max' => 50],
            [['label', 'formula'], 'string', 'max' => 100],
            [['tipo_dato'], 'string', 'max' => 30],
            [['visible_si_op'], 'string', 'max' => 20],
            [['created_at', 'updated_at'], 'safe'],
            [['novedad_concepto_form_id', 'campo_id'], 'unique', 'targetAttribute' => ['novedad_concepto_form_id', 'campo_id']],
            [['novedad_concepto_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConceptoForm::class, 'targetAttribute' => ['novedad_concepto_form_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'novedad_concepto_form_id' => Yii::t('app', 'Formulario'),
            'orden' => Yii::t('app', 'Orden'),
            'campo_id' => Yii::t('app', 'Campo ID'),
            'label' => Yii::t('app', 'Etiqueta'),
            'tipo_dato' => Yii::t('app', 'Tipo dato'),
            'requerido' => Yii::t('app', 'Requerido'),
            'calculado' => Yii::t('app', 'Calculado'),
            'formula' => Yii::t('app', 'Fórmula'),
            'max_length' => Yii::t('app', 'Max length'),
            'val_min' => Yii::t('app', 'Val min'),
            'val_max' => Yii::t('app', 'Val max'),
            'alerta_max' => Yii::t('app', 'Alerta max'),
            'fuente_opciones' => Yii::t('app', 'Fuente opciones'),
            'depende_de' => Yii::t('app', 'Depende de'),
            'visible_si_campo' => Yii::t('app', 'Visible si campo'),
            'visible_si_op' => Yii::t('app', 'Visible si op'),
            'visible_si_valor' => Yii::t('app', 'Visible si valor'),
            'created_at' => Yii::t('app', 'Creado'),
            'updated_at' => Yii::t('app', 'Actualizado'),
        ];
    }

    public function getNovedadConceptoForm(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConceptoForm::class, ['id' => 'novedad_concepto_form_id']);
    }

    public function getOpciones(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadConceptoFormCamposOpcion::class, ['novedad_concepto_form_campos_id' => 'id'])->orderBy(['orden' => SORT_ASC]);
    }
}
