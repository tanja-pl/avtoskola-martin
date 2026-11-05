<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Services\ChatConversationStore;
use App\Services\OpenAiChatClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

use function App\Support\Chat\assistantAskedForContact;
use function App\Support\Chat\buildSystemPrompt;
use function App\Support\Chat\checkRateLimits;
use function App\Support\Chat\clientIp;
use function App\Support\Chat\ensureContactAsk;
use function App\Support\Chat\ensureLeadConfirmation;
use function App\Support\Chat\ensureUnknownAsksForContact;
use function App\Support\Chat\evaluateLead;
use function App\Support\Chat\friendlyError;
use function App\Support\Chat\isUnknownAnswer;
use function App\Support\Chat\loadConfig;
use function App\Support\Chat\logUnanswered;
use function App\Support\Chat\monthlyBudgetExceeded;
use function App\Support\Chat\persistLead;
use function App\Support\Chat\recordUsage;
use function App\Support\Chat\retrieveRelevantKnowledge;
use function App\Support\Chat\sanitizeHistory;
use function App\Support\Chat\steerMissingDetailsToLead;
use function App\Support\Chat\vehicleImagesForMessage;

class ChatController extends Controller
{
    public function __construct(
        private ChatConversationStore $conversations,
        private OpenAiChatClient $openAi,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $config = loadConfig();
        if ($config === null) {
            return response()->json([
                'error' => 'not_configured',
                'reply' => 'Извинете, чатботот моментално не е конфигуриран. Ве молиме контактирајте нè на 02-3114-065.',
            ], 503);
        }

        $data = $request->all();
        if (! empty($data['website']) || ! empty($data['company'])) {
            return response()->json(['reply' => 'Ви благодариме за пораката.']);
        }

        $message = trim((string) ($data['message'] ?? ''));
        $history = $data['history'] ?? [];
        $maxLen = (int) ($config['max_message_length'] ?? 500);

        if ($message === '' || mb_strlen($message) > $maxLen) {
            return response()->json([
                'error' => 'invalid_message',
                'reply' => $message === ''
                    ? 'Ве молиме внесете прашање.'
                    : 'Пораката е предолга. Скратете ја и обидете се повторно.',
            ], 400);
        }

        $clientIp = $request->ip() ?: clientIp();
        if (checkRateLimits($clientIp, $config) !== true) {
            return response()->json([
                'error' => 'rate_limited',
                'reply' => 'Извинете, испративте премногу пораки. Почекајте малку и обидете се повторно.',
            ], 429);
        }

        if (monthlyBudgetExceeded($config)) {
            return response()->json([
                'error' => 'budget_exceeded',
                'reply' => 'Извинете, чатботот е привремено недостапен. Ве молиме контактирајте нè на 02-3114-065 / 071-251-259.',
            ], 503);
        }

        $cleanHistory = sanitizeHistory($history, $config, $maxLen);
        $incomingLead = is_array($data['lead'] ?? null) ? $data['lead'] : [];
        $incomingLead = $this->conversations->priorLead($data['conversation_id'] ?? null, $incomingLead);
        $lead = evaluateLead($message, $cleanHistory, $incomingLead);

        $retrievalQuery = $message;
        foreach (array_reverse($cleanHistory) as $h) {
            if (($h['role'] ?? '') === 'user') {
                $retrievalQuery .= ' '.$h['content'];
                break;
            }
        }

        $retrieved = retrieveRelevantKnowledge(resource_path('knowledge'), $retrievalQuery, $config);
        $systemPrompt = buildSystemPrompt($retrieved, $lead);

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        foreach ($cleanHistory as $h) {
            $messages[] = $h;
        }
        $messages[] = ['role' => 'user', 'content' => $message];

        $result = $this->openAi->complete($config, $messages);
        if (($result['ok'] ?? false) !== true) {
            $reply = ensureLeadConfirmation(friendlyError(), $lead);
            $conversation = $this->storeExchange($request, $message, $reply, $lead, $clientIp);

            return $this->chatJson([
                'error' => 'ai_unavailable',
                'reply' => $reply,
            ], 502, $conversation);
        }

        if (isset($result['usage']) && is_array($result['usage'])) {
            recordUsage($result['usage'], $config);
        }

        $unknown = isUnknownAnswer($result['reply']);
        if ($unknown) {
            logUnanswered($message, $clientIp);
        }

        $reply = ensureLeadConfirmation(
            ensureContactAsk(
                ensureUnknownAsksForContact(
                    steerMissingDetailsToLead($result['reply'], $message, $lead),
                    $message,
                    $lead,
                ),
                $lead,
            ),
            $lead,
        );
        if (assistantAskedForContact($reply)) {
            $lead['asked'] = true;
        }

        $conversation = $this->storeExchange($request, $message, $reply, $lead, $clientIp);

        return $this->chatJson([
            'reply' => $reply,
            'unknown' => $unknown,
            'lead' => [
                'asked' => ! empty($lead['asked']) || ! empty($lead['ask_now']),
                'captured' => ! empty($lead['captured']),
                'declined' => ! empty($lead['declined']),
            ],
            'images' => vehicleImagesForMessage($message, $cleanHistory),
        ], 200, $conversation);
    }

    /**
     * @param  array<string, mixed>  $lead
     */
    private function storeExchange(Request $request, string $message, string $reply, array $lead, string $clientIp): ?ChatConversation
    {
        $conversation = null;

        try {
            $token = $request->input('conversation_id');
            $conversation = $this->conversations->record(
                is_string($token) ? $token : null,
                $message,
                $reply,
                $lead,
            );
        } catch (Throwable $e) {
            report($e);
        }

        if (! empty($lead['save'])) {
            persistLead($lead, $message, $clientIp, $conversation?->id);
        }

        return $conversation;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function chatJson(array $payload, int $status, ?ChatConversation $conversation): JsonResponse
    {
        if ($conversation !== null) {
            $payload['conversation_id'] = $conversation->token;
        }

        return response()->json($payload, $status);
    }
}
