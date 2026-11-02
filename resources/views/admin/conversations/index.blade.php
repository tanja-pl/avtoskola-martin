@extends('admin.layout')

@section('title', 'Разговори')

@section('content')
  <div class="page">
    <div class="page-head">
      <div>
        <h1>Разговори</h1>
        <p>Прашања од посетителите и одговори од асистентот, по датум и време.</p>
      </div>
    </div>

    <div class="stats">
      <a class="stat" href="{{ route('admin.conversations.index') }}">
        <span>Сите разговори</span>
        <strong>{{ $stats['total'] }}</strong>
      </a>
      <a @class(['stat', 'is-on' => request()->boolean('contact')]) href="{{ route('admin.conversations.index', ['contact' => 1]) }}">
        <span>Оставиле контакт</span>
        <strong>{{ $stats['contact'] }}</strong>
      </a>
      <a @class(['stat', 'is-on' => request()->boolean('enrollment')]) href="{{ route('admin.conversations.index', ['enrollment' => 1]) }}">
        <span>Интерес за запишување</span>
        <strong>{{ $stats['enrollment'] }}</strong>
      </a>
    </div>

    <form class="filters" method="GET" action="{{ route('admin.conversations.index') }}" autocomplete="off">
      @if ($errors->any())
        <p class="form-error" role="alert">{{ $errors->first() }}</p>
      @endif
      <div class="filters-grid">
        <label>
          <span>Клучен збор</span>
          <input type="search" name="q" value="{{ request('q') }}" placeholder="Прашање или одговор" maxlength="200">
        </label>
        <label>
          <span>Име</span>
          <input type="text" name="name" value="{{ request('name') }}" placeholder="Име на посетител" maxlength="80">
        </label>
        <label>
          <span>Телефон</span>
          <input type="text" name="phone" value="{{ request('phone') }}" placeholder="07…" inputmode="tel" maxlength="30">
        </label>
        <label>
          <span>Од датум</span>
          <input type="date" name="from" value="{{ request('from') }}">
        </label>
        <label>
          <span>До датум</span>
          <input type="date" name="to" value="{{ request('to') }}">
        </label>
      </div>
      <div class="filters-actions">
        <label class="check">
          <input type="checkbox" name="contact" value="1" @checked(request()->boolean('contact'))>
          <span>Само со контакт</span>
        </label>
        <label class="check">
          <input type="checkbox" name="enrollment" value="1" @checked(request()->boolean('enrollment'))>
          <span>Само интерес за запишување</span>
        </label>
        <button type="submit" class="primary">Пребарај</button>
        @if ($hasFilters)
          <a class="text-btn" href="{{ route('admin.conversations.index') }}">Исчисти</a>
        @endif
      </div>
    </form>

    @if ($conversations->isEmpty())
      <div class="empty">
        @if ($hasFilters)
          <h2>Нема разговори за овие филтри</h2>
          <p>Променете го датумот, името, телефонот или клучниот збор.</p>
        @else
          <h2>Сè уште нема разговори</h2>
          <p>Кога посетител ќе напише во чатот, прашањето и одговорот ќе се појават тука.</p>
        @endif
      </div>
    @else
      <p class="result-count">Прикажани {{ $conversations->total() }}</p>
      <div class="conv-list">
        @foreach ($conversations as $conversation)
          <a @class([
            'conv-card',
            'is-contact' => $conversation->contact_provided,
            'is-enrollment' => $conversation->enrollment_interest,
          ]) href="{{ route('admin.conversations.show', $conversation) }}">
            <div class="conv-top">
              <time datetime="{{ $conversation->last_message_at?->toIso8601String() }}">{{ $conversation->activityLabel() }}</time>
              <span class="badges">
                @include('admin.conversations._badges', ['conversation' => $conversation])
              </span>
            </div>
            <h2>{{ $conversation->displayName() }}</h2>
            @if ($conversation->visitor_name && $conversation->formattedPhone())
              <p class="phone">{{ $conversation->formattedPhone() }}</p>
            @endif
            <p class="preview">{{ $conversation->preview() }}</p>
            @if ($conversation->answerPreview() !== '')
              <p class="answer">{{ $conversation->answerPreview() }}</p>
            @endif
            <p class="meta">{{ $conversation->exchangeCountLabel() }}</p>
          </a>
        @endforeach
      </div>

      @if ($conversations->hasPages())
        <nav class="pager" aria-label="Страници">
          @if ($conversations->onFirstPage())
            <span class="pager-off">Претходна</span>
          @else
            <a href="{{ $conversations->previousPageUrl() }}">Претходна</a>
          @endif
          <span>{{ $conversations->currentPage() }} / {{ $conversations->lastPage() }}</span>
          @if ($conversations->hasMorePages())
            <a href="{{ $conversations->nextPageUrl() }}">Следна</a>
          @else
            <span class="pager-off">Следна</span>
          @endif
        </nav>
      @endif
    @endif
  </div>
@endsection
