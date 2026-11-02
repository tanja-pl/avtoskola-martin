<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatConversation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConversationController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:200'],
            'name' => ['nullable', 'string', 'max:80'],
            'phone' => ['nullable', 'string', 'max:30'],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'contact' => ['nullable', 'boolean'],
            'enrollment' => ['nullable', 'boolean'],
        ], [
            'to.after_or_equal' => 'Крајниот датум мора да биде ист или по почетниот.',
            'from.date' => 'Почетниот датум не е валиден.',
            'to.date' => 'Крајниот датум не е валиден.',
        ]);

        $request->session()->put('admin.conversation_filters', array_filter(
            $request->only(['q', 'name', 'phone', 'from', 'to', 'contact', 'enrollment']),
            fn ($value) => is_scalar($value) && $value !== ''
        ));

        $conversations = ChatConversation::query()
            ->filtered($filters)
            ->with('latestMessage')
            ->withCount('messages')
            ->orderByDesc('last_message_at')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => ChatConversation::query()->count(),
            'contact' => ChatConversation::query()->where('contact_provided', true)->count(),
            'enrollment' => ChatConversation::query()->where('enrollment_interest', true)->count(),
        ];

        $hasFilters = collect($filters)->contains(fn ($value) => $value !== null && $value !== '' && $value !== false);

        return view('admin.conversations.index', compact('conversations', 'stats', 'hasFilters'));
    }

    public function show(Request $request, ChatConversation $conversation): View
    {
        $conversation->load(['messages' => fn ($query) => $query->orderBy('created_at')->orderBy('id')]);
        $conversation->loadCount('messages');

        $backUrl = route(
            'admin.conversations.index',
            $request->session()->get('admin.conversation_filters', [])
        );

        return view('admin.conversations.show', compact('conversation', 'backUrl'));
    }
}
