<?php

namespace app\services;

use app\models\Contrato;
use app\models\MallaCargoAsignacion;
use app\models\MallaProfileAsignacion;
use app\models\Mallas;
use app\models\MallasHorarios;
use app\models\Profile;
use DateInterval;
use DateTimeImmutable;

class MallaTimesheetService
{
    public static function buildDay(int $empresaId, int $sedeId, string $date): array
    {
        $contracts = self::findContractsBySede($empresaId, $sedeId, $date);
        $scheduleIndex = self::buildScheduleIndex($contracts);
        $dayOfWeek = (int) (new DateTimeImmutable($date))->format('w') + 1; // Sunday=1

        $rows = [];
        foreach ($contracts as $contract) {
            $profile = $contract->profile;
            if ($profile === null) {
                continue;
            }

            $schedule = $scheduleIndex[$contract->profile_id] ?? null;
            $segments = [];
            $totalMinutes = 0;
            if ($schedule !== null) {
                $segments = self::segmentsForDay($schedule['horarios'], $dayOfWeek);
                foreach ($segments as $segment) {
                    $totalMinutes += max(0, $segment['end'] - $segment['start'] - $segment['break']);
                }
            }

            $rows[] = [
                'profile_id' => (int) $contract->profile_id,
                'name' => $profile->name ?: ('Empleado #' . $contract->profile_id),
                'cargo' => $contract->cargo ? $contract->cargo->nombre : null,
                'malla' => $schedule['malla'] ?? null,
                'source' => $schedule['source'] ?? null,
                'has_malla' => $schedule !== null,
                'segments' => $segments,
                'total_minutes' => $totalMinutes,
            ];
        }

        return [
            'date' => $date,
            'rows' => $rows,
        ];
    }

    public static function buildWeek(int $empresaId, int $sedeId, string $anchorDate): array
    {
        $start = self::startOfWeekSunday($anchorDate);
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $start->add(new DateInterval('P' . $i . 'D'))->format('Y-m-d');
        }

        $contracts = self::findContractsBySede($empresaId, $sedeId, $anchorDate);
        $scheduleIndex = self::buildScheduleIndex($contracts);

        $rows = [];
        foreach ($contracts as $contract) {
            $profile = $contract->profile;
            if ($profile === null) {
                continue;
            }

            $schedule = $scheduleIndex[$contract->profile_id] ?? null;
            $dayItems = [];
            $weekTotal = 0;

            foreach ($dates as $date) {
                $dayOfWeek = (int) (new DateTimeImmutable($date))->format('w') + 1;
                $segments = [];
                $totalMinutes = 0;
                if ($schedule !== null) {
                    $segments = self::segmentsForDay($schedule['horarios'], $dayOfWeek);
                    foreach ($segments as $segment) {
                        $totalMinutes += max(0, $segment['end'] - $segment['start'] - $segment['break']);
                    }
                }
                $weekTotal += $totalMinutes;
                $dayItems[$date] = [
                    'segments' => $segments,
                    'total_minutes' => $totalMinutes,
                ];
            }

            $rows[] = [
                'profile_id' => (int) $contract->profile_id,
                'name' => $profile->name ?: ('Empleado #' . $contract->profile_id),
                'cargo' => $contract->cargo ? $contract->cargo->nombre : null,
                'malla' => $schedule['malla'] ?? null,
                'source' => $schedule['source'] ?? null,
                'has_malla' => $schedule !== null,
                'days' => $dayItems,
                'week_total_minutes' => $weekTotal,
            ];
        }

