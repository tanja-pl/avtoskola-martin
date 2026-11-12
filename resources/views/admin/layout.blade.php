<!DOCTYPE html>
<html lang="mk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Разговори') — Автошкола Мартин</title>
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="192x192">
  <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-chat.css') }}">
</head>
<body>
  <a class="skip-link" href="#main">Прескокни до содржина</a>
  <header class="topbar">
    <div class="topbar-start">
      <a class="brand" href="{{ route('admin.conversations.index') }}">
        <img src="{{ asset('images/logo.png') }}" alt="">
        <span>
          <strong>Автошкола Мартин</strong>
          <small>Админ панел</small>
        </span>
      </a>
      <nav class="admin-nav" aria-label="Секции">
        <a href="{{ route('admin.conversations.index') }}" @class(['is-on' => request()->routeIs('admin.conversations.*')])>Разговори</a>
        <a href="{{ route('admin.analytics.index') }}" @class(['is-on' => request()->routeIs('admin.analytics.*')])>Аналитика</a>
      </nav>
    </div>
    <nav class="top-actions">
      <a href="{{ route('home') }}" target="_blank" rel="noopener">Сајт</a>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Одјава</button>
      </form>
    </nav>
  </header>
  <main id="main">
    @yield('content')
  </main>
</body>
</html>
