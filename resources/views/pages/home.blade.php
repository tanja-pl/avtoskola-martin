@extends('layouts.app')
@section('title', 'Автошкола Мартин — Возете со Самодоверба | Скопје')
@section('description', 'Автошкола Мартин во Скопје — над 34 години искуство, 15.000+ кандидати и 12 лиценцирани инструктори. Учете за живот, не за испит.')
@section('nav', 'home')
@section('content')
<!-- ── Categories (first thing visitors see) ─────────────────────── -->
<section class="section-dark cats-first" id="kategorii" aria-labelledby="catsHeading">

  <div class="container">
    <div class="highlight-carousel" id="highlightCarousel" data-interval="3000" tabindex="0" aria-label="Најважни информации">
      <div class="highlight-track">
        <article class="highlight-slide is-active">
          <img src="{{ asset('images/home/hero-team.jpg') }}" alt="Инструктори и возила на Автошкола Мартин">
        </article>
        <article class="highlight-slide">
          <img src="{{ asset('images/home/hero-fleet.jpg') }}" alt="Возила на Автошкола Мартин">
        </article>
        <article class="highlight-slide">
          <img src="{{ asset('images/home/hero-a1.jpg') }}" alt="Подготовка за Е-Тест">
        </article>
        <article class="highlight-slide">
          <img src="{{ asset('images/home/hero-auto.jpg') }}" alt="Флексибилни термини за обука">
        </article>
      </div>
      <button type="button" class="highlight-btn highlight-prev" data-dir="prev" aria-label="Претходен слајд"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
      <div class="highlight-dots" role="tablist" aria-label="Слајдови"></div>
      <button type="button" class="highlight-btn highlight-next" data-dir="next" aria-label="Следен слајд"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
    </div>
    <div class="text-center" style="margin-bottom:56px;">
      <h2 id="catsHeading">Категории за кои вршиме обука</h2>
      <p style="color:rgba(255,255,255,.55);margin:16px auto 0;max-width:520px;font-size:1.05rem;">Без разлика дали сакате да возите мотор, автомобил, камион или автобус ние сме тука.</p>
    </div>
    <div class="cats-grid">
      <a href="{{ route('category', 'a-kategorija') }}" class="cat-card reveal"><div class="cat-icon"><i class="fa-solid fa-motorcycle" aria-hidden="true"></i></div><div class="cat-label">A</div><div class="cat-desc">Мотоцикл без ограничување</div></a>
      <a href="{{ route('category', 'a2-kategorija') }}" class="cat-card reveal reveal-delay-1"><div class="cat-icon"><i class="fa-solid fa-motorcycle" aria-hidden="true"></i></div><div class="cat-label">A2</div><div class="cat-desc">Мотоцикл средна класа до 35kW</div></a>
      <a href="{{ route('category', 'a1-kategorija') }}" class="cat-card reveal reveal-delay-2"><div class="cat-icon"><i class="fa-solid fa-motorcycle" aria-hidden="true"></i></div><div class="cat-label">A1</div><div class="cat-desc">Лесен мотоцикл до 125cc</div></a>
      <a href="{{ route('category', 'am-kategorija') }}" class="cat-card reveal reveal-delay-3"><div class="cat-icon"><i class="fa-solid fa-bicycle" aria-hidden="true"></i></div><div class="cat-label">AM</div><div class="cat-desc">Мопед</div></a>
      <a href="{{ route('category', 'b-kategorija') }}" class="cat-card reveal"><div class="cat-icon"><i class="fa-solid fa-car" aria-hidden="true"></i></div><div class="cat-label">Б</div><div class="cat-desc">Патнички автомобил</div></a>
      <a href="{{ route('category', 'b-automatik') }}" class="cat-card reveal reveal-delay-1"><div class="cat-icon"><i class="fa-solid fa-car" aria-hidden="true"></i></div><div class="cat-label">Б автоматик</div><div class="cat-desc">Автоматски менувач</div></a>
      <a href="{{ route('category', 'be-kategorija') }}" class="cat-card reveal reveal-delay-2"><div class="cat-icon"><i class="fa-solid fa-truck-pickup" aria-hidden="true"></i></div><div class="cat-label">БE</div><div class="cat-desc">Автомобил со приколка</div></a>
      <a href="{{ route('category', 'c-kategorija') }}" class="cat-card reveal reveal-delay-3"><div class="cat-icon"><i class="fa-solid fa-truck" aria-hidden="true"></i></div><div class="cat-label">Ц</div><div class="cat-desc">Камион</div></a>
      <a href="{{ route('category', 'd-kategorija') }}" class="cat-card reveal"><div class="cat-icon"><i class="fa-solid fa-bus" aria-hidden="true"></i></div><div class="cat-label">Д</div><div class="cat-desc">Автобус</div></a>
      <a href="{{ route('category', 'ce-kategorija') }}" class="cat-card reveal reveal-delay-1"><div class="cat-icon"><i class="fa-solid fa-truck-moving" aria-hidden="true"></i></div><div class="cat-label">ЦЕ</div><div class="cat-desc">Камион со приколка</div></a>
    </div>
    <div class="cats-cta">
      <a href="{{ route('categories') }}" class="btn btn-primary btn-lg"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i> Погледни ги сите категории</a>
    </div>
  </div>
