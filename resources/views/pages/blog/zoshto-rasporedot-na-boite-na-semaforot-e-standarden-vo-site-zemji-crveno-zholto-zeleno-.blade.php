@extends('layouts.app')
@section('title', 'Зошто распоредот на боите на семафорот е стандарден во сите земји, црвено, жолто, зелено ? — Автошкола Мартин')
@section('description', 'На крстосница каде сообраќајот е регулиран со светлосни сообраќајни уреди, возачот е должен да постапува според светлосните знаци, кои се вклучуваат по пропишан')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('blog') }}">Блог</a><i class="fa-solid fa-chevron-right"></i><span>Зошто распоредот на боите на семафорот е с…</span></div>
    <div class="article-kicker"><span class="blog-tag-inline">Сообраќаен информатор</span></div>
    <h1>Зошто распоредот на боите на семафорот е стандарден во сите земји, црвено, жолто, зелено ?</h1>
    <p class="article-date"><i class="fa-regular fa-calendar"></i> 30.01.2019</p>
  </div>
</div>
<article class="article-wrap">
  <div class="container article-inner">
    <img src="{{ asset('images/blog/zoshto-rasporedot-na-boite-na-semaforot-e-standarden-vo-site-zemji-crv.png') }}" alt="Зошто распоредот на боите на семафорот е стандарден во сите земји, црвено, жолто, зелено ?" class="article-hero-img">
    <div class="article-body">
      <p>На крстосница каде сообраќајот е регулиран со светлосни сообраќајни уреди, возачот е должен да постапува според светлосните знаци, кои се вклучуваат по пропишан редослед на семафорот.</p>
<ul><li>Дали сте забележале кое светло ќе се вклучи, кога на семафорот (како на сликата) имаме жолт непрекинат светлосен сигнал? Црвено или зелено светло?</li></ul>
<p>Одговор: Кога на семафорот е вклучено жолто постојано светло, тогаш имаме забрането минување низ крстосницата. Освен во случај, кога при вклучување на жолтото светло, се наоѓате со возилото непосредно пред семафорот на таква оддалеченост од крстосницата од која не можете безбедно да запрете пред пешачкиот премин, линијата за запирање, работ на крстосницата ...</p>
<p>Значи, по жолтото светло, на семафорот се вклучува црвено светло.</p>
<p>Зеленото светло на семафорот, се вклучува после црвено и жолто светло кои истовремено светат 2-3 секунди, како подготовка за тргнување.</p>
<ul><li>Зошто распоредот на боите на семафорот е стандарден во сите земји, црвено, жолто, зелено...</li></ul>
<p>Одговор: Распоредот на боите на семафорот е стандарден во цел свет, по редослед црвено, жолто, зелено за да можат да учествуваат во сообраќај и лицата кои не ги разликуваат боите (далтонисти). Тие ги идентификуваат боите и се снаоѓаат, според местоположба на светлата на семафорот.</p>
      
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
