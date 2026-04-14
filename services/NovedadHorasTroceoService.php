<?php

declare(strict_types=1);

namespace app\services;

use app\models\Novedad;
use app\models\SettingLaboral;
use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;

/**
 * Trocea un intervalo fecha/hora en fragmentos clasificados por recargo (Colombia + setting nocturno).
 *
 * @phpstan-type Fragmento array{
 *   codigo: string,
 *   horas: float,
 *   fecha_novedad: string,
 *   hora_inicio: string,
 *   hora_fin: string
 * }
 */
final class NovedadHorasTroceoService
{
    /** Franja ordinaria (día laboral); el controlador puede mapear a Horas Extras según cargo. */
    public const COD_CLASES_GRUPALES = 'CLASES_GRUPALES';

    public const COD_HORAS_EXTRAS = 'HORAS_EXTRAS';

    public const COD_AUXILIO_MOVILIZACION = 'AUXILIO_MOVILIZACION';

    /** @deprecated Usar {@see COD_CLASES_GRUPALES} */
    public const COD_CLASES = self::COD_CLASES_GRUPALES;

    public const COD_REC_DOM_FEST = 'RECARGO_DOMINICAL_FESTIVO';

    public const COD_REC_NOCT = 'RECARGO_NOCTURNO';

    public const COD_REC_NOCT_FEST = 'RECARGO_NOCTURNO_FESTIVO';

    public const COD_REC_NOCT_DOM_FEST = 'RECARGO_NOCTURNO_DOMINICAL_FESTIVO';

    /** Liquidación manual por tarifa en sede ({@see mapCodigoConceptoACampoTarifaLocationSedes}). */
    public const COD_HORA_DIURNA = 'HORA_DIURNA';

    public const COD_HORA_ESPECIAL = 'HORA_ESPECIAL';

    public const COD_DOMINICAL_COMPENSATORIO = 'DOMINICAL_COMPENSATORIO';

    /** Liquidación manual; misma tarifa sede que {@see COD_REC_NOCT}. */
    public const COD_HORA_NOCTURNA = 'HORA_NOCTURNA';

    /** Misma tarifa sede que {@see COD_REC_DOM_FEST}. */
    public const COD_HORA_FESTIVA_DIURNA = 'HORA_FESTIVA_DIURNA';

    /** Misma tarifa sede que {@see COD_REC_NOCT_FEST}. */
    public const COD_HORA_FESTIVA_NOCTURNA = 'HORA_FESTIVA_NOCTURNA';

    /**
     * Mapeo código de concepto de novedad (mayúsculas) → atributo de tarifa en {@see \app\models\LocationSedes}.
     *
     * @return array<string, string>
     */
    public static function mapCodigoConceptoACampoTarifaLocationSedes(): array
    {
        return [
            self::COD_HORA_DIURNA => 'valor_hora_diurna',
            self::COD_HORA_ESPECIAL => 'valor_hora_especial',
            self::COD_AUXILIO_MOVILIZACION => 'valor_movilizacion',
            self::COD_HORA_NOCTURNA => 'valor_hora_nocturna',
            self::COD_HORA_FESTIVA_DIURNA => 'valor_hora_diurna_domingo_festivos',
            self::COD_HORA_FESTIVA_NOCTURNA => 'valor_hora_nocturna_dominical_festiva',
        ];
    }

    /**
     * @return list<string>
     */
    public static function codigosConceptoMapeadosTarifaLocationSedes(): array
    {
        $k = array_keys(self::mapCodigoConceptoACampoTarifaLocationSedes());
        sort($k, SORT_STRING);

        return $k;
    }

