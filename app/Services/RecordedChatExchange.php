<?php

namespace App\Services;

use App\Models\ChatConversation;

readonly class RecordedChatExchange
{
    public function __construct(
        public ChatConversation $conversation,
        public bool $contactJustCaptured,
    ) {}
}
