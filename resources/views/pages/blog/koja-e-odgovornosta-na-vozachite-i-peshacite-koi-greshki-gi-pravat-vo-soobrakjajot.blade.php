@extends('layouts.app')
@section('title', 'Која е одговорноста на возачите и пешаците, кои грешки ги прават во сообраќајот? — Автошкола Мартин')
@section('description', 'Една од најчестите причини кај кандидатите, за паѓање на возачкиот испит, се пешаците !')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('blog') }}">Блог</a><i class="fa-solid fa-chevron-right"></i><span>Која е одговорноста на возачите и пешаците…</span></div>
    <div class="article-kicker"><span class="blog-tag-inline">Сообраќаен информатор</span> <span class="blog-tag-inline">Најчести грешки за време на полагање</span></div>
    <h1>Која е одговорноста на возачите и пешаците, кои грешки ги прават во сообраќајот?</h1>
    <p class="article-date"><i class="fa-regular fa-calendar"></i> 11.05.2022</p>
  </div>
</div>
<article class="article-wrap">
  <div class="container article-inner">
    <img src="{{ asset('images/blog/koja-e-odgovornosta-na-vozachite-i-peshacite-koi-greshki-gi-pravat-vo-.png') }}" alt="Која е одговорноста на возачите и пешаците, кои грешки ги прават во сообраќајот?" class="article-hero-img">
    <div class="article-body">
      <p>Една од најчестите причини кај кандидатите, за паѓање на возачкиот испит, се пешаците !</p>
<p>Општ е впечатокот кај граѓаните, дека возилата на автошколите, најмногу ги почитуваат нивните права како пешаци. И покрај тоа при полагање, во оценувачките листи се множат негативните поени, токму поради пешаците, а голема е бројката на пешаците и како жртви во сообраќајните незгоди. Зошто?</p>
<h2>Одговорноста на возачите?</h2>
<p>Превентивно пред секој пешачки премин за да не се загрозат пешаците кои веќе чекаат или наидуваат кон преминот потребно е да се одземе гаста на возилото за навремено да се намали брзината на движење и се забележат пешаците.</p>
<p>Една од најголемите грешки што премногу често се случува на нашите улици е тоа што возачите на возилата сметаат дека треба да ги пропуштат пешаците само доколку веќе се стапнати на коловозот. Тоа е погрешно и многу е поголема можноста да дојде до незгода. Имајте на ум дека како пешак можат да се најдат деца, повозрасни лица, лица со посебни потреби, инвалиди каде што тие лица немаат премногу знаење и добри проценки за сообраќај.</p>
<p>ЗАТОА КАКО ОДГОВОРЕН ВОЗАЧ ПОТРЕБНО Е ДА МУ ЗАСТАНЕТЕ НА ПЕШАКОТ ДОДЕКА ЧЕКА НА ТРОТОАРОТ И САКА ДА ГО ПОМИНЕ ПЕШАЧКИОТ ПРЕМИН !</p>
<h2>Што не смее да се прави пред пешачки премин?</h2>
<p>•<br>Зголемување на брзината на движење</p>
<p>•<br>Престројување на возилото од една во друга сообраќајна лента</p>
<p>•<br>Затоа и пред секој пешачки премин има полна линија која забранува престројување со возило.</p>
<h2>Одговорноста на пешаците?</h2>
<p>Исто така пешаците имаат одговорности на кои мора да внимаваат. Во ситуацијата кога поминуваат на коловоз мора претходно да се уверат дали безбедно може да поминат. Големиот дел од пешаците немаат добро познавање за сообраќајот и не проверуваат доволно пред да се решат да поминат од едниот до другиот дел на коловозот.</p>
<p>ЗА ДА ПОМИНЕТЕ СИГУРНО И БЕЗБЕДНО СЕКОГАШ ПОМИНУВАЈТЕ НА ПЕШАЧКИ ПРЕМИН И УВЕРУВАЈТЕ СЕ ДЕКА НЕМА ВОЗИЛО ИЛИ ДЕКА ТОА ВОЗИЛО ВЕЌЕ Е ЗАСТАНАТО И ВЕ ПРОПУШТА. КОГА ЌЕ СЕ ВКЛУЧИ ЗЕЛЕНОТО СВЕТЛО ЗА ПЕШАЦИ НЕ ТРГНУВАЈТЕ ОДМА, НАПРАВЕТЕ УШТЕ ЕДНА ПРОВЕРКА ДЕКА НЕМА ВОЗИЛО ШТО ЗАОСТАНАЛО ИЛИ ПОМИНАЛО НА ЦРВЕНО. ИМАЈТЕ НА УМ, ВИЕ СТЕ РАНЛИВИ ДОКОЛУ ДОЈДЕ ДО НЕЗГОДА !</p>
      
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
