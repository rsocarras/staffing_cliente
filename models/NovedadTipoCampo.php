<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_tipo_campo".
 *
 * @property int $id
 * @property int $novedad_tipo_id
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
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NovedadTipo $novedadTipo
 * @property NovedadTipoCampoOpcion[] $novedadTipoCampoOpcions
 */
class NovedadTipoCampo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_tipo_campo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['formula', 'max_length', 'val_min', 'val_max', 'alerta_max', 'fuente_opciones', 'depende_de', 'visible_si_campo', 'visible_si_op', 'visible_si_valor'], 'default', 'value' => null],
            [['updated_at'], 'default', 'value' => 0],
            [['novedad_tipo_id', 'campo_id', 'label', 'tipo_dato'], 'required'],
            [['novedad_tipo_id', 'orden', 'requerido', 'calculado', 'max_length', 'created_at', 'updated_at'], 'integer'],
            [['alerta_max'], 'number'],
            [['visible_si_valor'], 'string'],
            [['campo_id', 'val_min', 'val_max', 'fuente_opciones', 'depende_de', 'visible_si_campo'], 'string', 'max' => 50],
            [['label', 'formula'], 'string', 'max' => 100],
            [['tipo_dato'], 'string', 'max' => 30],
            [['visible_si_op'], 'string', 'max' => 20],
            [['novedad_tipo_id', 'campo_id'], 'unique', 'targetAttribute' => ['novedad_tipo_id', 'campo_id']],
            [['novedad_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadTipo::class, 'targetAttribute' => ['novedad_tipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'novedad_tipo_id' => 'Novedad Tipo ID',
            'orden' => 'Orden',
            'campo_id' => 'Campo ID',
            'label' => 'Label',
            'tipo_dato' => 'Tipo Dato',
            'requerido' => 'Requerido',
            'calculado' => 'Calculado',
            'formula' => 'Formula',
            'max_length' => 'Max Length',
            'val_min' => 'Val Min',
            'val_max' => 'Val Max',
            'alerta_max' => 'Alerta Max',
            'fuente_opciones' => 'Fuente Opciones',
            'depende_de' => 'Depende De',
            'visible_si_campo' => 'Visible Si Campo',
            'visible_si_op' => 'Visible Si Op',
            'visible_si_valor' => 'Visible Si Valor',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[NovedadTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipo()
    {
        return $this->hasOne(NovedadTipo::class, ['id' => 'novedad_tipo_id']);
    }

    /**
     * Gets query for [[NovedadTipoCampoOpcions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipoCampoOpcions()
    {
        return $this->hasMany(NovedadTipoCampoOpcion::class, ['novedad_tipo_campo_id' => 'id']);
    }

}
