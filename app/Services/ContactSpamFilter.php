<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Throwable;

class ContactSpamFilter
{
    public function rejection(string $name, string $subject, string $message): ?string
    {
        $combined = $name."\n".$subject."\n".$message;

        if ($this->containsLink($combined)) {
            return 'Пораката не може да содржи линкови или адреси на веб-страници. Јавете се на 02-3114-065.';
        }

        if ($this->containsMarkup($combined)) {
            return 'Пораката содржи недозволена содржина. Јавете се на 02-3114-065.';
        }

        if ($this->isRepeated($message)) {
            return 'Оваа порака веќе ја имаме примено. Јавете се на 02-3114-065 ако ви треба помош.';
        }

        return null;
    }

    public function remember(string $message): void
    {
        $key = $this->fingerprint($message);
        if ($key === null) {
            return;
        }

        try {
            Cache::put($key, true, now()->addHours(12));
        } catch (Throwable) {
            // A cache outage must not block a real message.
        }
    }

    private function containsLink(string $value): bool
    {
        $withoutEmails = preg_replace('/[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}/iu', ' ', $value) ?? $value;

        if (preg_match('/https?:\/\/|www\./iu', $withoutEmails) === 1) {
            return true;
        }

        return preg_match(
            '/(?<![\p{L}\p{N}_@])(?:[\p{L}\p{N}][\p{L}\p{N}-]{0,62}\.)+(?:com|net|org|info|biz|ru|cc|xyz|top|click|link|ly|me|io|co|uk|de|nl|su|pw|shop|online|site|icu|live|fun|app|dev)(?:\/|\b)/iu',
            $withoutEmails,
        ) === 1;
    }

    private function containsMarkup(string $value): bool
    {
        return preg_match('/<\s*\/?\s*[a-z!]|\[url|javascript:/iu', $value) === 1;
    }

    private function isRepeated(string $message): bool
    {
        $key = $this->fingerprint($message);
        if ($key === null) {
            return false;
        }

        try {
            return Cache::has($key);
        } catch (Throwable) {
            return false;
        }
    }

    private function fingerprint(string $message): ?string
    {
        $normalized = preg_replace('/\s+/u', ' ', trim($message)) ?? '';
        if (mb_strlen($normalized) < 60) {
            return null;
        }

        return 'contact-spam:'.hash('sha256', mb_strtolower($normalized, 'UTF-8'));
    }
}
