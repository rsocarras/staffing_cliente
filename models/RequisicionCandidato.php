<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Pivote requisición–candidato. En staffing_admin la asignación desde atracción
 * deja {@see Requisicion::$profile_id} en null y marca {@see RequisicionCandidato::$asignado}=1.
 *
 * @property int $id
 * @property int $requisicion_id
 * @property int $candidato_id
 * @property int $asignado
 * @property string|null $created_at
 *
 * @property-read Requisicion|null $requisicion
 * @property-read Candidato|null $candidato
 */
class RequisicionCandidato extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'requisicion_candidato';
    }

    public function rules(): array
    {
        return [];
    }

    public function getRequisicion()
    {
        return $this->hasOne(Requisicion::class, ['id' => 'requisicion_id']);
    }

    public function getCandidato()
    {
        return $this->hasOne(Candidato::class, ['id' => 'candidato_id']);
    }
}
