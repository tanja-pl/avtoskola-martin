@extends('layouts.app')
@section('title', 'Автошкола Мартин — Возете со Самодоверба | Скопје')
@section('description', 'Автошкола Мартин во Скопје — над 33 години искуство, 15.000+ кандидати и 12 лиценцирани инструктори. Учете за живот, не за испит.')
@section('nav', 'home')
@section('content')
<section class="home-stage" id="homeStage" aria-roledescription="carousel" aria-label="Најважни информации" tabindex="0">
  <div class="home-aurora" aria-hidden="true"></div>

  <div class="container home-intro">
    <div class="home-copy-stack">
      <article class="home-copy is-active" data-tone="photo">
        <p class="home-kicker">Автошкола Мартин · Скопје</p>
        <h1 class="home-title">Учи за цел живот,<br><span>не за испит</span></h1>
        <p class="home-lead">Над 33 години во центарот на Скопје. Лиценцирани инструктори, современа флота и обука што останува и по испитот.</p>
        <div class="home-actions">
          <a href="{{ route('contact') }}" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone" aria-hidden="true"></i> Контактирај нè</a>
          <a href="#kategorii" class="btn btn-outline btn-lg">Одбери категорија</a>
        </div>
      </article>

      <article class="home-copy" data-tone="photo" aria-hidden="true">
        <p class="home-kicker">Нашата флота</p>
        <h2 class="home-title">Возила подготвени<br><span>за секој час</span></h2>
        <p class="home-lead">Citroën, Peugeot и Renault со серво волан, клима и ABS. Обука на полигон и во сообраќај, со инструктор до вас.</p>
        <div class="home-actions">
          <a href="{{ route('category', 'b-kategorija') }}" class="btn btn-primary btn-lg">Б категорија</a>
          <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">Контакт</a>
        </div>
      </article>

      <article class="home-copy" data-tone="light" aria-hidden="true">
        <p class="home-kicker">Б автоматик</p>
        <h2 class="home-title">Обука со<br><span>автоматски менувач</span></h2>
        <p class="home-lead">Закажете обука на Фиат 500 со инструктор Стефан. Истата патека до дозвола, со автоматски менувач.</p>
        <div class="home-actions">
          <a href="{{ route('category', 'b-automatik') }}" class="btn btn-primary btn-lg">Повеќе за Б автоматик</a>
          <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">Контактирај нè</a>
        </div>
      </article>

      <article class="home-copy" data-tone="dark" aria-hidden="true">
        <p class="home-kicker">А1 категорија</p>
        <h2 class="home-title">Уписите се<br><span>отпочнати</span></h2>
        <p class="home-lead">Категорија А1 со автоматски менувач. Потребни се возачка за Б најмалку 5 години, лекарско уверение и потврда дека нема забрана.</p>
        <div class="home-actions">
          <a href="{{ route('category', 'a1-kategorija') }}" class="btn btn-primary btn-lg">А1 категорија</a>
          <a href="tel:071251259" class="btn btn-outline btn-lg"><i class="fa-solid fa-phone" aria-hidden="true"></i> 071-251-259</a>
        </div>
      </article>

      <article class="home-copy" data-tone="photo" aria-hidden="true">
        <p class="home-kicker">Известување</p>
        <h2 class="home-title">Субвенции за<br><span>млади возачи</span></h2>
        <p class="home-lead">Млади жители од општина Центар и Кисела Вода можат да добијат поддршка за полагање на Б категорија.</p>
        <div class="home-actions">
          <a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}" class="btn btn-primary btn-lg">Прочитај повеќе</a>
          <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">Прашај нè</a>
        </div>
      </article>
    </div>

    <ul class="home-metrics">
      <li>
        <strong><span data-count="33" data-suffix="+">33+</span></strong>
        <span>години искуство</span>
      </li>
      <li>
        <strong><span data-count="15000" data-suffix="+">15.000+</span></strong>
        <span>обучени кандидати</span>
      </li>
      <li>
        <strong><span data-count="12">12</span></strong>
        <span>лиценцирани инструктори</span>
      </li>
      <li>
        <strong><span data-count="10">10</span></strong>
        <span>возачки категории</span>
      </li>
    </ul>
  </div>

  <div class="home-visual">
    <div class="home-screen" data-tone="photo">
      <img class="is-active" data-tone="photo" src="{{ asset('images/home/hero-team.jpg') }}" alt="Инструктори и возила на Автошкола Мартин" width="1920" height="540" fetchpriority="high">
      <img data-tone="photo" src="{{ asset('images/home/hero-fleet.jpg') }}" alt="Автомобили за обука на Автошкола Мартин" width="1920" height="540">
      <img class="is-graphic" data-tone="light" src="{{ asset('images/home/hero-auto.jpg') }}" alt="Фиат 500 за обука со автоматски менувач, инструктор Стефан" width="1920" height="540">
      <img class="is-graphic" data-tone="dark" src="{{ asset('images/home/hero-a1.jpg') }}" alt="Уписи за категорија А1 со автоматски менувач" width="1920" height="540">
      <img data-tone="photo" src="{{ asset('images/home/hero-subsidy.jpg') }}" alt="Субвенции за млади од општина Центар и Кисела Вода" width="1920" height="540">
      <div class="home-screen-shade" aria-hidden="true"></div>
      <div class="home-progress" aria-hidden="true"><span></span></div>
    </div>
    <div class="container home-toolbar">
      <div class="home-controls">
        <button type="button" class="home-nav" data-dir="prev" aria-label="Претходна информација"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
        <div class="home-dots" role="tablist" aria-label="Информации"></div>
        <button type="button" class="home-nav" data-dir="next" aria-label="Следна информација"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
        <button type="button" class="home-nav home-pause" aria-pressed="false" aria-label="Паузирај"><i class="fa-solid fa-pause" aria-hidden="true"></i></button>
        <p class="home-index"><span data-home-index>01</span><span>/ 05</span></p>
      </div>
    </div>
  </div>
  <p class="sr-only" aria-live="polite" data-home-live></p>
