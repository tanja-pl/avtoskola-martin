<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ChatConversation extends Model
{
    protected $fillable = [
        'token',
        'visitor_name',
        'visitor_phone',
        'contact_provided',
        'enrollment_interest',
        'interest_level',
        'last_message_at',
    ];

    protected $hidden = [
        'token',
    ];

    protected function casts(): array
    {
        return [
            'contact_provided' => 'boolean',
            'enrollment_interest' => 'boolean',
            'last_message_at' => 'datetime',
        ];
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id');
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(ChatMessage::class, 'conversation_id')->latestOfMany();
    }

    public function lead(): HasOne
    {
        return $this->hasOne(Lead::class, 'conversation_id');
    }

    /**
     * @param  Builder<ChatConversation>  $query
     * @param  array<string, mixed>  $filters
     * @return Builder<ChatConversation>
     */
    public function scopeFiltered(Builder $query, array $filters): Builder
    {
        $name = trim((string) ($filters['name'] ?? ''));
        $phone = self::phoneDigits((string) ($filters['phone'] ?? ''));
        $keyword = trim((string) ($filters['q'] ?? ''));
        $from = $filters['from'] ?? null;
        $to = $filters['to'] ?? null;

        $like = function (Builder $inner, string $column, string $term, string $boolean = 'and'): Builder {
            $pattern = '%'.str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $term).'%';
            $sql = $inner->getModel()->getTable().'.'.$column." LIKE ? ESCAPE '!'";

            return $boolean === 'or'
                ? $inner->orWhereRaw($sql, [$pattern])
                : $inner->whereRaw($sql, [$pattern]);
        };

        if ($name !== '') {
            $query->where(function (Builder $inner) use ($name, $like) {
                $like($inner, 'visitor_name', $name);
                $inner->orWhereHas('messages', function (Builder $messages) use ($name, $like) {
                    $like($messages, 'visitor_name', $name);
                });
            });
        }

        if ($phone !== '') {
            $query->where(function (Builder $inner) use ($phone, $like) {
                $like($inner, 'visitor_phone', $phone);
                $inner->orWhereHas('messages', function (Builder $messages) use ($phone, $like) {
                    $like($messages, 'visitor_phone', $phone);
                });
            });
        }

        if ($keyword !== '' || $from || $to) {
            $query->whereHas('messages', function (Builder $messages) use ($keyword, $from, $to, $like) {
                if ($keyword !== '') {
                    $messages->where(function (Builder $inner) use ($keyword, $like) {
                        $like($inner, 'visitor_message', $keyword);
                        $like($inner, 'assistant_response', $keyword, 'or');
                    });
                }
                if ($from) {
                    $messages->where('created_at', '>=', Carbon::parse((string) $from)->startOfDay());
                }
                if ($to) {
                    $messages->where('created_at', '<=', Carbon::parse((string) $to)->endOfDay());
                }
            });
        }

        if (! empty($filters['contact'])) {
            $query->where('contact_provided', true);
        }

        if (! empty($filters['enrollment'])) {
            $query->where('enrollment_interest', true);
        }

        return $query;
    }

    public function displayName(): string
    {
        if (filled($this->visitor_name)) {
            return (string) $this->visitor_name;
        }

        if (filled($this->visitor_phone)) {
            return $this->formattedPhone() ?? (string) $this->visitor_phone;
        }

        return 'Анонимен посетител';
    }

    public function formattedPhone(): ?string
    {
        $phone = (string) $this->visitor_phone;
        if ($phone === '') {
            return null;
        }

        if (preg_match('/^\d{9}$/', $phone) === 1) {
            return substr($phone, 0, 3).' '.substr($phone, 3, 3).' '.substr($phone, 6);
        }

        return $phone;
    }

    public function interestLabel(): ?string
    {
        return match ($this->interest_level) {
            'high' => 'Запишување',
            'medium' => 'Прашања за обука',
            default => null,
        };
    }

    public function activityLabel(): string
    {
        $at = $this->last_message_at ?? $this->created_at;
        if ($at === null) {
            return '';
        }

        if ($at->isToday()) {
            return 'Денес, '.$at->format('H:i');
        }

        if ($at->isYesterday()) {
            return 'Вчера, '.$at->format('H:i');
        }

        return $at->format('d.m.Y H:i');
    }

    public function startedLabel(): string
    {
        return $this->created_at?->format('d.m.Y H:i') ?? '';
    }

    public function preview(): string
    {
        $message = $this->latestMessage;
        if ($message === null) {
            return 'Нема пораки';
        }

        $text = preg_replace('/\s+/u', ' ', trim($message->visitor_message));

        return Str::limit($text ?? '', 110);
    }

    public function answerPreview(): string
    {
        $message = $this->latestMessage;
        if ($message === null) {
            return '';
        }

        $text = preg_replace('/\s+/u', ' ', trim($message->assistant_response));

        return Str::limit($text ?? '', 90);
    }

    public function exchangeCountLabel(): string
    {
        $count = (int) ($this->messages_count ?? $this->messages()->count());

        return $count === 1 ? '1 прашање' : $count.' прашања';
    }

    private static function phoneDigits(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone) ?? '';
        if (str_starts_with($digits, '00389')) {
            $digits = substr($digits, 2);
        }
        if (str_starts_with($digits, '389') && strlen($digits) > 3) {
            $digits = '0'.substr($digits, 3);
        }

        return $digits;
    }
}
