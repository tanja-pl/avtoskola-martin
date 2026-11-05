<?php

namespace App\Support;

class MbStringFallback
{
    public static function strimwidth(mixed $string, mixed $start, mixed $width, mixed $trimMarker = '', mixed $encoding = null): string
    {
        $string = (string) $string;
        $start = (int) $start;
        $width = (int) $width;
        $trimMarker = (string) $trimMarker;
        $encoding = is_string($encoding) && $encoding !== '' ? $encoding : 'UTF-8';

        if ($start !== 0) {
            $string = mb_substr($string, $start, null, $encoding);
        }

        if (mb_strwidth($string, $encoding) <= $width) {
            return $string;
        }

        $markerWidth = mb_strwidth($trimMarker, $encoding);
        $keep = $width - $markerWidth;
        if ($keep < 1) {
            return self::fit($trimMarker, $width, $encoding);
        }

        return self::fit($string, $keep, $encoding).$trimMarker;
    }

    private static function fit(string $string, int $width, string $encoding): string
    {
        $low = 0;
        $high = mb_strlen($string, $encoding);
        while ($low < $high) {
            $mid = intdiv($low + $high + 1, 2);
            if (mb_strwidth(mb_substr($string, 0, $mid, $encoding), $encoding) <= $width) {
                $low = $mid;
            } else {
                $high = $mid - 1;
            }
        }

        return mb_substr($string, 0, $low, $encoding);
    }
}
