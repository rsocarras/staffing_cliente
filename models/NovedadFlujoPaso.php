<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_flujo_paso".
 *
 * @property int $id
 * @property int $novedad_tipo_id
 * @property string|null $nombre
 * @property string $tipo_paso
 * @property string|null $rol
 * @property string|null $email_notif
 * @property int $es_inicio
 * @property int|null $siguiente_id
 * @property int|null $siguiente_si_id
 * @property int|null $siguiente_no_id
 * @property string|null $condicion_campo
 * @property string|null $condicion_op
 * @property string|null $condicion_valor
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NovedadTipo $novedadTipo
 */
class NovedadFlujoPaso extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_flujo_paso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'rol', 'email_notif', 'siguiente_id', 'siguiente_si_id', 'siguiente_no_id', 'condicion_campo', 'condicion_op', 'condicion_valor'], 'default', 'value' => null],
            [['tipo_paso'], 'default', 'value' => 'aprobacion'],
            [['updated_at'], 'default', 'value' => 0],
            [['novedad_tipo_id'], 'required'],
            [['novedad_tipo_id', 'es_inicio', 'siguiente_id', 'siguiente_si_id', 'siguiente_no_id', 'created_at', 'updated_at'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['tipo_paso', 'condicion_op'], 'string', 'max' => 20],
            [['rol', 'condicion_campo'], 'string', 'max' => 50],
            [['email_notif', 'condicion_valor'], 'string', 'max' => 200],
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
            'nombre' => 'Nombre',
            'tipo_paso' => 'Tipo Paso',
            'rol' => 'Rol',
            'email_notif' => 'Email Notif',
            'es_inicio' => 'Es Inicio',
            'siguiente_id' => 'Siguiente ID',
            'siguiente_si_id' => 'Siguiente Si ID',
            'siguiente_no_id' => 'Siguiente No ID',
            'condicion_campo' => 'Condicion Campo',
            'condicion_op' => 'Condicion Op',
            'condicion_valor' => 'Condicion Valor',
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

}
