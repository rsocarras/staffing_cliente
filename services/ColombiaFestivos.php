<?php

declare(strict_types=1);

namespace app\services;

use DateTimeInterface;

/**
 * Consulta si una fecha calendario es festivo en Colombia (lista en config).
 */
final class ColombiaFestivos
{
    /** @var array<string, true> */
    private static ?array $set = null;

    public static function isFestivo(DateTimeInterface|string $fecha): bool
    {
        if (is_string($fecha)) {
            $ymd = substr($fecha, 0, 10);
        } else {
            $ymd = $fecha->format('Y-m-d');
        }

        return isset(self::loadSet()[$ymd]);
    }

    /**
     * @return array<string, true>
     */
    private static function loadSet(): array
    {
        if (self::$set !== null) {
            return self::$set;
        }
        $path = \Yii::getAlias('@app/config/colombia_festivos.php');
        /** @var list<string> $list */
        $list = is_file($path) ? require $path : [];
        self::$set = [];
        foreach ($list as $d) {
            $d = (string) $d;
            self::$set[$d] = true;
        }

        return self::$set;
    }

    public static function esDomingo(DateTimeInterface $dt): bool
    {
        return (int) $dt->format('w') === 0;
    }

    public static function esDomingoOFestivo(DateTimeInterface $dt): bool
    {
        return self::esDomingo($dt) || self::isFestivo($dt);
    }

    /** Festivo laborable (no domingo): para distinguir nocturno festivo vs nocturno dominical festivo */
    public static function esFestivoNoDomingo(DateTimeInterface $dt): bool
    {
        return self::isFestivo($dt) && !self::esDomingo($dt);
    }
}
