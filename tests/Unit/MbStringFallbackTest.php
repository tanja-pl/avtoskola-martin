<?php

namespace Tests\Unit;

use App\Support\MbStringFallback;
use PHPUnit\Framework\TestCase;

class MbStringFallbackTest extends TestCase
{
    public function test_short_text_is_unchanged(): void
    {
        $this->assertSame('Здраво', MbStringFallback::strimwidth('Здраво', 0, 90, '', 'UTF-8'));
    }

    public function test_long_text_is_cut_to_the_requested_width(): void
    {
        $text = str_repeat('аб', 80);

        $cut = MbStringFallback::strimwidth($text, 0, 10, '', 'UTF-8');

        $this->assertLessThanOrEqual(10, mb_strwidth($cut, 'UTF-8'));
        $this->assertNotSame('', $cut);
    }

    public function test_trim_marker_is_included_in_the_width(): void
    {
        $text = str_repeat('а', 40);

        $cut = MbStringFallback::strimwidth($text, 0, 10, '...', 'UTF-8');

        $this->assertLessThanOrEqual(10, mb_strwidth($cut, 'UTF-8'));
        $this->assertStringEndsWith('...', $cut);
    }
}
