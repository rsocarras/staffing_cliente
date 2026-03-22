<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Historial de transiciones del presupuesto.
 *
 * @property int $id
 * @property int $presupuesto_id
 * @property string $accion
 * @property string|null $estado_anterior
 * @property string|null $estado_nuevo
 * @property string|null $comentario
 * @property int|null $actor_user_id
 * @property string $created_at
 *
 * @property Presupuesto $presupuesto
 * @property User|null $actor
 */
class PresupuestoHistorial extends ActiveRecord
{
    public const ACCION_CREATE = 'create';
    public const ACCION_UPDATE = 'update';
    public const ACCION_SUBMIT = 'submit';
    public const ACCION_APPROVE = 'approve';
    public const ACCION_REJECT = 'reject';
    public const ACCION_REOPEN = 'reopen';
    public const ACCION_CANCEL = 'cancel';
    public const ACCION_CLONE = 'clone';
    public const ACCION_REPLACE_PREVIOUS = 'replace_previous';

    public static function tableName()
    {
        return 'presupuesto_historial';
    }

    public function rules()
    {
        return [
            [['presupuesto_id', 'accion'], 'required'],
            [['presupuesto_id', 'actor_user_id'], 'integer'],
            [['comentario'], 'string'],
            [['estado_anterior', 'estado_nuevo'], 'string', 'max' => 32],
            [['accion'], 'string', 'max' => 40],
            [['created_at'], 'safe'],
            [['presupuesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presupuesto::class, 'targetAttribute' => ['presupuesto_id' => 'id']],
            [['actor_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['actor_user_id' => 'id']],
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (empty($this->created_at)) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    public function getPresupuesto()
    {
        return $this->hasOne(Presupuesto::class, ['id' => 'presupuesto_id']);
    }

    public function getActor()
    {
        return $this->hasOne(User::class, ['id' => 'actor_user_id']);
    }

    /**
     * @return static|false
     */
    public static function registrar(
        Presupuesto $presupuesto,
        string $accion,
        ?string $estadoAnterior,
        ?string $estadoNuevo,
        ?string $comentario = null
    ) {
        $log = new static();
        $log->presupuesto_id = $presupuesto->id;
        $log->accion = $accion;
        $log->estado_anterior = $estadoAnterior;
        $log->estado_nuevo = $estadoNuevo;
        $log->comentario = $comentario !== null && $comentario !== '' ? trim($comentario) : null;
        $log->actor_user_id = Yii::$app->user->isGuest ? null : (int) Yii::$app->user->id;
        $log->created_at = date('Y-m-d H:i:s');
        return $log->save(false) ? $log : false;
    }
}
