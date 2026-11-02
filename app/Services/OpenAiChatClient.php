<?php

namespace App\Services;

use function App\Support\Chat\callOpenAI;

class OpenAiChatClient
{
    /**
     * @param  array<string, mixed>  $config
     * @param  list<array{role: string, content: string}>  $messages
     * @return array<string, mixed>
     */
    public function complete(array $config, array $messages): array
    {
        return callOpenAI($config, $messages);
    }
}
