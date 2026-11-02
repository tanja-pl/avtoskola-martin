@extends('layouts.app')
@section('title', 'Најчести грешки за време на полагање 2 (Обиколување) — Автошкола Мартин')
@section('description', 'Обиколување е возење покрај запрено или паркирано возило или друг објект што се наоѓа на сообраќајната лента по која се движи возилото')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('blog') }}">Блог</a><i class="fa-solid fa-chevron-right"></i><span>Најчести грешки за време на полагање 2 (Об…</span></div>
    <div class="article-kicker"><span class="blog-tag-inline">Сообраќајни ситуации</span> <span class="blog-tag-inline">Најчести грешки за време на полагање</span> <span class="blog-tag-inline">А и А2 категорија</span></div>
    <h1>Најчести грешки за време на полагање 2 (Обиколување)</h1>
    <p class="article-date"><i class="fa-regular fa-calendar"></i> 14.11.2020</p>
  </div>
</div>
<article class="article-wrap">
  <div class="container article-inner">
    <img src="{{ asset('images/blog/obikoluvanje-so-logo.png') }}" alt="Најчести грешки за време на полагање 2 (Обиколување)" class="article-hero-img">
    <div class="article-body">
      <h2>Обиколување (општи правила, начин, техника и забрана)</h2>
<ul><li>Обиколување е возење покрај запрено или паркирано возило или друг објект што се наоѓа на сообраќајната лента по која се движи возилото</li></ul>
<ul><li>Обиколувањето се изведува од лева страна, освен во одредени околности каде може и од лева и десна страна (во услови на еднонасочен сообраќај)</li></ul>
<p>Возачот смее да изведе обиколување доколку не ги загрозува другите учесници во сообраќајот. При тоа треба да обрне внимание на, карактеристиките на патот, сообраќајната ситуација на патот и техничката состојба на возилото дали има доволно простор за безбедно обиколување и враќање во својата лента.</p>
      <div class="article-gallery"><img src="{{ asset('images/blog/najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje-extra-2.png') }}" alt="Најчести грешки за време на полагање 2 (Обиколување)"><img src="{{ asset('images/blog/najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje-extra-3.png') }}" alt="Најчести грешки за време на полагање 2 (Обиколување)"><img src="{{ asset('images/blog/najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje-extra-4.png') }}" alt="Најчести грешки за време на полагање 2 (Обиколување)"><img src="{{ asset('images/blog/najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje-extra-5.png') }}" alt="Најчести грешки за време на полагање 2 (Обиколување)"></div>
    </div>
    <p class="article-back"><a href="{{ route('blog') }}" class="blog-link"><i class="fa-solid fa-arrow-left"></i> Сите статии</a></p>
  </div>
</article>
<section>
  <div class="container">
    <div class="section-tag">Уште од блогот</div>
    <h2>Други статии</h2>
    <div class="blog-grid">
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}" class="blog-thumb"><img src="{{ asset('images/blog/potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete.jpg') }}" alt="Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 12.06.2026</span></div>
            <h3><a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}">Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?</a></h3>
            <p>Одлична вест за сите возачи кои поседуваат Б категорија!</p>
            <a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}" class="blog-thumb"><img src="{{ asset('images/blog/kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija.png') }}" alt="Како да ја добиете возачката дозвола за мотор во Македонија?"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 02.06.2026</span></div>
            <h3><a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}">Како да ја добиете возачката дозвола за мотор во Македонија?</a></h3>
            <p>Доколку размислувате да станете моторџија, првиот чекор е стекнување на соодветна возачка дозвола. Во продолжение ќе објасниме како изгледа процесот за добивање возачка дозвола за мотор во Македонија.</p>
            <a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}" class="blog-thumb"><img src="{{ asset('images/blog/5-soveti-za-uspeshno-polaganje-na-vozachki-ispit.jpg') }}" alt="5 совети за успешно полагање на возачки испит"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 04.03.2026</span></div>
            <h3><a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}">5 совети за успешно полагање на возачки испит</a></h3>
            <p>Полагањето на возачки испит е важен момент за секој млад возач. Нервозата е нормална, но со добра подготовка шансите за успех значително се зголемуват. Еве 5 практични совети кои ќе ви помогнат да го положите испитот на…</p>
            <a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article></div>
  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text">
        <h2>Спремни за возачка?</h2>
        <p>Запишете се во Автошкола Мартин — обука, теорија и поддршка пред испит.</p>
      </div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-outline btn-lg"><i class="fa-solid fa-phone"></i> Контакт</a>
      </div>
    </div>
  </div>
</div>
@endsection