</section>

<!-- ── Stats Bar ─────────────────────────────────────────────────── -->
<div class="stats-bar">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item reveal">
        <div class="stat-icon"><i class="fa-solid fa-trophy" aria-hidden="true"></i></div>
        <div class="stat-text">
          <div class="count"><span data-count="34" data-suffix="+">34+</span></div>
          <div class="desc">Години искуство</div>
        </div>
      </div>
      <div class="stat-item reveal reveal-delay-1">
        <div class="stat-icon"><i class="fa-solid fa-users" aria-hidden="true"></i></div>
        <div class="stat-text">
          <div class="count"><span data-count="15000" data-suffix="+">15.000+</span></div>
          <div class="desc">Обучени кандидати</div>
        </div>
      </div>
      <div class="stat-item reveal reveal-delay-2">
        <div class="stat-icon"><i class="fa-solid fa-chalkboard-user" aria-hidden="true"></i></div>
        <div class="stat-text">
          <div class="count"><span data-count="12">12</span></div>
          <div class="desc">Искусни инструктори</div>
        </div>
      </div>
      <div class="stat-item reveal reveal-delay-3">
        <div class="stat-icon"><i class="fa-solid fa-id-card" aria-hidden="true"></i></div>
        <div class="stat-text">
          <div class="count"><span data-count="10">10</span></div>
          <div class="desc">Возачки категории</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ── About ─────────────────────────────────────────────────────── -->
<section>
  <div class="container">
    <div class="about-grid">
      <div class="about-visual reveal">
        <div class="about-img-wrap">
          <img src="{{ asset('images/vehicles/b-1.png') }}"
               decoding="async"
               onerror="this.style.display='none'" alt="Обука во Автошкола Мартин" style="width:100%;height:100%;object-fit:cover;">
        </div>
        <div class="about-badge">
          <div class="badge-num">34+</div>
          <div class="badge-text">Години<br>Искуство</div>
        </div>
      </div>
      <div class="about-text reveal reveal-delay-1">
        <div class="section-tag">За Нас</div>
        <h2 class="section-heading">Доверба изградена<br>со секое возење</h2>
        <p style="margin-bottom:24px;">Автошкола Мартин е основана пред повеќе од три децении и денес е еден од лидерите во образованието на возачи во Скопје. Нашата мисија е едноставна: да ги подготвиме кандидатите не само за испитот, туку за безбедно и одговорно возење низ целиот живот.</p>
        <p style="margin-bottom:32px;">Со современи возила, лиценцирани инструктори и индивидуален пристап кон секој кандидат, нудиме квалитетна обука која ги надминува стандардите.</p>
        <div class="about-features">
          <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></div>
            <div class="feature-text"><h4>Безбедна обука</h4><p>Современа флота со двојни педали, ABS и сите безбедносни системи</p></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-clock" aria-hidden="true"></i></div>
            <div class="feature-text"><h4>Флексибилни термини</h4><p>Утринско, вечерно и викенд возење — прилагодено на вашиот распоред</p></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i></div>
            <div class="feature-text"><h4>Учете за живот</h4><p>Нашата педагогија ве учи вистинско безбедно возење, не само техника за испит</p></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── Why Choose Us ─────────────────────────────────────────────── -->
