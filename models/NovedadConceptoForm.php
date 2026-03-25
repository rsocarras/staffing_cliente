<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Cabecera de formulario dinámico por concepto (campos en novedad_concepto_form_campos).
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $activo
 * @property int $orden
 * @property string $created_at
 * @property string $updated_at
 *
 * @property NovedadConceptoFormCampo[] $novedadConceptoFormCampos
 * @property NovedadConcepto[] $novedadConceptos
 */
class NovedadConceptoForm extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_concepto_form';
    }

    public function rules(): array
    {
        return [
            [['descripcion'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['orden'], 'default', 'value' => 0],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['activo', 'orden'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 190],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripción'),
            'activo' => Yii::t('app', 'Activo'),
            'orden' => Yii::t('app', 'Orden'),
            'created_at' => Yii::t('app', 'Creado'),
            'updated_at' => Yii::t('app', 'Actualizado'),
        ];
    }

    public function getNovedadConceptoFormCampos(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadConceptoFormCampo::class, ['novedad_concepto_form_id' => 'id'])->orderBy(['orden' => SORT_ASC]);
    }

    public function getNovedadConceptos(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadConcepto::class, ['novedad_concepto_form_id' => 'id']);
    }
}
