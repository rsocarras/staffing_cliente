<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $novedad_concepto_id
 * @property string $auth_item_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property NovedadConcepto $novedadConcepto
 */
class NovedadConceptoRol extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_concepto_rol';
    }

    public function rules(): array
    {
        return [
            [['novedad_concepto_id', 'auth_item_name'], 'required'],
            [['novedad_concepto_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['auth_item_name'], 'string', 'max' => 64],
            [['novedad_concepto_id', 'auth_item_name'], 'unique', 'targetAttribute' => ['novedad_concepto_id', 'auth_item_name']],
            [['novedad_concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConcepto::class, 'targetAttribute' => ['novedad_concepto_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'novedad_concepto_id' => Yii::t('app', 'Concepto'),
            'auth_item_name' => Yii::t('app', 'Rol RBAC'),
        ];
    }

    public function getNovedadConcepto(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConcepto::class, ['id' => 'novedad_concepto_id']);
    }
}
