<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payroll_period".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $year
 * @property int $month
 * @property string $start_date
 * @property string $end_date
 * @property string|null $cutoff_date
 * @property string $status
 * @property string|null $generated_at
 * @property string|null $authorized_at
 * @property string|null $closed_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MallaDistribucionHoras[] $mallaDistribucionHoras
 * @property NominaRun[] $nominaRuns
 * @property PlanillaImport[] $planillaImports
 */
class PayrollPeriod extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_PENDIENTE_CARGAR = 'pendiente_cargar';
    const STATUS_CARGADA_PENDIENTE_AUT = 'cargada_pendiente_aut';
    const STATUS_PROCESADA = 'procesada';
    const STATUS_CERRADA = 'cerrada';
    const STATUS_PAGADA = 'pagada';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payroll_period';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cutoff_date', 'generated_at', 'authorized_at', 'closed_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'pendiente_cargar'],
            [['empresa_id', 'year', 'month', 'start_date', 'end_date'], 'required'],
            [['empresa_id', 'year', 'month'], 'integer'],
            [['start_date', 'end_date', 'cutoff_date', 'generated_at', 'authorized_at', 'closed_at', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['empresa_id', 'year', 'month'], 'unique', 'targetAttribute' => ['empresa_id', 'year', 'month']],
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
            'year' => 'Year',
            'month' => 'Month',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'cutoff_date' => 'Cutoff Date',
            'status' => 'Status',
            'generated_at' => 'Generated At',
            'authorized_at' => 'Authorized At',
            'closed_at' => 'Closed At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[MallaDistribucionHoras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMallaDistribucionHoras()
    {
        return $this->hasMany(MallaDistribucionHoras::class, ['payroll_period_id' => 'id']);
    }

    /**
     * Gets query for [[NominaRuns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaRuns()
    {
        return $this->hasMany(NominaRun::class, ['payroll_period_id' => 'id']);
    }

    /**
     * Gets query for [[PlanillaImports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillaImports()
    {
        return $this->hasMany(PlanillaImport::class, ['payroll_period_id' => 'id']);
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_PENDIENTE_CARGAR => 'pendiente_cargar',
            self::STATUS_CARGADA_PENDIENTE_AUT => 'cargada_pendiente_aut',
            self::STATUS_PROCESADA => 'procesada',
            self::STATUS_CERRADA => 'cerrada',
            self::STATUS_PAGADA => 'pagada',
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusPendientecargar()
    {
        return $this->status === self::STATUS_PENDIENTE_CARGAR;
    }

    public function setStatusToPendientecargar()
    {
        $this->status = self::STATUS_PENDIENTE_CARGAR;
    }

    /**
     * @return bool
     */
    public function isStatusCargadapendienteaut()
    {
        return $this->status === self::STATUS_CARGADA_PENDIENTE_AUT;
    }

    public function setStatusToCargadapendienteaut()
    {
        $this->status = self::STATUS_CARGADA_PENDIENTE_AUT;
    }

    /**
     * @return bool
     */
    public function isStatusProcesada()
    {
        return $this->status === self::STATUS_PROCESADA;
    }

    public function setStatusToProcesada()
    {
        $this->status = self::STATUS_PROCESADA;
    }

    /**
     * @return bool
     */
    public function isStatusCerrada()
    {
        return $this->status === self::STATUS_CERRADA;
    }

    public function setStatusToCerrada()
    {
        $this->status = self::STATUS_CERRADA;
    }

    /**
     * @return bool
     */
    public function isStatusPagada()
    {
        return $this->status === self::STATUS_PAGADA;
    }

    public function setStatusToPagada()
    {
        $this->status = self::STATUS_PAGADA;
    }
}