<section style="background:var(--bg-alt);">
  <div class="container">
    <div class="section-tag">Зошто Нас</div>
    <h2 class="section-heading">Разликата ја чувствувате<br>уште на прв час</h2>
    <p class="section-sub">Нашиот пристап е индивидуален, стрплив и ориентиран кон вашиот успех.</p>
    <div class="why-grid">
      <div class="why-card reveal">
        <div class="why-num">01</div>
        <div class="why-icon"><i class="fa-solid fa-star" aria-hidden="true"></i></div>
        <h3>Искусни инструктори</h3>
        <p>12 лиценцирани инструктори со долгогодишно педагошко искуство и стрпение за секој кандидат.</p>
      </div>
      <div class="why-card reveal reveal-delay-1">
        <div class="why-num">02</div>
        <div class="why-icon"><i class="fa-solid fa-car-burst" aria-hidden="true"></i></div>
        <h3>Модерна флота</h3>
        <p>Возила со двојни педали и сите современи безбедносни системи за максимална безбедност.</p>
      </div>
      <div class="why-card reveal reveal-delay-2">
        <div class="why-num">03</div>
        <div class="why-icon"><i class="fa-solid fa-wallet" aria-hidden="true"></i></div>
        <h3>Флексибилно плаќање</h3>
        <p>Плаќање на рати без камата и без скриени дополнителни трошоци — транспарентни цени.</p>
      </div>
      <div class="why-card reveal reveal-delay-3">
        <div class="why-num">04</div>
        <div class="why-icon"><i class="fa-solid fa-laptop" aria-hidden="true"></i></div>
        <h3>Е-Тест подготовка</h3>
        <p>Пристап до официјалната платформа за практикување на теоретскиот испит онлајн.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA Banner ─────────────────────────────────────────────────── -->
<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text reveal">
        <h2>Подготвени да возите?</h2>
        <p>Јавете се или пишете ни — тука сме да ви помогнеме да започнете.</p>
      </div>
      <div class="cta-actions reveal reveal-delay-1">
        <a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone" aria-hidden="true"></i> Контактирај нè</a>
      </div>
    </div>
  </div>
</div>

<!-- ── Blog Preview ─────────────────────────────────────────────── -->
<section>
  <div class="container">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:24px;margin-bottom:48px;">
      <div>
        <div class="section-tag">Блог & Новости</div>
        <h2 class="section-heading mb-0">Корисни информации<br>за возачи</h2>
      </div>
      <a href="{{ route('blog') }}" class="btn btn-outline-dark">Сите написи <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    </div>
    <div class="blog-grid">
      <article class="blog-card reveal">
        <a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}" class="blog-thumb">
          <img src="{{ asset('images/blog/potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete.jpg') }}" alt="Потврда за мотоцикл до 125cc со Б категорија">
          <span class="blog-tag">Блог</span>
        </a>
        <div class="blog-body">
          <div class="blog-meta"><span><i class="fa-regular fa-calendar" aria-hidden="true"></i> 12.06.2026</span></div>
          <h3><a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}">Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?</a></h3>
          <p>Со Б категорија над 5 години и возраст над 23, можно е да се добие потврда за мотор до 125 cc.</p>
          <a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>
      <article class="blog-card reveal reveal-delay-1">
        <a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}" class="blog-thumb">
          <img src="{{ asset('images/blog/kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija.png') }}" alt="Возачка дозвола за мотор">
          <span class="blog-tag">Блог</span>
        </a>
        <div class="blog-body">
          <div class="blog-meta"><span><i class="fa-regular fa-calendar" aria-hidden="true"></i> 02.06.2026</span></div>
          <h3><a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}">Како да ја добиете возачката дозвола за мотор во Македонија?</a></h3>
          <p>Услови, теорија, практика и испит за возачка дозвола за мотор.</p>
          <a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>
      <article class="blog-card reveal reveal-delay-2">
        <a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}" class="blog-thumb">
          <img src="{{ asset('images/blog/5-soveti-za-uspeshno-polaganje-na-vozachki-ispit.jpg') }}" alt="5 совети за возачки испит">
          <span class="blog-tag">Блог</span>
        </a>
        <div class="blog-body">
          <div class="blog-meta"><span><i class="fa-regular fa-calendar" aria-hidden="true"></i> 04.03.2026</span></div>
          <h3><a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}">5 совети за успешно полагање на возачки испит</a></h3>
          <p>Практични совети за подготовка и полагање на возачкиот испит.</p>
          <a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </article>
    </div>
  </div>
</section>
@endsection
