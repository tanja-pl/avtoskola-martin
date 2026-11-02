@extends('admin.layout')

@section('title', $conversation->displayName())

@section('content')
  <div class="page thread-page">
    <a class="back" href="{{ $backUrl }}">← Сите разговори</a>

    <header @class([
      'thread-head',
      'is-contact' => $conversation->contact_provided,
      'is-enrollment' => $conversation->enrollment_interest,
    ])>
      <div>
        <h1>{{ $conversation->displayName() }}</h1>
        <p class="thread-when">
          Започнат {{ $conversation->startedLabel() }}
          @if ($conversation->last_message_at)
            · последна порака {{ $conversation->activityLabel() }}
          @endif
        </p>
      </div>
      <div class="thread-side">
        <span class="badges">
          @include('admin.conversations._badges', ['conversation' => $conversation])
        </span>
        @if ($conversation->visitor_phone)
          <a class="call" href="tel:{{ $conversation->visitor_phone }}">Јави се · {{ $conversation->formattedPhone() }}</a>
        @endif
        <p class="meta">{{ $conversation->exchangeCountLabel() }}</p>
      </div>
    </header>

    <div class="thread" aria-label="Историја на разговорот">
      @php $previousDay = null; @endphp
      @forelse ($conversation->messages as $message)
        @if ($previousDay !== $message->created_at?->toDateString())
          <div class="day-chip">{{ $message->dayLabel() }}</div>
          @php $previousDay = $message->created_at?->toDateString(); @endphp
        @endif
        <article class="exchange">
          <div class="bubble visitor">
            <span class="who">Посетител</span>
            <p>{{ $message->visitor_message }}</p>
            <time datetime="{{ $message->created_at?->toIso8601String() }}">{{ $message->created_at?->format('d.m.Y H:i') }}</time>
          </div>
          <div class="bubble assistant">
            <span class="who">Асистент</span>
            <p>{{ $message->assistant_response }}</p>
            <time datetime="{{ $message->created_at?->toIso8601String() }}">{{ $message->created_at?->format('d.m.Y H:i') }}</time>
          </div>
        </article>
      @empty
        <p class="empty-inline">Нема пораки во овој разговор.</p>
      @endforelse
    </div>
  </div>
@endsection
