<?php

declare(strict_types=1);

namespace app\models\forms;

use app\models\City;
use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\NovedadTipo;
use Yii;
use yii\base\Model;

/**
 * Contexto de solicitud web (tenant, cliente, ubicación, agrupador).
 * No persiste en tabla propia; se valida junto a {@see \app\models\Novedad}.
 */
class NovedadSolicitudContextForm extends Model
{
    public ?int $empresa_cliente_id = null;
    public ?int $ciudad_id = null;
    public ?int $sede_id = null;
    public ?int $novedad_tipo_id = null;

    /** Tenant del operador (no viene del POST). */
    private ?int $empresasId = null;

    public function formName(): string
    {
        return 'SolicitudCtx';
    }

    public function setEmpresasId(?int $id): void
    {
        $this->empresasId = $id;
    }

    public function getEmpresasId(): ?int
    {
        return $this->empresasId;
    }

    public function rules(): array
    {
        return [
            [['empresa_cliente_id', 'ciudad_id', 'sede_id', 'novedad_tipo_id'], 'integer'],
            [['empresa_cliente_id', 'novedad_tipo_id'], 'required'],
            [['novedad_tipo_id'], 'validateTipoTenant'],
            [['empresa_cliente_id'], 'validateEmpresaClienteTenant'],
            [['ciudad_id'], 'validateCiudad'],
            [['sede_id'], 'validateSedeTenant'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
            'ciudad_id' => Yii::t('app', 'Ciudad'),
            'sede_id' => Yii::t('app', 'Sede'),
            'novedad_tipo_id' => Yii::t('app', 'Tipo / agrupador'),
        ];
    }

    public function validateTipoTenant(string $attribute, ?array $params = null): void
    {
        $tid = $this->empresasId;
        if ($tid === null || $tid <= 0) {
            $this->addError($attribute, Yii::t('app', 'No tiene organización asignada en su perfil.'));

            return;
        }
        $cond = [
            'id' => $this->novedad_tipo_id,
            'activo' => 1,
        ];
        if (NovedadTipo::hasEmpresaIdColumn()) {
            $cond['empresa_id'] = $tid;
        }
        $tipo = NovedadTipo::findOne($cond);
        if ($tipo === null) {
            $this->addError($attribute, Yii::t('app', 'El agrupador no es válido para su organización.'));
        }
    }

    public function validateEmpresaClienteTenant(string $attribute, ?array $params = null): void
    {
        $tid = $this->empresasId;
        if ($tid === null || $tid <= 0) {
            $this->addError($attribute, Yii::t('app', 'No hay empresa cliente válida para su usuario.'));

            return;
        }
        $ids = array_map(
            static fn (EmpresaCliente $e) => (int) $e->id,
            EmpresaCliente::getActivos($tid)
        );
        if ($ids === []) {
            $this->addError($attribute, Yii::t('app', 'No hay empresa cliente válida para su usuario.'));

            return;
        }
        if (!in_array((int) $this->empresa_cliente_id, $ids, true)) {
            $this->addError($attribute, Yii::t('app', 'La empresa cliente seleccionada no está permitida.'));
        }
    }

    public function validateCiudad(string $attribute, ?array $params = null): void
    {
        if ($this->ciudad_id === null || $this->ciudad_id === '') {
            return;
        }
        $exists = City::find()->where(['id' => $this->ciudad_id, 'is_active' => 1])->exists();
        if (!$exists) {
            $this->addError($attribute, Yii::t('app', 'Ciudad no válida.'));
        }
    }

    public function validateSedeTenant(string $attribute, ?array $params = null): void
    {
        if ($this->sede_id === null || $this->sede_id === '') {
            return;
        }
        $tid = $this->empresasId;
        if ($tid === null || $tid <= 0) {
            $this->addError($attribute, Yii::t('app', 'Sede no válida.'));

            return;
        }
        $sede = LocationSedes::findOne(['id' => $this->sede_id, 'empresa_id' => $tid, 'activo' => 1]);
        if ($sede === null) {
            $this->addError($attribute, Yii::t('app', 'La sede no pertenece a su organización.'));

            return;
        }
        if ($this->ciudad_id !== null && $sede->city_id !== null && (int) $sede->city_id !== (int) $this->ciudad_id) {
            $this->addError($attribute, Yii::t('app', 'La sede no corresponde a la ciudad seleccionada.'));
        }
    }
}
