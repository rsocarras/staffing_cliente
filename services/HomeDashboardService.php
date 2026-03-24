<?php

namespace app\services;

use app\models\Candidato;
use app\models\Contrato;
use app\models\Mallas;
use app\models\Novedad;
use app\models\Presupuesto;
use app\models\Profile;
use app\models\Requisicion;
use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * Agrega métricas y series para el dashboard principal (home), filtradas por empresa.
 */
final class HomeDashboardService
{
    /** @var array<string, bool> */
    private static $tableExistsCache = [];

    private static function hasTable(string $tableName): bool
    {
        if ($tableName === '') {
            return false;
        }
        if (!array_key_exists($tableName, self::$tableExistsCache)) {
            self::$tableExistsCache[$tableName] = Yii::$app->db->getTableSchema($tableName, true) !== null;
        }

        return self::$tableExistsCache[$tableName];
    }

    /**
     * @return array{
     *   empresaResolved: bool,
     *   kpis: list<array{key: string, label: string, value: int, icon: string, route: array}>,
     *   charts: array<string, mixed>
     * }
     */
    public static function getSnapshot(?int $empresaId): array
    {
        if ($empresaId === null || $empresaId <= 0) {
            return [
                'empresaResolved' => false,
                'kpis' => [],
                'charts' => [],
            ];
        }

        return [
            'empresaResolved' => true,
            'kpis' => self::buildKpis($empresaId),
            'charts' => self::buildCharts($empresaId),
        ];
    }

    private static function buildKpis(int $empresaId): array
    {
        $kpis = [];

        if (self::hasTable(Profile::tableName())) {
            $kpis[] = [
                'key' => 'colaboradores',
                'label' => 'Colaboradores activos',
                'value' => (int) Profile::find()
                    ->where(['empresas_id' => $empresaId, 'estado' => Profile::ESTADO_ACTIVO])
                    ->count(),
                'icon' => 'ti-users',
                'route' => ['/empleados/index'],
            ];
        }

        if (self::hasTable(Contrato::tableName())) {
            $kpis[] = [
                'key' => 'contratos',
                'label' => 'Contratos activos',
                'value' => (int) Contrato::find()
                    ->where(['empresa_id' => $empresaId, 'estado' => Contrato::ESTADO_ACTIVO])
                    ->count(),
                'icon' => 'ti-id-badge-2',
                'route' => ['/contrato/index'],
            ];
        }

        if (self::hasTable(Novedad::tableName())) {
            $kpis[] = [
                'key' => 'novedades',
                'label' => 'Novedades pendientes',
                'value' => (int) Novedad::find()
                    ->where(['empresa_id' => $empresaId, 'estado' => Novedad::ESTADO_PENDIENTE])
                    ->count(),
                'icon' => 'ti-list-details',
                'route' => ['/novedad/index'],
            ];
        }

        if (self::hasTable(Requisicion::tableName())) {
            $kpis[] = [
                'key' => 'requisiciones',
                'label' => 'Requisiciones en curso',
                'value' => (int) Requisicion::find()
                    ->where(['empresas_id' => $empresaId])
                    ->andWhere(['not in', 'estado', [
                        Requisicion::ESTADO_ACTIVE,
                        Requisicion::ESTADO_CANCELLED,
                        Requisicion::ESTADO_REJECTED,
                    ]])
                    ->count(),
                'icon' => 'ti-file-certificate',
                'route' => ['/requisicion/index'],
            ];
        }

        if (self::hasTable(Presupuesto::tableName())) {
            $kpis[] = [
                'key' => 'presupuestos',
                'label' => 'Presupuestos por aprobar',
                'value' => (int) Presupuesto::find()
                    ->where(['empresa_id' => $empresaId, 'estado' => Presupuesto::ESTADO_PENDIENTE_APROBACION])
                    ->count(),
                'icon' => 'ti-calculator',
                'route' => ['/presupuesto/pending'],
            ];
        }

        if (self::hasTable(Mallas::tableName())) {
            $kpis[] = [
                'key' => 'mallas',
                'label' => 'Mallas pendientes de aprobación',
                'value' => (int) Mallas::find()
                    ->where(['empresa_id' => $empresaId, 'estado_aprobacion' => Mallas::ESTADO_PENDIENTE])
                    ->count(),
                'icon' => 'ti-calendar-time',
                'route' => ['/mallas/index'],
            ];
        }

        if (self::hasTable(Candidato::tableName())) {
            $kpis[] = [
                'key' => 'candidatos',
                'label' => 'Candidatos activos (global)',
                'value' => (int) Candidato::find()
                    ->where(['estado' => Candidato::ESTADO_ACTIVO])
                    ->count(),
                'icon' => 'ti-user-shield',
                'route' => ['/candidatos/index'],
            ];
        }

        return $kpis;
    }

