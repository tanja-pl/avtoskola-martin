@extends('layouts.app')
@section('title', 'Нашиот Тим — Автошкола Мартин')
@section('description', '12 искусни и лиценцирани инструктори во Автошкола Мартин Скопје.')
@section('nav', 'team')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Нашиот Тим</span></div>
    <h1>Нашиот Тим</h1>
    <p>12 лиценцирани и страстни инструктори посветени на вашиот успех. Запознајте ги луѓето кои ќе ве научат безбедно возење.</p>
  </div>
</div>

<section style="background:var(--bg-alt);">
  <div class="container">
    <div class="stats-grid" style="border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;margin-bottom:72px;">
      <div class="stat-item"><div class="stat-icon"><i class="fa-solid fa-users"></i></div><div class="stat-text"><div class="count"><span data-count="12">12</span></div><div class="desc">Инструктори</div></div></div>
      <div class="stat-item"><div class="stat-icon"><i class="fa-solid fa-trophy"></i></div><div class="stat-text"><div class="count"><span data-count="34" data-suffix="+">34+</span></div><div class="desc">Години искуство</div></div></div>
      <div class="stat-item"><div class="stat-icon"><i class="fa-solid fa-id-card"></i></div><div class="stat-text"><div class="count"><span data-count="10">10</span></div><div class="desc">Категории</div></div></div>
      <div class="stat-item"><div class="stat-icon"><i class="fa-solid fa-star"></i></div><div class="stat-text"><div class="count"><span data-count="100" data-suffix="%">100%</span></div><div class="desc">Лиценцирани</div></div></div>
    </div>

    <div class="section-tag">Инструктори</div>
    <h2 class="section-heading" style="margin-bottom:48px;">Запознајте го нашиот тим</h2>
    <div class="team-grid">
      <div class="team-card reveal">
        <div class="team-photo"><img src="{{ asset('images/instructors/martin1.png') }}" alt="Мартин Трајановски" loading="lazy"></div>
        <div class="team-info"><h4>Мартин Трајановски</h4><div class="team-role">Категории A, A2, Б, Ц, ЦE, Д</div><p>Инструктор со долгогодишно искуство во обука за мотоцикл, автомобил и професионални категории.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-1">
        <div class="team-photo"><img src="{{ asset('images/instructors/stefan.png') }}" alt="Стефан Трајановски" loading="lazy"></div>
        <div class="team-info"><h4>Стефан Трајановски</h4><div class="team-role">Категории A, A2, Б, Ц, ЦE, Д</div><p>Инструктор за мотоцикл и автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-2">
        <div class="team-photo"><img src="{{ asset('images/instructors/miki.png') }}" alt="Мики Трајановски" loading="lazy"></div>
        <div class="team-info"><h4>Мики Трајановски</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-3">
        <div class="team-photo"><img src="{{ asset('images/instructors/ljupco.png') }}" alt="Љупчо Костенцовски" loading="lazy"></div>
        <div class="team-info"><h4>Љупчо Костенцовски</h4><div class="team-role">Категории Ц, ЦE, Д</div><p>Инструктор за професионални категории — над 24 години искуство, дипломиран педагог.</p></div>
      </div>
      <div class="team-card reveal">
        <div class="team-photo"><img src="{{ asset('images/instructors/igor.png') }}" alt="Игор Вичишки" loading="lazy"></div>
        <div class="team-info"><h4>Игор Вичишки</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-1">
        <div class="team-photo"><img src="{{ asset('images/instructors/zoki.png') }}" alt="Зоран Крстевски" loading="lazy"></div>
        <div class="team-info"><h4>Зоран Крстевски</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-2">
        <div class="team-photo"><img src="{{ asset('images/instructors/sase.jpg') }}" alt="Сашо Тодоровски" loading="lazy"></div>
        <div class="team-info"><h4>Сашо Тодоровски</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-3">
        <div class="team-photo"><img src="{{ asset('images/instructors/martina.jpg') }}" alt="Мартина Крстевска" loading="lazy"></div>
        <div class="team-info"><h4>Мартина Крстевска</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal">
        <div class="team-photo"><img src="{{ asset('images/instructors/cece.jpg') }}" alt="Светлана Спасовска" loading="lazy"></div>
        <div class="team-info"><h4>Светлана Спасовска</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-1">
        <div class="team-photo"><img src="{{ asset('images/instructors/bube.jpg') }}" alt="Љупка Илијоска" loading="lazy"></div>
        <div class="team-info"><h4>Љупка Илијоска</h4><div class="team-role">Категорија Б</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-1">
        <div class="team-photo"><img src="{{ asset('images/instructors/lile.jpg') }}" alt="Лилјана Тодорова" loading="lazy"></div>
        <div class="team-info"><h4>Лилјана Тодорова</h4><div class="team-role">Категорија Б, А</div><p>Инструктор за патнички автомобил.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-2">
        <div class="team-photo"><img src="{{ asset('images/instructors/bile.png') }}" alt="Билјана" loading="lazy"></div>
        <div class="team-info"><h4>Билјана</h4><div class="team-role">Финансии / администрација</div><p>За можности за финансирање: 070-363-449.</p></div>
      </div>
      <div class="team-card reveal reveal-delay-2">
        <div class="team-photo"><img src="{{ asset('images/instructors/jonce.jpg') }}" alt="Јонече" loading="lazy"></div>
        <div class="team-info"><h4>Јонче Апостоловски</h4><div class="team-role">Стручен рак. и предавач по теорија</div></div>
      </div>
    </div>

    <div style="text-align:center;margin-top:48px;padding:40px;background:var(--white);border:1px solid var(--border);border-radius:var(--r-lg);">
      <p style="color:var(--muted);font-size:1.05rem;margin-bottom:24px;">Сите инструктори се лиценцирани и со долгогодишно искуство.</p>
      <a href="{{ route('contact') }}" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone"></i> Контактирај нè</a>
    </div>
  </div>
</section>

<!-- Values -->
<section>
  <div class="container">
    <div class="text-center" style="margin-bottom:56px;">
      <div class="section-tag" style="justify-content:center;">Нашите вредности</div>
      <h2>Што нè прави поинакви</h2>
    </div>
    <div class="why-grid">
      <div class="why-card reveal"><div class="why-icon"><i class="fa-solid fa-heart"></i></div><h3>Страст за обука</h3><p>Секој инструктор е вистински посветен на образованието и успехот на кандидатите.</p></div>
      <div class="why-card reveal reveal-delay-1"><div class="why-icon"><i class="fa-solid fa-shield-halved"></i></div><h3>Безбедност прво</h3><p>Нашата примарна цел е безбедноста на патиштата — учиме одговорни возачи.</p></div>
      <div class="why-card reveal reveal-delay-2"><div class="why-icon"><i class="fa-solid fa-graduation-cap"></i></div><h3>Континуирана едукација</h3><p>Инструкторите редовно се обновуваат и следат нови методи на обука.</p></div>
      <div class="why-card reveal reveal-delay-3"><div class="why-icon"><i class="fa-solid fa-handshake"></i></div><h3>Индивидуален пристап</h3><p>Секој кандидат е посебен — темпото и стилот на обука се прилагодуваат кон вас.</p></div>
    </div>
  </div>
</section>
@endsection
