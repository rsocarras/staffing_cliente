<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_tipo_campo_opcion".
 *
 * @property int $id
 * @property int $novedad_tipo_campo_id
 * @property string $valor
 * @property string|null $etiqueta
 * @property int $orden
 *
 * @property NovedadTipoCampo $novedadTipoCampo
 */
class NovedadTipoCampoOpcion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_tipo_campo_opcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['etiqueta'], 'default', 'value' => null],
            [['orden'], 'default', 'value' => 0],
            [['novedad_tipo_campo_id', 'valor'], 'required'],
            [['novedad_tipo_campo_id', 'orden'], 'integer'],
            [['valor', 'etiqueta'], 'string', 'max' => 200],
            [['novedad_tipo_campo_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadTipoCampo::class, 'targetAttribute' => ['novedad_tipo_campo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'novedad_tipo_campo_id' => 'Novedad Tipo Campo ID',
            'valor' => 'Valor',
            'etiqueta' => 'Etiqueta',
            'orden' => 'Orden',
        ];
    }

    /**
     * Gets query for [[NovedadTipoCampo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipoCampo()
    {
        return $this->hasOne(NovedadTipoCampo::class, ['id' => 'novedad_tipo_campo_id']);
    }

}