        return [
            'start_date' => $dates[0],
            'end_date' => $dates[6],
            'dates' => $dates,
            'rows' => $rows,
        ];
    }

    public static function employeeWeek(int $empresaId, int $profileId, string $anchorDate): array
    {
        $start = self::startOfWeekSunday($anchorDate);
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $start->add(new DateInterval('P' . $i . 'D'))->format('Y-m-d');
        }

        $profile = Profile::findOne(['user_id' => $profileId, 'empresas_id' => $empresaId]);
        if ($profile === null) {
            return ['dates' => $dates, 'days' => [], 'profile' => null, 'malla' => null];
        }

        $contract = Contrato::findOccupyingAt($anchorDate)
            ->andWhere(['empresa_id' => $empresaId, 'profile_id' => $profileId])
            ->with(['cargo'])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $schedule = self::resolveSchedule($empresaId, $profileId, $contract ? $contract->cargo_id : null);
        $days = [];
        foreach ($dates as $date) {
            $dayOfWeek = (int) (new DateTimeImmutable($date))->format('w') + 1;
            $segments = [];
            $totalMinutes = 0;
            if ($schedule !== null) {
                $segments = self::segmentsForDay($schedule['horarios'], $dayOfWeek);
                foreach ($segments as $segment) {
                    $totalMinutes += max(0, $segment['end'] - $segment['start'] - $segment['break']);
                }
            }
            $days[$date] = ['segments' => $segments, 'total_minutes' => $totalMinutes];
        }

        return [
            'dates' => $dates,
            'days' => $days,
            'profile' => $profile,
            'malla' => $schedule['malla'] ?? null,
            'source' => $schedule['source'] ?? null,
        ];
    }

    private static function findContractsBySede(int $empresaId, int $sedeId, string $date): array
    {
        return Contrato::findOccupyingAt($date)
            ->andWhere(['contrato.empresa_id' => $empresaId, 'contrato.sede_id' => $sedeId])
            ->with(['profile.user', 'cargo'])
            ->orderBy(['profile_id' => SORT_ASC, 'id' => SORT_DESC])
            ->all();
    }

    private static function buildScheduleIndex(array $contracts): array
    {
        $index = [];
        foreach ($contracts as $contract) {
            if (isset($index[$contract->profile_id])) {
                continue;
            }
            $index[$contract->profile_id] = self::resolveSchedule($contract->empresa_id, $contract->profile_id, $contract->cargo_id);
        }
        return $index;
    }

    private static function resolveSchedule(int $empresaId, int $profileId, ?int $cargoId): ?array
    {
        $profileAssignment = MallaProfileAsignacion::getCurrentApprovedForProfile($empresaId, $profileId);
        if ($profileAssignment !== null && $profileAssignment->malla !== null
            && $profileAssignment->malla->estado_aprobacion === Mallas::ESTADO_APROBADA) {
            return [
                'malla' => $profileAssignment->malla,
                'horarios' => $profileAssignment->malla->mallasHorarios,
                'source' => 'empleado',
            ];
        }

        if ($cargoId !== null) {
            $cargoAssignment = MallaCargoAsignacion::find()
                ->where([
                    'empresa_id' => $empresaId,
                    'cargo_id' => $cargoId,
                    'estado_aprobacion' => MallaCargoAsignacion::ESTADO_APROBADA,
                    'activo' => 1,
                ])
                ->with(['malla.mallasHorarios'])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            if ($cargoAssignment !== null && $cargoAssignment->malla !== null
                && $cargoAssignment->malla->estado_aprobacion === Mallas::ESTADO_APROBADA) {
                return [
                    'malla' => $cargoAssignment->malla,
                    'horarios' => $cargoAssignment->malla->mallasHorarios,
                    'source' => 'cargo',
                ];
            }
        }

        return null;
    }

    private static function segmentsForDay(array $horarios, int $dayOfWeek): array
    {
        $segments = [];
        foreach ($horarios as $horario) {
            if (!$horario instanceof MallasHorarios) {
                continue;
            }
            $start = self::timeToMinutes($horario->hora_inicio);
            $end = self::timeToMinutes($horario->hora_fin);
            $break = (int) $horario->minutos_descanso;
            $nextDay = ($horario->dia_semana % 7) + 1;

            if ($end > $start) {
                if ((int) $horario->dia_semana === $dayOfWeek) {
                    $segments[] = ['start' => $start, 'end' => $end, 'break' => $break];
                }
                continue;
            }

            if ((int) $horario->dia_semana === $dayOfWeek) {
                $segments[] = ['start' => $start, 'end' => 1440, 'break' => $break];
            } elseif ($nextDay === $dayOfWeek) {
                $segments[] = ['start' => 0, 'end' => $end, 'break' => 0];
            }
        }

        usort($segments, function ($a, $b) {
            return $a['start'] <=> $b['start'];
        });

        return $segments;
    }

    private static function timeToMinutes(string $time): int
    {
        [$h, $m] = array_pad(explode(':', $time), 2, '0');
        return ((int) $h * 60) + (int) $m;
    }

    private static function startOfWeekSunday(string $date): DateTimeImmutable
    {
        $dt = new DateTimeImmutable($date);
        $dow = (int) $dt->format('w'); // 0=sunday
        if ($dow === 0) {
            return $dt;
        }
        return $dt->sub(new DateInterval('P' . $dow . 'D'));
    }
}