</section>

<section class="drive" id="kategorii" aria-labelledby="driveHeading">
  <div class="container">
    <div class="drive-head">
      <div>
        <div class="section-tag">Категории</div>
        <h2 class="section-heading" id="driveHeading">Одберете ја<br>вашата обука</h2>
      </div>
      <p>Автомобил, мотор, камион или автобус. Секоја картичка ја отвора страницата со услови, возила и тек на обука.</p>
    </div>

    <div class="drive-grid">
      <p class="drive-label">Автомобили</p>

      <a class="drive-card is-feature" href="{{ route('category', 'b-kategorija') }}">
        <img src="{{ asset('images/home/cat-b.jpg') }}" alt="" width="750" height="450">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">Б</span>
        <span class="drive-body">
          <span class="drive-name">Патнички автомобил</span>
          <span class="drive-desc">Рачен менувач · Citroën, Peugeot, Renault · од 18 години</span>
        </span>
        <span class="drive-go" aria-hidden="true">Детали <i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card" href="{{ route('category', 'b-automatik') }}">
        <img src="{{ asset('images/home/cat-b-auto.jpg') }}" alt="" width="700" height="400">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">Б</span>
        <span class="drive-body">
          <span class="drive-name">Б автоматик</span>
          <span class="drive-desc">Фиат 500 · автоматски менувач</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card" href="{{ route('category', 'be-kategorija') }}">
        <img src="{{ asset('images/home/cat-be.jpg') }}" alt="" width="750" height="450">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">БЕ</span>
        <span class="drive-body">
          <span class="drive-name">Автомобил со приколка</span>
          <span class="drive-desc">Seat Ibiza · потребна Б категорија</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <p class="drive-label">Мотоцикли</p>

      <a class="drive-card" href="{{ route('category', 'a-kategorija') }}">
        <img src="{{ asset('images/home/cat-a.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">A</span>
        <span class="drive-body">
          <span class="drive-name">Без ограничување</span>
          <span class="drive-desc">Тежок мотоцикл · од 23,5 години</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card" href="{{ route('category', 'a2-kategorija') }}">
        <img src="{{ asset('images/home/cat-a2.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">A2</span>
        <span class="drive-body">
          <span class="drive-name">Средна класа</span>
          <span class="drive-desc">До 35 kW · од 18 години</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card" href="{{ route('category', 'a1-kategorija') }}">
        <img src="{{ asset('images/home/cat-a1.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">A1</span>
        <span class="drive-body">
          <span class="drive-name">Лесен мотоцикл</span>
          <span class="drive-desc">До 125 cc · од 16 години</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card is-studio" href="{{ route('category', 'am-kategorija') }}">
        <img src="{{ asset('images/home/cat-am.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">AM</span>
        <span class="drive-body">
          <span class="drive-name">Мопед</span>
          <span class="drive-desc">До 45 km/h · од 16 години</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <p class="drive-label">Камиони и автобуси</p>

      <a class="drive-card" href="{{ route('category', 'c-kategorija') }}">
        <img src="{{ asset('images/home/cat-c.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">Ц</span>
        <span class="drive-body">
          <span class="drive-name">Товарен камион</span>
          <span class="drive-desc">Mercedes Atego · од 20,5 години</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card" href="{{ route('category', 'ce-kategorija') }}">
        <img src="{{ asset('images/home/cat-ce.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">ЦЕ</span>
        <span class="drive-body">
          <span class="drive-name">Камион со приколка</span>
          <span class="drive-desc">Потребна Ц категорија</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>

      <a class="drive-card" href="{{ route('category', 'd-kategorija') }}">
        <img src="{{ asset('images/home/cat-d.jpg') }}" alt="" width="750" height="450" loading="lazy">
        <span class="drive-shade" aria-hidden="true"></span>
        <span class="drive-code">Д</span>
        <span class="drive-body">
          <span class="drive-name">Автобус</span>
          <span class="drive-desc">Патнички превоз · од 23,5 години</span>
        </span>
        <span class="drive-go" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
      </a>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="about-grid">
      <div class="about-visual reveal">
        <div class="about-img-wrap">
          <img src="{{ asset('images/home/cat-b.jpg') }}" alt="Автомобил за обука на Автошкола Мартин" width="750" height="450" loading="lazy">
        </div>
        <div class="about-badge">
          <div class="badge-num">33+</div>
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
