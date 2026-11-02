@extends('layouts.app')
@section('title', 'Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете? — Автошкола Мартин')
@section('description', 'Одлична вест за сите возачи кои поседуваат Б категорија!')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('blog') }}">Блог</a><i class="fa-solid fa-chevron-right"></i><span>Потврда за мотоцикл до 125cc со Б категори…</span></div>
    <div class="article-kicker"></div>
    <h1>Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?</h1>
    <p class="article-date"><i class="fa-regular fa-calendar"></i> 12.06.2026</p>
  </div>
</div>
<article class="article-wrap">
  <div class="container article-inner">
    <img src="{{ asset('images/blog/potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete.jpg') }}" alt="Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?" class="article-hero-img">
    <div class="article-body">
      <p>Одлична вест за сите возачи кои поседуваат Б категорија!</p>
<p>Согласно новите законски измени, доколку имате над 23 години и поседувате Б категорија повеќе од 5 години, сега имате можност да добиете потврда за управување со мотоцикл до 125 cm³, без полагање за А категорија.</p>
<h2>Што е потребно?</h2>
<ul><li>Да имате наполнето 23 години</li></ul>
<ul><li>Да поседувате Б категорија најмалку 5 години</li></ul>
<ul><li>Да завршите четиричасовна теоретска обука</li></ul>
<p>По успешно завршената обука, ќе можете легално да управувате со мотор до 125cc со автоматски менувач.</p>
<p>Во Автошкола Мартин вршиме професионална обука согласно сите законски прописи и нови измени, со искусни инструктори и брза процедура.</p>
<p>Доколку сакате да ја искористите оваа нова можност, резервирајте го вашиот термин навреме, бидејќи интересот е голем.</p>
<p>📞 Контакт: 071 251 259 / 070 363 449 / 02 3 114 065</p>
      
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
        </article>
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}" class="blog-thumb"><img src="{{ asset('images/blog/subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija.png') }}" alt="Субвенции на млади лица од општина Центар за обука за Б категорија"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 01.02.2026</span></div>
            <h3><a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}">Субвенции на млади лица од општина Центар за обука за Б категорија</a></h3>
            <p>Општина Центар информира дека распиша Јавен повик за доделување субвенции на младите жители на општината за полагање на возачки испит Б-категорија во автошколи регистрирани на подрачјето на Центар. Овој повик е отворен н…</p>
            <a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
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
