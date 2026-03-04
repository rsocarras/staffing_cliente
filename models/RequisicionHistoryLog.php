<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Historial de cambios de estado de requisiciones.
 *
 * @property int $id
 * @property int $requisicion_id
 * @property string|null $estado_anterior
 * @property string $estado_nuevo
 * @property string|null $comentario
 * @property int|null $usuario_id
 * @property int|null $duracion_minutos Minutos en estado_anterior antes del cambio
 * @property string $created_at
 *
 * @property Requisicion $requisicion
 * @property User $usuario
 */
class RequisicionHistoryLog extends ActiveRecord
{
    public static function tableName()
    {
        return 'requisicion_history_log';
    }

    public function rules()
    {
        return [
            [['requisicion_id', 'estado_nuevo'], 'required'],
            [['requisicion_id', 'usuario_id', 'duracion_minutos'], 'integer'],
            [['comentario'], 'string'],
            [['estado_anterior', 'estado_nuevo'], 'string', 'max' => 50],
            [['requisicion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicion::class, 'targetAttribute' => ['requisicion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * Registra un cambio de estado.
     * @param Requisicion $req
     * @param string $estadoNuevo
     * @param string|null $comentario
     * @param string|null $estadoAnterior Si null, usa $req->estado antes del cambio (el caller debe pasar el anterior si ya cambió)
     */
    public static function registrar(Requisicion $req, string $estadoNuevo, ?string $comentario = null, ?string $estadoAnterior = null)
    {
        $estadoAnt = $estadoAnterior ?? $req->getOldAttribute('estado');
        $prevLog = self::find()
            ->where(['requisicion_id' => $req->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(1)
            ->one();
        $duracion = null;
        if ($estadoAnt) {
            $ahora = $req->fecha_update ? strtotime($req->fecha_update) : time();
            $desde = null;
            if ($prevLog) {
                $desde = strtotime($prevLog->created_at);
            } elseif (!empty($req->fecha_creacion)) {
                $desde = strtotime($req->fecha_creacion);
            }
            if ($desde !== null) {
                $duracion = max(0, (int) floor(($ahora - $desde) / 60));
            }
        }
        $log = new self();
        $log->requisicion_id = $req->id;
        $log->estado_anterior = $estadoAnt;
        $log->estado_nuevo = $estadoNuevo;
        $log->comentario = $comentario ? trim($comentario) : null;
        $log->usuario_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
        $log->duracion_minutos = $duracion;
        return $log->save(false);
    }

    /**
     * Formatea minutos a "X h Y min".
     */
    public static function formatDuracion(?int $minutos): string
    {
        if ($minutos === null || $minutos < 0) {
            return '-';
        }
        if ($minutos < 60) {
            return $minutos . ' min';
        }
        $h = (int) floor($minutos / 60);
        $m = $minutos % 60;
        return $h . ' h ' . $m . ' min';
    }

    /**
     * Minutos en estado_anterior (entre transición anterior y esta).
     * Si no hay log previo, usa fecha_creacion de la requisición (tiempo desde creación).
     */
    public function getDuracionMinutosCalculada(): ?int
    {
        if ($this->duracion_minutos !== null) {
            return $this->duracion_minutos;
        }
        if (!$this->estado_anterior) {
            return null;
        }
        $prevLog = self::find()
            ->where(['requisicion_id' => $this->requisicion_id])
            ->andWhere(['<', 'created_at', $this->created_at])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(1)
            ->one();
        $desde = null;
        if ($prevLog) {
            $desde = strtotime($prevLog->created_at);
        } else {
            $req = $this->requisicion;
            if ($req && !empty($req->fecha_creacion)) {
                $desde = strtotime($req->fecha_creacion);
            }
        }
        if ($desde === null) {
            return null;
        }
        return max(0, (int) floor((strtotime($this->created_at) - $desde) / 60));
    }

    /**
     * Duración formateada para este log (tiempo en estado_anterior).
     */
    public function getDuracionFormateada(): string
    {
        return self::formatDuracion($this->getDuracionMinutosCalculada());
    }

    public function getRequisicion()
    {
        return $this->hasOne(Requisicion::class, ['id' => 'requisicion_id']);
    }

    public function getUsuario()
    {
        return $this->hasOne(User::class, ['id' => 'usuario_id']);
    }

    /**
     * Etiqueta legible del estado.
     */
    public function getEstadoAnteriorLabel()
    {
        return $this->estado_anterior ? (Requisicion::optsEstado()[$this->estado_anterior] ?? $this->estado_anterior) : '-';
    }

    public function getEstadoNuevoLabel()
    {
        return Requisicion::optsEstado()[$this->estado_nuevo] ?? $this->estado_nuevo;
    }
}