    /**
     * @return array<string, mixed>
     */
    private static function buildCharts(int $empresaId): array
    {
        return [
            'novedadesPorEstado' => self::groupCountLabels(
                Novedad::tableName(),
                'estado',
                'empresa_id',
                $empresaId,
                self::novedadEstadoLabels()
            ),
            'requisicionesPorEstado' => self::groupCountLabels(
                Requisicion::tableName(),
                'estado',
                'empresas_id',
                $empresaId,
                Requisicion::optsEstado()
            ),
            'contratosPorEstado' => self::groupCountLabels(
                Contrato::tableName(),
                'estado',
                'empresa_id',
                $empresaId,
                Contrato::optsEstado()
            ),
            'presupuestosPorEstado' => self::groupCountLabels(
                Presupuesto::tableName(),
                'estado',
                'empresa_id',
                $empresaId,
                Presupuesto::optsEstado()
            ),
            'mallasPorEstado' => self::groupCountLabels(
                Mallas::tableName(),
                'estado_aprobacion',
                'empresa_id',
                $empresaId,
                Mallas::optsEstadoAprobacion()
            ),
            'novedadesUltimosMeses' => self::novedadesPorMes($empresaId, 6),
        ];
    }

    /**
     * @param array<string, string> $labelMap
     * @return list<array{label: string, value: int}>
     */
    private static function groupCountLabels(
        string $table,
        string $estadoColumn,
        string $tenantColumn,
        int $empresaId,
        array $labelMap
    ): array {
        if (!self::hasTable($table)) {
            return [];
        }

        $rows = (new Query())
            ->select([$estadoColumn, 'COUNT(*) AS c'])
            ->from($table)
            ->where([$tenantColumn => $empresaId])
            ->groupBy([$estadoColumn])
            ->orderBy(['c' => SORT_DESC])
            ->all();

        $out = [];
        foreach ($rows as $row) {
            $code = (string) ($row[$estadoColumn] ?? '');
            $count = (int) ($row['c'] ?? 0);
            $label = $labelMap[$code] ?? $code;
            $out[] = ['label' => $label, 'value' => $count];
        }

        return $out;
    }

    /**
     * @return array<string, string>
     */
    private static function novedadEstadoLabels(): array
    {
        $raw = Novedad::optsEstado();
        $map = [];
        foreach ($raw as $code => $text) {
            $map[$code] = mb_convert_case((string) $text, MB_CASE_TITLE, 'UTF-8');
        }

        return $map;
    }

    /**
     * @return array{labels: list<string>, series: list<int>}
     */
    private static function novedadesPorMes(int $empresaId, int $months): array
    {
        if ($months < 1) {
            return ['labels' => [], 'series' => []];
        }

        $table = Novedad::tableName();
        if (!self::hasTable($table)) {
            return ['labels' => [], 'series' => []];
        }

        $firstInRange = (new \DateTimeImmutable('first day of this month'))->modify('-' . ($months - 1) . ' months');

        if (Novedad::timestampsAreDatetimeColumns()) {
            $monthExpr = new Expression("DATE_FORMAT([[created_at]], '%Y-%m')");
            $since = $firstInRange->format('Y-m-d 00:00:00');
            $where = ['and', ['empresa_id' => $empresaId], ['>=', 'created_at', $since]];
        } else {
            $monthExpr = new Expression("DATE_FORMAT(FROM_UNIXTIME([[created_at]]), '%Y-%m')");
            $since = $firstInRange->getTimestamp();
            $where = ['and', ['empresa_id' => $empresaId], ['>=', 'created_at', $since]];
        }

        $rows = (new Query())
            ->select(['ym' => $monthExpr, 'c' => 'COUNT(*)'])
            ->from($table)
            ->where($where)
            ->groupBy([$monthExpr])
            ->orderBy(['ym' => SORT_ASC])
            ->all();

        $byYm = [];
        foreach ($rows as $row) {
            $ym = (string) ($row['ym'] ?? '');
            $byYm[$ym] = (int) ($row['c'] ?? 0);
        }

        $mesCorto = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
        $labels = [];
        $values = [];
        $cursor = new \DateTimeImmutable('first day of this month');
        for ($i = $months - 1; $i >= 0; $i--) {
            $d = $cursor->modify('-' . $i . ' months');
            $ym = $d->format('Y-m');
            $mIdx = (int) $d->format('n') - 1;
            $labels[] = $mesCorto[$mIdx] . ' ' . $d->format('Y');
            $values[] = $byYm[$ym] ?? 0;
        }

        return [
            'labels' => $labels,
            'series' => $values,
        ];
    }
}
