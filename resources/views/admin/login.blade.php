<!DOCTYPE html>
<html lang="mk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Најава — Разговори</title>
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-chat.css') }}">
</head>
<body class="login-body">
  <main class="login-card">
    <img src="{{ asset('images/logo.png') }}" alt="Автошкола Мартин" class="login-logo">
    <h1>Разговори со посетители</h1>
    <p class="lede">Најавете се за да ги прегледате прашањата од чатот и одговорите на асистентот.</p>

    @if ($errors->any())
      <p class="form-error" role="alert">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}">
      @csrf
      <label>
        <span>Е-пошта</span>
        <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
      </label>
      <label>
        <span>Лозинка</span>
        <input type="password" name="password" autocomplete="current-password" required>
      </label>
      <label class="check">
        <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
        <span>Задржи ме најавен</span>
      </label>
      <button type="submit" class="primary">Најава</button>
    </form>
    <a class="quiet" href="{{ route('home') }}">Кон сајтот</a>
  </main>
</body>
</html>
