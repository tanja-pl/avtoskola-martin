<?php

use App\Support\MbStringFallback;

if (! function_exists('mb_strimwidth')) {
    function mb_strimwidth($string, $start, $width, $trim_marker = '', $encoding = null): string
    {
        return MbStringFallback::strimwidth($string, $start, $width, $trim_marker, $encoding);
    }
}
