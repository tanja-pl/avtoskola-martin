@extends('layouts.app')
@section('title', 'Улога и значење на теоретската настава. Зошто е битна за кандидатите за возачи ! — Автошкола Мартин')
@section('description', 'Оспособувањето на кандидат за возач е наставен процес, кој задолжително се спроведува според Наставен план и програма за обука на кандидати за возачи. Според За')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('blog') }}">Блог</a><i class="fa-solid fa-chevron-right"></i><span>Улога и значење на теоретската настава. Зо…</span></div>
    <div class="article-kicker"><span class="blog-tag-inline">Автошкола Мартин</span></div>
    <h1>Улога и значење на теоретската настава. Зошто е битна за кандидатите за возачи !</h1>
    <p class="article-date"><i class="fa-regular fa-calendar"></i> 07.04.2022</p>
  </div>
</div>
<article class="article-wrap">
  <div class="container article-inner">
    <img src="{{ asset('images/blog/uloga-i-znachenje-na-teoretskata-nastava-zoshto-e-bitna-za-kandidatite.png') }}" alt="Улога и значење на теоретската настава. Зошто е битна за кандидатите за возачи !" class="article-hero-img">
    <div class="article-body">
      <p>Оспособувањето на кандидат за возач е наставен процес, кој задолжително се спроведува според Наставен план и програма за обука на кандидати за возачи. Според Законот за безбедност во патниот сообраќај, обуката за секој кандидат за возач е задолжителна.</p>
<p>Наставниот план за обука на кандидати за возачи во автошколите, ги опфаќа следниве наставни програми:</p>
<ul><li>сообраќајни правила и прописи (теоретски дел) и</li></ul>
<ul><li>управување со возило (практичен дел).</li></ul>
<h2>Улогата, намената и целта на теоретската настава</h2>
<p>Преку теоретската настава кандидатот се стекнува со основните знаења по однос на сообраќајните правила и прописи, елементите од кои се состои јавен пат, сообраќајните знаци, ознаките на коловозот, светлосните сообраќајни знаци, знаците кои ги дава униформиран полициски службеник, возила под придружба и возила со право на првенство на минување, сообраќај на крстосница,  дејствија со возилото во сообраќај на пат, опасности и последици од лошо извршени дејствија со возилото, негативно влијание на некои фактори за безбедноста во сообраќајот (акутни и хронични заболувања, лекови, алкохол, замор) хумани односи и етика во сообраќајот....</p>
<p>Освен знаењето, преку наставата кандидатот треба да изгради позитивен став и однос кон останатите учесници во сообраќајот. И тука улогата на автошколата е незаменлива.</p>
<p>Преку наставата, предизвик е како да се надмине основниот проблем на денешницава, како да се примени стекнатото знаење во пракса. Како да се стекне навика кај возачите да ги почитуваат сообраќајните правила и прописи, да научат да ги перципираат сообраќајните ситуации, да можат да ги предвидат опасностите и да знаат како да ги избегнат. Тука посебен акцент се става на развојот сообраќајната култура и потикнување на совеста на кандидатот да ги решава сообраќајните ситуации со меѓусебно почитување и толеранција. Кај кандидатот да се поттикне човечност, внимателност и обзир кон останатите учесници во сообраќајот.</p>
<p>Сосема е погрешен  пристапот, дека во автошколата треба да се оствари само основната цел: да се добие возачката дозвола. Статистичките бројки на глобално ниво покажуваат, дека скоро половина (45%) од сообраќајните незгоди се последица од неискуството на возачите и површно помината обука.</p>
      
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
