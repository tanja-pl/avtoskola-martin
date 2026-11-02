@extends('layouts.app')
@section('title', 'Авто школа Мартин има потреба од возач-инструктор за &quot;Б&quot; категорија — Автошкола Мартин')
@section('description', 'Авто школа Мартин ја завршува 2021 година со вработување на нов инструктор за &quot;Б&quot; категорија')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('blog') }}">Блог</a><i class="fa-solid fa-chevron-right"></i><span>Авто школа Мартин има потреба од возач-инс…</span></div>
    <div class="article-kicker"></div>
    <h1>Авто школа Мартин има потреба од возач-инструктор за &quot;Б&quot; категорија</h1>
    <p class="article-date"><i class="fa-regular fa-calendar"></i> 29.12.2021</p>
  </div>
</div>
<article class="article-wrap">
  <div class="container article-inner">
    <img src="{{ asset('images/blog/avto-shkola-martin-ima-potreba-od-vozach-instruktor-za-b-kategorija.jpg') }}" alt="Авто школа Мартин има потреба од возач-инструктор за &quot;Б&quot; категорија" class="article-hero-img">
    <div class="article-body">
      <p>Автошкола Мартин ја завршува 2021 година со вработување на нов возач-инструктор за Б категорија</p>
      
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
