<?php

namespace app\services;

use app\models\Requisicion;
use app\models\RequisicionHistoryLog;
use app\models\Profile;
use app\models\ChecklistStatus;
use app\models\ChecklistItem;
use app\models\WebhookLog;
use Yii;
use yii\db\Transaction;

class RequisicionService
{
    /**
     * Envía requisición a aprobación
     */
    public static function submit(Requisicion $req)
    {
        if ($req->estado !== Requisicion::ESTADO_DRAFT) {
            throw new \DomainException('Solo se pueden enviar requisiciones en borrador.');
        }
        $estadoAnterior = $req->estado;
        $req->estado = Requisicion::ESTADO_APPROVAL_PENDING;
        return $req->save(false) && RequisicionHistoryLog::registrar($req, $req->estado, null, $estadoAnterior);
    }

    /**
     * Aprueba la requisición
     */
    public static function approve(Requisicion $req)
    {
        if ($req->estado !== Requisicion::ESTADO_APPROVAL_PENDING) {
            throw new \DomainException('Solo se pueden aprobar requisiciones pendientes.');
        }
        $estadoAnterior = $req->estado;
        $req->motivo_rechazo = null;
        $req->estado = Requisicion::ESTADO_ORDER_PENDING;
        return $req->save(false) && RequisicionHistoryLog::registrar($req, $req->estado, null, $estadoAnterior);
    }

    /**
     * Rechaza la requisición (requiere motivo)
     */
    public static function reject(Requisicion $req, $motivo)
    {
        if ($req->estado !== Requisicion::ESTADO_APPROVAL_PENDING) {
            throw new \DomainException('Solo se pueden rechazar requisiciones pendientes.');
        }
        if (empty(trim($motivo))) {
            throw new \DomainException('El motivo de rechazo es obligatorio.');
        }
        $estadoAnterior = $req->estado;
        $req->estado = Requisicion::ESTADO_REJECTED;
        $req->motivo_rechazo = $motivo;
        return $req->save(false) && RequisicionHistoryLog::registrar($req, $req->estado, $motivo, $estadoAnterior);
    }

    /**
     * Asigna persona a la vacante (autopobla datos)
     */
    public static function assignPerson(Requisicion $req, $profileId, $comentario = null)
    {
        if (!in_array($req->estado, [Requisicion::ESTADO_ORDER_PENDING, Requisicion::ESTADO_PERSON_ASSIGNED])) {
            throw new \DomainException('Estado no permite asignar persona.');
        }
        $profile = Profile::findOne($profileId);
        if (!$profile) {
            throw new \DomainException('Perfil no encontrado.');
        }
        $estadoAnterior = $req->estado;
        $req->profile_id = $profileId;
        $req->nombres = $profile->name ? explode(' ', $profile->name)[0] ?? $profile->name : null;
        $req->apellidos = $profile->name ? implode(' ', array_slice(explode(' ', $profile->name), 1)) : null;
        $req->tipo_documento = $profile->tipo_doc;
        $req->num_documento = $profile->num_doc;
        $req->correo = $profile->public_email;
        $req->telefono = $profile->telefono;
        $req->birthday = $profile->birthday;
        $req->sexo = $profile->sexo;
        $req->estado = Requisicion::ESTADO_PERSON_ASSIGNED;
        return $req->save(false) && RequisicionHistoryLog::registrar($req, $req->estado, $comentario, $estadoAnterior);
    }

    /**
     * Paso vinculación: Sí (habilita checklist) o No (rechaza)
     */
    public static function vincular(Requisicion $req, $aprobada, $motivoRechazo = null)
    {
        if ($req->estado !== Requisicion::ESTADO_PERSON_ASSIGNED) {
            throw new \DomainException('Estado no permite paso vinculación.');
        }
        $estadoAnterior = $req->estado;
        $req->vinculacion_aprobada = $aprobada ? 1 : 0;
        $req->vinculacion_motivo_rechazo = $motivoRechazo;
        if ($aprobada) {
            $req->estado = Requisicion::ESTADO_HIRING_IN_PROGRESS;
            ChecklistStatus::inicializarParaRequisicion($req->id);
        } else {
            $req->estado = Requisicion::ESTADO_VINCULATION_REJECTED;
        }
        return $req->save(false) && RequisicionHistoryLog::registrar($req, $req->estado, $motivoRechazo, $estadoAnterior);
    }

    /**
     * Activa la contratación: persona ACTIVO, webhook, reportes
     */
    public static function activar(Requisicion $req, $comentario = null)
    {
        if ($req->estado !== Requisicion::ESTADO_HIRING_IN_PROGRESS) {
            throw new \DomainException('Solo se puede activar en estado HIRING_IN_PROGRESS.');
        }
        if (!$req->checklistCompleto()) {
            throw new \DomainException('Debe completar todos los ítems obligatorios del checklist.');
        }
        if (!$req->profile_id) {
            throw new \DomainException('Debe asignar una persona.');
        }

        $estadoAnterior = $req->estado;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $req->estado = Requisicion::ESTADO_ACTIVE;
            $req->save(false);

            RequisicionHistoryLog::registrar($req, $req->estado, $comentario, $estadoAnterior);

            $profile = Profile::findOne($req->profile_id);
            if ($profile) {
                $profile->estado = Profile::ESTADO_ACTIVO;
                $profile->save(false);
            }

            self::ejecutarWebhookMyBodytech($req);

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    protected static function ejecutarWebhookMyBodytech(Requisicion $req)
    {
        $url = Yii::$app->params['webhookMyBodytechUrl'] ?? null;
        if (!$url) {
            return;
        }
        $payload = [
            'persona_id' => $req->profile_id,
            'num_documento' => $req->num_documento,
            'sede' => $req->sede ? $req->sede->nombre : null,
            'cargo' => $req->cargo ? $req->cargo->nombre : null,
            'fecha_ingreso' => $req->fecha_ingreso,
            'empresa' => $req->empresa ? $req->empresa->nombre : null,
            'nombres' => $req->nombres,
            'apellidos' => $req->apellidos,
            'correo' => $req->correo,
        ];
        try {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
            ]);
            $response = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err = curl_error($ch);
            curl_close($ch);

            WebhookLog::registrar(
                'activacion_mybodytech',
                $url,
                $payload,
                $code,
                $response,
                $err ?: null,
                $req->id,
                $req->profile_id
            );
        } catch (\Throwable $e) {
            WebhookLog::registrar(
                'activacion_mybodytech',
                $url,
                $payload,
                null,
                null,
                $e->getMessage(),
                $req->id,
                $req->profile_id
            );
        }
    }
}