    /**
     * @return list<Fragmento>
     */
    public static function trocear(string $fechaYmd, string $horaIni, string $horaFin, SettingLaboral $setting): array
    {
        $tz = new DateTimeZone(date_default_timezone_get());
        $hi = Novedad::normalizarTimeString($horaIni);
        $hf = Novedad::normalizarTimeString($horaFin);
        if ($hi === null || $hf === null) {
            throw new InvalidArgumentException('Horas inválidas');
        }

        $t0 = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $fechaYmd . ' ' . $hi, $tz);
        $t1 = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $fechaYmd . ' ' . $hf, $tz);
        if ($t0 === false || $t1 === false) {
            throw new InvalidArgumentException('Fecha u hora inválida');
        }
        if ($t1 <= $t0) {
            $t1 = $t1->modify('+1 day');
        }

        $nightStart = self::normalizeTimeSetting($setting->hora_inicio_nocturna);
        $nightEnd = self::normalizeTimeSetting($setting->fin_hora_nocturna);
        if ($nightStart === null || $nightEnd === null) {
            throw new InvalidArgumentException('Configure hora inicio y fin nocturna en parámetros (setting).');
        }

        $points = self::collectBreakpoints($t0, $t1, $tz, $nightStart, $nightEnd);
        sort($points, SORT_NUMERIC);
        $points = array_values(array_unique($points));

        $out = [];
        for ($i = 0; $i < count($points) - 1; $i++) {
            $a = (new DateTimeImmutable('@' . $points[$i]))->setTimezone($tz);
            $b = (new DateTimeImmutable('@' . $points[$i + 1]))->setTimezone($tz);
            if ($b <= $a) {
                continue;
            }
            $secs = $b->getTimestamp() - $a->getTimestamp();
            if ($secs < 60) {
                continue;
            }
            $horas = round($secs / 3600, 2);
            if ($horas <= 0) {
                continue;
            }
            $midTs = (int) (($a->getTimestamp() + $b->getTimestamp()) / 2);
            $mid = (new DateTimeImmutable('@' . $midTs))->setTimezone($tz);
            $codigo = self::clasificar($mid, $nightStart, $nightEnd);
            $out[] = [
                'codigo' => $codigo,
                'horas' => $horas,
                'fecha_novedad' => $a->format('Y-m-d'),
                'hora_inicio' => $a->format('H:i:s'),
                'hora_fin' => $b->format('H:i:s'),
            ];
        }

        return self::fusionarMismoCodigo($out);
    }

    /**
     * @param list<Fragmento> $fragments
     * @return list<Fragmento>
     */
    private static function fusionarMismoCodigo(array $fragments): array
    {
        if ($fragments === []) {
            return [];
        }
        $merged = [];
        foreach ($fragments as $f) {
            $last = $merged[array_key_last($merged)] ?? null;
            if ($last !== null
                && $last['codigo'] === $f['codigo']
                && $last['fecha_novedad'] === $f['fecha_novedad']
                && $last['hora_fin'] === $f['hora_inicio']) {
                $last['hora_fin'] = $f['hora_fin'];
                $last['horas'] = round($last['horas'] + $f['horas'], 2);
                $merged[array_key_last($merged)] = $last;
            } else {
                $merged[] = $f;
            }
        }

        return $merged;
    }

    /**
     * Cortes en los bordes de la franja nocturna (setting) y medianoche, para que cada trozo
     * tenga un solo código de recargo. Antes estaban fijas 05:00/21:00 y ignoraban fin_hora_nocturna.
     *
     * @return list<int> timestamps
     */
    private static function collectBreakpoints(
        DateTimeImmutable $t0,
        DateTimeImmutable $t1,
        DateTimeZone $tz,
        string $nightStartHms,
        string $nightEndHms
    ): array {
        $points = [$t0->getTimestamp(), $t1->getTimestamp()];
        $d = $t0->setTime(0, 0, 0);
        $limit = $t1->modify('+1 day')->setTime(0, 0, 0);

        while ($d < $limit) {
            foreach ([$nightStartHms, $nightEndHms] as $hms) {
                $c = self::combineDateTime($d, $hms, $tz);
                if ($c > $t0 && $c < $t1) {
                    $points[] = $c->getTimestamp();
                }
            }
            $midnight = $d->modify('+1 day');
            if ($midnight > $t0 && $midnight < $t1) {
                $points[] = $midnight->getTimestamp();
            }
            $d = $d->modify('+1 day');
        }

        return $points;
    }

    private static function combineDateTime(DateTimeImmutable $dateMidnight, string $hms, DateTimeZone $tz): DateTimeImmutable
    {
        $ymd = $dateMidnight->format('Y-m-d');
        $dt = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $ymd . ' ' . $hms, $tz);

        return $dt !== false ? $dt : $dateMidnight;
    }

    private static function clasificar(DateTimeImmutable $mid, string $nightStart, string $nightEnd): string
    {
        $night = self::isNight($mid, $nightStart, $nightEnd);
        $domOFest = ColombiaFestivos::esDomingoOFestivo($mid);
        $festNoDom = ColombiaFestivos::esFestivoNoDomingo($mid);

        if ($night && $domOFest) {
            return self::COD_REC_NOCT_DOM_FEST;
        }
        if ($night && $festNoDom) {
            return self::COD_REC_NOCT_FEST;
        }
        if ($night) {
            return self::COD_REC_NOCT;
        }
        if ($domOFest) {
            return self::COD_REC_DOM_FEST;
        }

        return self::COD_CLASES_GRUPALES;
    }

    private static function isNight(DateTimeImmutable $t, string $startHms, string $endHms): bool
    {
        $d0 = $t->setTime(0, 0, 0);
        [$sh, $sm, $ss] = self::hmsParts($startHms);
        [$eh, $em, $es] = self::hmsParts($endHms);

        $wA0 = $d0->modify('-1 day')->setTime($sh, $sm, $ss);
        $wA1 = $d0->setTime($eh, $em, $es);
        if ($t >= $wA0 && $t < $wA1) {
            return true;
        }

        $wB0 = $d0->setTime($sh, $sm, $ss);
        $wB1 = $d0->modify('+1 day')->setTime($eh, $em, $es);

        return $t >= $wB0 && $t < $wB1;
    }

    /**
     * @return array{0:int,1:int,2:int}
     */
    private static function hmsParts(string $hms): array
    {
        $parts = explode(':', $hms);
        $h = (int) ($parts[0] ?? 0);
        $m = (int) ($parts[1] ?? 0);
        $s = (int) ($parts[2] ?? 0);

        return [$h, $m, $s];
    }

    private static function normalizeTimeSetting(?string $t): ?string
    {
        if ($t === null || trim((string) $t) === '') {
            return null;
        }
        $n = Novedad::normalizarTimeString((string) $t);

        return $n;
    }
}
