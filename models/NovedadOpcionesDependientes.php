<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_opciones_dependientes".
 *
 * @property int $id
 * @property string $campo_hijo
 * @property string $campo_padre
 * @property string $valor_padre
 * @property string $valor
 * @property string|null $etiqueta
 * @property int $orden
 * @property int $activo
 */
class NovedadOpcionesDependientes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_opciones_dependientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['etiqueta'], 'default', 'value' => null],
            [['orden'], 'default', 'value' => 0],
            [['activo'], 'default', 'value' => 1],
            [['campo_hijo', 'campo_padre', 'valor_padre', 'valor'], 'required'],
            [['orden', 'activo'], 'integer'],
            [['campo_hijo', 'campo_padre'], 'string', 'max' => 50],
            [['valor_padre', 'valor', 'etiqueta'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campo_hijo' => 'Campo Hijo',
            'campo_padre' => 'Campo Padre',
            'valor_padre' => 'Valor Padre',
            'valor' => 'Valor',
            'etiqueta' => 'Etiqueta',
            'orden' => 'Orden',
            'activo' => 'Activo',
        ];
    }

}
