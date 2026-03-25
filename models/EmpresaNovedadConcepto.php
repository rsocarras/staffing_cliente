<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $empresa_id
 * @property int $novedad_concepto_id
 * @property string $created_at
 *
 * @property Empresas $empresa
 * @property NovedadConcepto $novedadConcepto
 */
class EmpresaNovedadConcepto extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'empresa_novedad_concepto';
    }

    public static function primaryKey(): array
    {
        return ['empresa_id', 'novedad_concepto_id'];
    }

    public function rules(): array
    {
        return [
            [['empresa_id', 'novedad_concepto_id'], 'required'],
            [['empresa_id', 'novedad_concepto_id'], 'integer'],
            [['created_at'], 'safe'],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['novedad_concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConcepto::class, 'targetAttribute' => ['novedad_concepto_id' => 'id']],
        ];
    }

    public function getEmpresa(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getNovedadConcepto(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConcepto::class, ['id' => 'novedad_concepto_id']);
    }
}
