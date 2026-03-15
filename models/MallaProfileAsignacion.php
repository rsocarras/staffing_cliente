<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "malla_profile_asignacion".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $malla_id
 * @property int $profile_id
 * @property string $estado_aprobacion
 * @property string|null $motivo_rechazo
 * @property int|null $solicitado_por
 * @property int|null $aprobado_por
 * @property string $solicitado_at
 * @property string|null $aprobado_at
 * @property int $es_actual
 * @property int $activo
 *
 * @property Empresas $empresa
 * @property Mallas $malla
 * @property Profile $profile
 * @property User $solicitadoPor
 * @property User $aprobadoPor
 */
class MallaProfileAsignacion extends ActiveRecord
{
    const ESTADO_PENDIENTE = 'pendiente_aprobacion';
    const ESTADO_APROBADA = 'aprobada';
    const ESTADO_RECHAZADA = 'rechazada';

    public static function tableName()
    {
        return 'malla_profile_asignacion';
    }

    public function rules()
    {
        return [
            [['motivo_rechazo', 'solicitado_por', 'aprobado_por', 'aprobado_at'], 'default', 'value' => null],
            [['estado_aprobacion'], 'default', 'value' => self::ESTADO_PENDIENTE],
            [['es_actual', 'activo'], 'default', 'value' => 0],
            [['empresa_id', 'malla_id', 'profile_id'], 'required'],
            [['empresa_id', 'malla_id', 'profile_id', 'solicitado_por', 'aprobado_por', 'es_actual', 'activo'], 'integer'],
            [['solicitado_at', 'aprobado_at'], 'safe'],
            [['estado_aprobacion'], 'string', 'max' => 32],
            [['motivo_rechazo'], 'string', 'max' => 255],
            [['estado_aprobacion'], 'in', 'range' => array_keys(self::optsEstadoAprobacion())],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['malla_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mallas::class, 'targetAttribute' => ['malla_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['solicitado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['solicitado_por' => 'id']],
            [['aprobado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['aprobado_por' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa',
            'malla_id' => 'Malla',
            'profile_id' => 'Empleado',
            'estado_aprobacion' => 'Estado aprobación',
            'motivo_rechazo' => 'Motivo rechazo',
            'solicitado_por' => 'Solicitado por',
            'aprobado_por' => 'Aprobado por',
            'solicitado_at' => 'Solicitado el',
            'aprobado_at' => 'Aprobado el',
            'es_actual' => 'Asignación actual',
            'activo' => 'Activo',
        ];
    }

    public static function optsEstadoAprobacion()
    {
        return [
            self::ESTADO_PENDIENTE => 'Pendiente aprobación',
            self::ESTADO_APROBADA => 'Aprobada',
            self::ESTADO_RECHAZADA => 'Rechazada',
        ];
    }

    public function displayEstadoAprobacion()
    {
        $items = self::optsEstadoAprobacion();
        return $items[$this->estado_aprobacion] ?? $this->estado_aprobacion;
    }

    public function approve($userId)
    {
        $transaction = self::getDb()->beginTransaction();
        try {
            self::updateAll(
                ['es_actual' => 0],
                [
                    'and',
                    ['empresa_id' => $this->empresa_id, 'profile_id' => $this->profile_id],
                    ['estado_aprobacion' => self::ESTADO_APROBADA],
                    ['es_actual' => 1],
                    ['<>', 'id', $this->id],
                ]
            );

            $this->estado_aprobacion = self::ESTADO_APROBADA;
            $this->es_actual = 1;
            $this->activo = 1;
            $this->motivo_rechazo = null;
            $this->aprobado_por = $userId;
            $this->aprobado_at = new Expression('NOW()');
            $this->save(false);

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public static function getCurrentApprovedForProfile($empresaId, $profileId)
    {
        return self::find()
            ->where([
                'empresa_id' => $empresaId,
                'profile_id' => $profileId,
                'estado_aprobacion' => self::ESTADO_APROBADA,
                'es_actual' => 1,
                'activo' => 1,
            ])
            ->orderBy(['id' => SORT_DESC])
            ->one();
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getMalla()
    {
        return $this->hasOne(Mallas::class, ['id' => 'malla_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

    public function getSolicitadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'solicitado_por']);
    }

    public function getAprobadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'aprobado_por']);
    }
}
