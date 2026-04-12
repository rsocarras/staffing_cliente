<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Empresa cliente/solicitante (con NIT) para requisiciones
 *
 * @property int $id
 * @property string $nit
 * @property string $nombre
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $empresas_id Tenant al que pertenece el cliente
 *
 * @property Requisicion[] $requisiciones
 */
class EmpresaCliente extends ActiveRecord
{
    public static function tableName()
    {
        return 'empresa_cliente';
    }

    public function rules()
    {
        return [
            [['nit', 'nombre'], 'required'],
            [['empresas_id'], 'default', 'value' => null],
            [['nit'], 'unique'],
            [['nit'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 190],
            [['is_active', 'empresas_id'], 'integer'],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nit' => 'NIT',
            'nombre' => 'Nombre',
            'is_active' => 'Activo',
        ];
    }

    public function getRequisiciones()
    {
        return $this->hasMany(Requisicion::class, ['empresa_cliente_id' => 'id']);
    }

    public static function getActivos(?int $empresasId = null)
    {
        $query = static::find()->where(['is_active' => 1]);
        if ($empresasId !== null && $empresasId > 0) {
            $query->andWhere(['empresas_id' => $empresasId]);
        }
        return $query->orderBy('nombre')->all();
    }

    /**
     * Empresas cliente activas del tenant asociadas al empleado por contrato vigente a la fecha
     * ({@see Contrato::empresa_cliente_id}). Si el contrato no tiene cliente, se usa respaldo por
     * {@see Requisicion} con el mismo perfil y organización.
     *
     * @return static[]
     */
    public static function activosPorPerfilYContratoVigente(int $empresasId, int $profileUserId, string $fechaYmd): array
    {
        if ($empresasId <= 0 || $profileUserId <= 0) {
            return [];
        }
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaYmd)) {
            $fechaYmd = date('Y-m-d');
        }

        $ids = [];
        $conContratoCliente = Contrato::findOccupyingAt($fechaYmd)
            ->andWhere([
                'contrato.profile_id' => $profileUserId,
                'contrato.empresa_id' => $empresasId,
            ])
            ->andWhere(['not', ['contrato.empresa_cliente_id' => null]]);

        foreach ($conContratoCliente->each(100) as $c) {
            /** @var Contrato $c */
            $ids[(int) $c->empresa_cliente_id] = true;
        }

        $tieneContrato = Contrato::findOccupyingAt($fechaYmd)
            ->andWhere([
                'contrato.profile_id' => $profileUserId,
                'contrato.empresa_id' => $empresasId,
            ])
            ->exists();

        if ($ids === [] && $tieneContrato) {
            $reqIds = (new Query())
                ->select('empresa_cliente_id')
                ->distinct()
                ->from('requisicion')
                ->where([
                    'profile_id' => $profileUserId,
                    'empresas_id' => $empresasId,
                ])
                ->andWhere(['not', ['empresa_cliente_id' => null]])
                ->column();
            foreach ($reqIds as $rid) {
                $i = (int) $rid;
                if ($i > 0) {
                    $ids[$i] = true;
                }
            }
        }

        $idList = array_keys($ids);
        if ($idList === []) {
            return [];
        }

        return static::find()
            ->where(['id' => $idList, 'is_active' => 1, 'empresas_id' => $empresasId])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();
    }
}
