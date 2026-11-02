<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'conversation_id',
        'visitor_message',
        'assistant_response',
        'visitor_name',
        'visitor_phone',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class, 'conversation_id');
    }

    public function dayLabel(): string
    {
        if ($this->created_at === null) {
            return '';
        }

        if ($this->created_at->isToday()) {
            return 'Денес';
        }

        if ($this->created_at->isYesterday()) {
            return 'Вчера';
        }

        return $this->created_at->format('d.m.Y');
    }
}
