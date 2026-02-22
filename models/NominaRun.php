<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nomina_run".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $payroll_period_id
 * @property string $status
 * @property string|null $input_params_json
 * @property string|null $started_at
 * @property string|null $finished_at
 * @property int|null $triggered_by
 * @property string $created_at
 *
 * @property Empresas $empresa
 * @property NominaItem[] $nominaItems
 * @property PayrollPeriod $payrollPeriod
 * @property User $triggeredBy
 */
class NominaRun extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_QUEUED = 'queued';
    const STATUS_RUNNING = 'running';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nomina_run';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['input_params_json', 'started_at', 'finished_at', 'triggered_by'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'queued'],
            [['empresa_id', 'payroll_period_id'], 'required'],
            [['empresa_id', 'payroll_period_id', 'triggered_by'], 'integer'],
            [['status'], 'string'],
            [['input_params_json', 'started_at', 'finished_at', 'created_at'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['payroll_period_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayrollPeriod::class, 'targetAttribute' => ['payroll_period_id' => 'id']],
            [['triggered_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['triggered_by' => 'id']],
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
            'status' => 'Status',
            'input_params_json' => 'Input Params Json',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'triggered_by' => 'Triggered By',
            'created_at' => 'Created At',
        ];
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
     * Gets query for [[NominaItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominaItems()
    {
        return $this->hasMany(NominaItem::class, ['nomina_run_id' => 'id']);
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
     * Gets query for [[TriggeredBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTriggeredBy()
    {
        return $this->hasOne(User::class, ['id' => 'triggered_by']);
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_QUEUED => 'queued',
            self::STATUS_RUNNING => 'running',
            self::STATUS_DONE => 'done',
            self::STATUS_FAILED => 'failed',
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
    public function isStatusQueued()
    {
        return $this->status === self::STATUS_QUEUED;
    }

    public function setStatusToQueued()
    {
        $this->status = self::STATUS_QUEUED;
    }

    /**
     * @return bool
     */
    public function isStatusRunning()
    {
        return $this->status === self::STATUS_RUNNING;
    }

    public function setStatusToRunning()
    {
        $this->status = self::STATUS_RUNNING;
    }

    /**
     * @return bool
     */
    public function isStatusDone()
    {
        return $this->status === self::STATUS_DONE;
    }

    public function setStatusToDone()
    {
        $this->status = self::STATUS_DONE;
    }

    /**
     * @return bool
     */
    public function isStatusFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    public function setStatusToFailed()
    {
        $this->status = self::STATUS_FAILED;
    }
}
