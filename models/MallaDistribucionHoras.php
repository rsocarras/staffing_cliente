<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "malla_distribucion_horas".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $payroll_period_id
 * @property int $profile_id
 * @property int|null $sede_id
 * @property int|null $cargo_id
 * @property int|null $centro_costo_id
 * @property int|null $centro_utilidad_id
 * @property string $fecha
 * @property float $horas
 * @property int|null $created_by
 * @property string $created_at
 *
 * @property Cargos $cargo
 * @property ContabilidadCentroCosto $centroCosto
 * @property ContabilidadCentroUtilidad $centroUtilidad
 * @property User $createdBy
 * @property Empresas $empresa
 * @property PayrollPeriod $payrollPeriod
 * @property Profile $profile
 */
class MallaDistribucionHoras extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'malla_distribucion_horas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sede_id', 'cargo_id', 'centro_costo_id', 'centro_utilidad_id', 'created_by'], 'default', 'value' => null],
            [['empresa_id', 'payroll_period_id', 'profile_id', 'fecha', 'horas'], 'required'],
            [['empresa_id', 'payroll_period_id', 'profile_id', 'sede_id', 'cargo_id', 'centro_costo_id', 'centro_utilidad_id', 'created_by'], 'integer'],
            [['fecha', 'created_at'], 'safe'],
            [['horas'], 'number'],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['centro_costo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContabilidadCentroCosto::class, 'targetAttribute' => ['centro_costo_id' => 'id']],
            [['centro_utilidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContabilidadCentroUtilidad::class, 'targetAttribute' => ['centro_utilidad_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['payroll_period_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayrollPeriod::class, 'targetAttribute' => ['payroll_period_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
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
            'payroll_period_id' => 'Payroll Period ID',
            'profile_id' => 'Profile ID',
            'sede_id' => 'Sede ID',
            'cargo_id' => 'Cargo ID',
            'centro_costo_id' => 'Centro Costo ID',
            'centro_utilidad_id' => 'Centro Utilidad ID',
            'fecha' => 'Fecha',
            'horas' => 'Horas',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Cargo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }

    /**
     * Gets query for [[CentroCosto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCentroCosto()
    {
        return $this->hasOne(ContabilidadCentroCosto::class, ['id' => 'centro_costo_id']);
    }

    /**
     * Gets query for [[CentroUtilidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCentroUtilidad()
    {
        return $this->hasOne(ContabilidadCentroUtilidad::class, ['id' => 'centro_utilidad_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
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
     * Gets query for [[PayrollPeriod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayrollPeriod()
    {
        return $this->hasOne(PayrollPeriod::class, ['id' => 'payroll_period_id']);
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
