<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nomina_item".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $nomina_run_id
 * @property int $profile_id
 * @property int $concepto_id
 * @property float|null $unidades
 * @property float $valor
 * @property string|null $detalle_json
 * @property string $created_at
 *
 * @property MaestrosConceptos $concepto
 * @property Empresas $empresa
 * @property NominaRun $nominaRun
 * @property Profile $profile
 */
class NominaItem extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomina_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unidades', 'detalle_json'], 'default', 'value' => null],
            [['empresa_id', 'nomina_run_id', 'profile_id', 'concepto_id', 'valor'], 'required'],
            [['empresa_id', 'nomina_run_id', 'profile_id', 'concepto_id'], 'integer'],
            [['unidades', 'valor'], 'number'],
            [['detalle_json', 'created_at'], 'safe'],
            [['concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaestrosConceptos::class, 'targetAttribute' => ['concepto_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['nomina_run_id'], 'exist', 'skipOnError' => true, 'targetClass' => NominaRun::class, 'targetAttribute' => ['nomina_run_id' => 'id']],
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
            'nomina_run_id' => 'Nomina Run ID',
            'profile_id' => 'Profile ID',
            'concepto_id' => 'Concepto ID',
            'unidades' => 'Unidades',
            'valor' => 'Valor',
            'detalle_json' => 'Detalle Json',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Concepto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(MaestrosConceptos::class, ['id' => 'concepto_id']);
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[NominaRun]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaRun()
    {
        return $this->hasOne(NominaRun::class, ['id' => 'nomina_run_id']);
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

}
