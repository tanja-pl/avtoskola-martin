<!DOCTYPE html>
<html lang="mk">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Автошкола Мартин')</title>
  <meta name="description" content="@yield('description', 'Автошкола Мартин во Скопје.')">
  <meta name="theme-color" content="#2955A4">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
  @stack('head')
</head>
<body>
@php($nav = $__env->yieldContent('nav'))
<a class="skip-link" href="#main">Прескокни до содржина</a>
<nav class="navbar transparent" id="navbar">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="nav-logo">
      <img src="{{ asset('images/logo.png') }}" class="logo-img" alt="Автошкола Мартин">
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}" class="{{ $nav === 'home' ? 'active' : '' }}">Почетна</a></li>
      <li><a href="{{ route('categories') }}" class="{{ $nav === 'categories' ? 'active' : '' }}">Категории</a></li>
      <li><a href="{{ route('team') }}" class="{{ $nav === 'team' ? 'active' : '' }}">Нашиот Тим</a></li>
      <li><a href="{{ route('etest') }}" class="{{ $nav === 'etest' ? 'active' : '' }}">Е-Тест</a></li>
      <li><a href="{{ route('videos') }}" class="{{ $nav === 'videos' ? 'active' : '' }}">Видеа</a></li>
      <li><a href="{{ route('blog') }}" class="{{ $nav === 'blog' ? 'active' : '' }}">Блог</a></li>
      <li><a href="{{ route('contact') }}" class="{{ $nav === 'contact' ? 'active' : '' }}">Контакт</a></li>
      <li><a href="tel:023114065" class="nav-phone"><i class="fa-solid fa-phone" aria-hidden="true"></i> 02-3114-065</a></li>
    </ul>
    <button class="nav-hamburger" id="navHamburger" aria-label="Мени" aria-expanded="false" aria-controls="navMobile">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
<div class="nav-mobile" id="navMobile">
  <a href="{{ route('home') }}" class="{{ $nav === 'home' ? 'active' : '' }}">Почетна</a>
  <a href="{{ route('categories') }}" class="{{ $nav === 'categories' ? 'active' : '' }}">Категории</a>
  <a href="{{ route('team') }}" class="{{ $nav === 'team' ? 'active' : '' }}">Нашиот Тим</a>
  <a href="{{ route('etest') }}" class="{{ $nav === 'etest' ? 'active' : '' }}">Е-Тест</a>
  <a href="{{ route('videos') }}" class="{{ $nav === 'videos' ? 'active' : '' }}">Видеа</a>
  <a href="{{ route('blog') }}" class="{{ $nav === 'blog' ? 'active' : '' }}">Блог</a>
  <a href="{{ route('contact') }}" class="{{ $nav === 'contact' ? 'active' : '' }}">Контакт</a>
  <a href="tel:023114065">Повикај 02-3114-065</a>
</div>

<main id="main">
  @if (session('status'))
    <div class="container" style="padding-top:24px;">
      <p style="background:#ECFDF5;border:1px solid #A7F3D0;color:#065F46;padding:12px 16px;border-radius:12px;">{{ session('status') }}</p>
    </div>
  @endif
  @if ($errors->any())
    <div class="container" style="padding-top:24px;">
      <p style="background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;padding:12px 16px;border-radius:12px;">{{ $errors->first() }}</p>
    </div>
  @endif
  @yield('content')
</main>

@include('partials.footer')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/chatbot.js') }}"></script>
@stack('scripts')
</body>
</html>
