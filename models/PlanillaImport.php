<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planilla_import".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $payroll_period_id
 * @property int $template_id
 * @property int $archivo_id
 * @property string $status
 * @property string|null $resumen_json
 * @property int|null $created_by
 * @property string $created_at
 * @property string|null $processed_at
 *
 * @property Archivos $archivo
 * @property User $createdBy
 * @property Empresas $empresa
 * @property PayrollPeriod $payrollPeriod
 * @property PlanillaError[] $planillaErrors
 * @property PlanillaTemplate $template
 */
class PlanillaImport extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_UPLOADED = 'uploaded';
    const STATUS_VALIDATED = 'validated';
    const STATUS_IMPORTED = 'imported';
    const STATUS_FAILED = 'failed';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planilla_import';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resumen_json', 'created_by', 'processed_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'uploaded'],
            [['empresa_id', 'payroll_period_id', 'template_id', 'archivo_id'], 'required'],
            [['empresa_id', 'payroll_period_id', 'template_id', 'archivo_id', 'created_by'], 'integer'],
            [['status'], 'string'],
            [['resumen_json', 'created_at', 'processed_at'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['archivo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archivos::class, 'targetAttribute' => ['archivo_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['payroll_period_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayrollPeriod::class, 'targetAttribute' => ['payroll_period_id' => 'id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanillaTemplate::class, 'targetAttribute' => ['template_id' => 'id']],
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
            'template_id' => 'Template ID',
            'archivo_id' => 'Archivo ID',
            'status' => 'Status',
            'resumen_json' => 'Resumen Json',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'processed_at' => 'Processed At',
        ];
    }

    /**
     * Gets query for [[Archivo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivo()
    {
        return $this->hasOne(Archivos::class, ['id' => 'archivo_id']);
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
     * Gets query for [[PlanillaErrors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanillaErrors()
    {
        return $this->hasMany(PlanillaError::class, ['import_id' => 'id']);
    }

    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(PlanillaTemplate::class, ['id' => 'template_id']);
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_UPLOADED => 'uploaded',
            self::STATUS_VALIDATED => 'validated',
            self::STATUS_IMPORTED => 'imported',
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
    public function isStatusUploaded()
    {
        return $this->status === self::STATUS_UPLOADED;
    }

    public function setStatusToUploaded()
    {
        $this->status = self::STATUS_UPLOADED;
    }

    /**
     * @return bool
     */
    public function isStatusValidated()
    {
        return $this->status === self::STATUS_VALIDATED;
    }

    public function setStatusToValidated()
    {
        $this->status = self::STATUS_VALIDATED;
    }

    /**
     * @return bool
     */
    public function isStatusImported()
    {
        return $this->status === self::STATUS_IMPORTED;
    }

    public function setStatusToImported()
    {
        $this->status = self::STATUS_IMPORTED;
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
