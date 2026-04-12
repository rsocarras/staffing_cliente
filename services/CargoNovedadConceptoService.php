<?php

declare(strict_types=1);

namespace app\services;

use app\models\Cargos;
use app\models\EmpresaNovedadConcepto;
use app\models\NovedadConcepto;
use app\models\NovedadConceptoCargo;
use Yii;

/**
 * Conceptos de novedad habilitados para la organización del cargo, agrupados por tipo (agrupador).
 */
final class CargoNovedadConceptoService
{
    /**
     * IDs de conceptos explícitamente habilitados para la organización (tabla {@see EmpresaNovedadConcepto}).
     *
     * @return list<int>
     */
    public static function idsConceptosAsignadosOrganizacion(int $empresaId): array
    {
        if ($empresaId <= 0) {
            return [];
        }

        $ids = EmpresaNovedadConcepto::find()
            ->select('novedad_concepto_id')
            ->where(['empresa_id' => $empresaId])
            ->column();

        return array_values(array_unique(array_map('intval', $ids)));
    }

    /**
     * Solo conceptos con fila en `empresa_novedad_concepto` para esa organización, agrupados por tipo (agrupador).
     *
     * @return list<array{tipo: \app\models\NovedadTipo, conceptos: list<NovedadConcepto>}>
     */
    public static function conceptosAgrupadosPorTipoParaEmpresa(int $empresaId): array
    {
        if ($empresaId <= 0) {
            return [];
        }

        $rows = NovedadConcepto::find()
            ->alias('nc')
            ->innerJoin(
                ['enc' => EmpresaNovedadConcepto::tableName()],
                'enc.novedad_concepto_id = nc.id AND enc.empresa_id = :eid',
                [':eid' => $empresaId]
            )
            ->where(['nc.activo' => 1])
            ->andWhere(['not', ['nc.novedad_tipo_id' => null]])
            ->orderBy(['nc.novedad_tipo_id' => SORT_ASC, 'nc.nombre' => SORT_ASC])
            ->with(['novedadTipo'])
            ->all();

        $byTipo = [];
        foreach ($rows as $c) {
            $tid = (int) ($c->novedad_tipo_id ?? 0);
            if ($tid <= 0 || $c->novedadTipo === null || (int) ($c->novedadTipo->activo ?? 0) !== 1) {
                continue;
            }
            if (!isset($byTipo[$tid])) {
                $byTipo[$tid] = [
                    'tipo' => $c->novedadTipo,
                    'conceptos' => [],
                ];
            }
            $byTipo[$tid]['conceptos'][] = $c;
        }

        uasort($byTipo, static function (array $a, array $b): int {
            $oa = (int) ($a['tipo']->orden ?? 0);
            $ob = (int) ($b['tipo']->orden ?? 0);
            if ($oa !== $ob) {
                return $oa <=> $ob;
            }

            return strcasecmp((string) ($a['tipo']->nombre ?? ''), (string) ($b['tipo']->nombre ?? ''));
        });

        return array_values($byTipo);
    }

    /**
     * @param int[] $conceptoIds
     */
    public static function sync(Cargos $cargo, array $conceptoIds): void
    {
        $cargoId = (int) $cargo->id;
        if ($cargoId <= 0) {
            return;
        }

        $empresaId = (int) $cargo->empresa_id;
        if ($empresaId <= 0) {
            NovedadConceptoCargo::deleteAll(['cargo_id' => $cargoId]);

            return;
        }

        $allowedSet = array_fill_keys(self::idsConceptosAsignadosOrganizacion($empresaId), true);

        $ids = [];
        foreach ($conceptoIds as $raw) {
            $cid = (int) $raw;
            if ($cid > 0 && isset($allowedSet[$cid])) {
                $ids[$cid] = true;
            }
        }
        $ids = array_keys($ids);

        NovedadConceptoCargo::deleteAll(['cargo_id' => $cargoId]);

        if ($ids !== []) {
            $batch = [];
            foreach ($ids as $cid) {
                $batch[] = [$cid, $cargoId];
            }
            Yii::$app->db->createCommand()->batchInsert(
                NovedadConceptoCargo::tableName(),
                ['novedad_concepto_id', 'cargo_id'],
                $batch
            )->execute();
        }
    }
}
