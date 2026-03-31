<?php

declare(strict_types=1);

namespace app\services;

use app\models\CalendarHoliday;
use app\models\Empresas;
use app\models\LocationCountry;
use app\models\Mallas;
use app\models\SettingLaboral;
use DateInterval;
use DateTimeImmutable;
use Throwable;
use Yii;

final class MallaSpecialHoursSummaryService
{
    private const DEFAULT_COUNTRY_CODE = 'CO';
    private const DEFAULT_NIGHT_START = '21:00';
    private const DEFAULT_NIGHT_END = '06:00';

    public static function buildWeekContext(Mallas $malla, ?string $requestedWeekStart = null): array
    {
        $config = self::decodeConfigJson($malla->config_json);
        $savedWeekStart = self::normalizeDate($config['week_range_ref']['inicio'] ?? null);
        $weekStart = self::resolveWeekStart($requestedWeekStart, $savedWeekStart);
        $weekEnd = (new DateTimeImmutable($weekStart))
            ->add(new DateInterval('P6D'))
            ->format('Y-m-d');

        $countryCode = self::resolveCountryCode($malla);
        $holidayRows = CalendarHoliday::find()
            ->where(['country_code' => $countryCode])
            ->andWhere(['between', 'holiday_date', $weekStart, $weekEnd])
            ->orderBy(['holiday_date' => SORT_ASC])
            ->all();

        $holidayMap = [];
        foreach ($holidayRows as $holiday) {
            $holidayMap[(string) $holiday->holiday_date] = (string) ($holiday->name_es ?: $holiday->name_en ?: 'Festivo');
        }

        [$nightStart, $nightEnd] = self::resolveNightWindow($malla, $weekStart, $countryCode);

        $days = [];
        $start = new DateTimeImmutable($weekStart);
        $monthMap = [
            1 => 'Ene',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dic',
        ];

        for ($offset = 0; $offset < 7; $offset++) {
            $date = $start->add(new DateInterval('P' . $offset . 'D'));
            $dayId = $offset + 1; // Sunday=1
            $dateYmd = $date->format('Y-m-d');
            $isSunday = (int) $date->format('w') === 0;
            $holidayName = $holidayMap[$dateYmd] ?? null;

            $days[] = [
                'id' => $dayId,
                'date' => $dateYmd,
                'dayNumber' => $date->format('d'),
                'monthShort' => $monthMap[(int) $date->format('n')] ?? $date->format('M'),
                'weekdayIndex' => (int) $date->format('w'),
                'isSunday' => $isSunday,
                'isHoliday' => $holidayName !== null,
                'isSpecial' => $isSunday || $holidayName !== null,
                'holidayName' => $holidayName,
                'specialLabel' => $isSunday && $holidayName !== null
                    ? 'Dom/Fest'
                    : ($isSunday ? 'Domingo' : ($holidayName !== null ? 'Festivo' : '')),
            ];
        }

        return [
            'weekStart' => $weekStart,
            'weekEnd' => $weekEnd,
            'weekRangeLabel' => self::buildRangeLabel($days),
            'countryCode' => $countryCode,
            'holidayMap' => $holidayMap,
            'holidayDates' => array_keys($holidayMap),
            'nightStart' => $nightStart,
            'nightEnd' => $nightEnd,
            'days' => $days,
        ];
    }

    private static function decodeConfigJson(?string $configJson): array
    {
        if ($configJson === null || trim($configJson) === '') {
            return [];
        }

        $decoded = json_decode($configJson, true);

        return is_array($decoded) ? $decoded : [];
    }

    private static function resolveWeekStart(?string $requestedWeekStart, ?string $savedWeekStart): string
    {
        $candidate = self::normalizeDate($requestedWeekStart)
            ?? $savedWeekStart
            ?? date('Y-m-d');

        $date = new DateTimeImmutable($candidate);
        $weekday = (int) $date->format('w');
        if ($weekday > 0) {
            $date = $date->sub(new DateInterval('P' . $weekday . 'D'));
        }

        return $date->format('Y-m-d');
    }

    private static function normalizeDate($value): ?string
    {
        if (!is_string($value) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return null;
        }

        try {
            return (new DateTimeImmutable($value))->format('Y-m-d');
        } catch (Throwable $e) {
            return null;
        }
    }

    private static function resolveCountryCode(Mallas $malla): string
    {
        $empresaId = (int) $malla->empresa_id;
        if ($empresaId > 0) {
            $empresa = Empresas::findOne($empresaId);
            $countryId = $empresa !== null ? (int) $empresa->getAttribute('location_country_id') : 0;
            if ($countryId > 0) {
                $countryCode = (string) LocationCountry::find()
                    ->select('iso_alpha2')
                    ->where(['id' => $countryId])
                    ->scalar();
                if ($countryCode !== '') {
                    return strtoupper($countryCode);
                }
            }
        }

        return strtoupper((string) (Yii::$app->params['defaultLocationCountryIso'] ?? self::DEFAULT_COUNTRY_CODE));
    }

    private static function resolveNightWindow(Mallas $malla, string $weekStart, string $countryCode): array
    {
        $empresaId = (int) $malla->empresa_id;
        if ($empresaId > 0) {
            try {
                $setting = NovedadSettingResolver::resolveForEmpresaYFecha($empresaId, $weekStart);

                return [
                    self::normalizeTime($setting->hora_inicio_nocturna, self::DEFAULT_NIGHT_START),
                    self::normalizeTime($setting->fin_hora_nocturna, self::DEFAULT_NIGHT_END),
                ];
            } catch (Throwable $e) {
            }
        }

        $countryId = (int) LocationCountry::find()
            ->select('id')
            ->where(['iso_alpha2' => strtoupper($countryCode)])
            ->scalar();

        if ($countryId > 0) {
            $setting = SettingLaboral::find()
                ->where([
                    'year' => (int) substr($weekStart, 0, 4),
                    'location_country_id' => $countryId,
                ])
                ->one();
            if ($setting !== null) {
                return [
                    self::normalizeTime($setting->hora_inicio_nocturna, self::DEFAULT_NIGHT_START),
                    self::normalizeTime($setting->fin_hora_nocturna, self::DEFAULT_NIGHT_END),
                ];
            }
        }

        return [self::DEFAULT_NIGHT_START, self::DEFAULT_NIGHT_END];
    }

    private static function normalizeTime(?string $value, string $fallback): string
    {
        if ($value === null || trim($value) === '') {
            return $fallback;
        }

        if (preg_match('/^(\d{2}):(\d{2})(?::\d{2})?$/', trim($value), $matches)) {
            $hours = (int) $matches[1];
            $minutes = (int) $matches[2];
            if ($hours >= 0 && $hours <= 23 && $minutes >= 0 && $minutes <= 59) {
                return sprintf('%02d:%02d', $hours, $minutes);
            }
        }

        return $fallback;
    }

    private static function buildRangeLabel(array $days): string
    {
        if ($days === []) {
            return '';
        }

        $start = $days[0];
        $end = $days[count($days) - 1];

        return sprintf(
            '%s %s - %s %s',
            $start['dayNumber'],
            $start['monthShort'],
            $end['dayNumber'],
            $end['monthShort']
        );
    }
}
