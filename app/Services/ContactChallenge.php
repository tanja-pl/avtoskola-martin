<?php

namespace App\Services;

use Illuminate\Support\Str;

class ContactChallenge
{
    public const OK = 'ok';

    public const TOO_FAST = 'too_fast';

    public const WRONG = 'wrong';

    public const EXPIRED = 'expired';

    public const INVALID = 'invalid';

    private const SESSION_KEY = 'contact_human';

    private const REFRESHED_KEY = 'contact_human_refreshed';

    private const MIN_AGE_SECONDS = 1;

    private const MAX_AGE_SECONDS = 7200;

    /**
     * 5×7 glyphs for characters that stay readable and are not easy to confuse.
     *
     * @var array<string, list<string>>
     */
    private const GLYPHS = [
        'A' => ['01110', '10001', '10001', '11111', '10001', '10001', '10001'],
        'C' => ['01110', '10001', '10000', '10000', '10000', '10001', '01110'],
        'D' => ['11110', '10001', '10001', '10001', '10001', '10001', '11110'],
        'E' => ['11111', '10000', '10000', '11110', '10000', '10000', '11111'],
        'F' => ['11111', '10000', '10000', '11110', '10000', '10000', '10000'],
        'H' => ['10001', '10001', '10001', '11111', '10001', '10001', '10001'],
        'J' => ['00001', '00001', '00001', '00001', '10001', '10001', '01110'],
        'K' => ['10001', '10010', '10100', '11000', '10100', '10010', '10001'],
        'M' => ['10001', '11011', '10101', '10001', '10001', '10001', '10001'],
        'N' => ['10001', '11001', '10101', '10011', '10001', '10001', '10001'],
        'P' => ['11110', '10001', '10001', '11110', '10000', '10000', '10000'],
        'R' => ['11110', '10001', '10001', '11110', '10100', '10010', '10001'],
        'T' => ['11111', '00100', '00100', '00100', '00100', '00100', '00100'],
        'U' => ['10001', '10001', '10001', '10001', '10001', '10001', '01110'],
        'V' => ['10001', '10001', '10001', '10001', '01010', '01010', '00100'],
        'X' => ['10001', '10001', '01010', '00100', '01010', '10001', '10001'],
        'Y' => ['10001', '10001', '01010', '00100', '00100', '00100', '00100'],
        '3' => ['01110', '10001', '00001', '00110', '00001', '10001', '01110'],
        '4' => ['00100', '01100', '10100', '10100', '11111', '00100', '00100'],
        '5' => ['11111', '10000', '11110', '00001', '00001', '10001', '01110'],
        '6' => ['01110', '10000', '10000', '11110', '10001', '10001', '01110'],
        '7' => ['11111', '00001', '00010', '00100', '01000', '01000', '01000'],
        '9' => ['01110', '10001', '10001', '01111', '00001', '00001', '01110'],
    ];

    /**
     * @return array{token: string, image: string}
     */
    public function issue(): array
    {
        $code = $this->code();
        $record = [
            'token' => Str::random(40),
            'hash' => $this->digest($code),
            'issued_at' => now()->getTimestamp(),
            'image' => $this->svg($code),
        ];

        if (defined('PHPUNIT_COMPOSER_INSTALL') || defined('__PHPUNIT_PHAR__')) {
            $record['debug_code'] = $code;
        }

        session([self::SESSION_KEY => $record]);

        return $this->publish($record);
    }

    public function verify(string $token, string $answer): string
    {
        $record = $this->record();
        if ($record === null) {
            return self::INVALID;
        }

        $age = now()->getTimestamp() - (int) $record['issued_at'];
        if ($age > self::MAX_AGE_SECONDS) {
            return self::EXPIRED;
        }

        $storedToken = (string) $record['token'];
        if (strlen($token) !== strlen($storedToken) || ! hash_equals($storedToken, $token)) {
            return self::INVALID;
        }

        $normalized = strtoupper(preg_replace('/[^A-Z0-9]/', '', $answer) ?? '');
        $actual = $this->digest($normalized);
        $expected = (string) $record['hash'];
        if (strlen($actual) !== strlen($expected) || ! hash_equals($expected, $actual)) {
            return self::WRONG;
        }

        if ($age < self::MIN_AGE_SECONDS) {
            return self::TOO_FAST;
        }

        return self::OK;
    }

    /**
     * Replace an expired or unknown challenge and remember that the visitor needs the new image.
     *
     * @return array{token: string, image: string}
     */
    public function rotate(): array
    {
        $payload = $this->issue();
        session([self::REFRESHED_KEY => true]);

        return $payload;
    }

    /**
     * @return array{token: string, image: string}|null
     */
    public function pullRefresh(): ?array
    {
        if (! session()->pull(self::REFRESHED_KEY)) {
            return null;
        }

        $record = $this->record();

        return $record === null ? null : $this->publish($record);
    }

    public function forget(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * @param  array<string, mixed>  $record
     * @return array{token: string, image: string}
     */
    private function publish(array $record): array
    {
        return [
            'token' => (string) $record['token'],
            'image' => (string) $record['image'],
        ];
    }

    /**
     * @return array<string, mixed>|null
     */
    private function record(): ?array
    {
        $record = session(self::SESSION_KEY);
        if (! is_array($record) || ! isset($record['token'], $record['hash'], $record['issued_at'], $record['image'])) {
            return null;
        }

        return $record;
    }

    private function code(): string
    {
        $alphabet = implode('', array_keys(self::GLYPHS));
        $last = strlen($alphabet) - 1;
        $code = '';

        for ($i = 0; $i < 4; $i++) {
            $code .= $alphabet[random_int(0, $last)];
        }

        return $code;
    }

    private function digest(string $code): string
    {
        return hash_hmac('sha256', $code, (string) config('app.key'));
    }

    private function svg(string $code): string
    {
        $cell = 6;
        $gap = 12;
        $x = 16;
        $rects = '';

        foreach (str_split($code) as $char) {
            $glyph = self::GLYPHS[$char];
            $jitter = random_int(-1, 1);

            foreach ($glyph as $row => $bits) {
                foreach (str_split($bits) as $column => $bit) {
                    if ($bit !== '1') {
                        continue;
                    }

                    $rects .= sprintf(
                        '<rect x="%d" y="%d" width="%d" height="%d" rx="1"/>',
                        $x + ($column * $cell),
                        16 + ($row * $cell) + $jitter,
                        $cell,
                        $cell,
                    );
                }
            }

            $x += (5 * $cell) + $gap;
        }

        $width = $x - $gap + 16;
        $height = 16 + (7 * $cell) + 16;
        $noise = '';

        for ($i = 0; $i < 5; $i++) {
            $noise .= sprintf(
                '<line x1="%d" y1="%d" x2="%d" y2="%d"/>',
                random_int(10, $width - 10),
                random_int(8, $height - 8),
                random_int(10, $width - 10),
                random_int(8, $height - 8),
            );
        }

        return sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %d %d" role="presentation" focusable="false" aria-hidden="true"><rect width="100%%" height="100%%" fill="#F5F7FB"/><g fill="none" stroke="#C5D0E0" stroke-width="2">%s</g><g fill="#1A3A78">%s</g></svg>',
            $width,
            $height,
            $noise,
            $rects,
        );
    }
}
