@extends('layouts.app')
@section('title', 'Електронски тестови за возачка — Автошкола Мартин')
@section('description', 'Официјални тестови за возачка дозвола (MK/AL), тестови со точни одговори, прирачник и демо. Прашања по категории B, C и D — Автошкола Мартин Скопје.')
@section('nav', 'etest')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Е-Тест</span></div>
    <h1>Електронски тестови за возачка</h1>
    <p>Официјални материјали за учење: тестови на македонски и албански, тестови со точни одговори, прирачник и демо. Вежбајте пред полагање, ние ве подготвуваме на часовите.</p>
  </div>
</div>

<nav class="etest-jump" aria-label="Содржина на страницата">
  <div class="container etest-jump-inner">
    <a href="#testovi">Тестови</a>
    <a href="#odgovori">Со одговори</a>
    <a href="#kategorii-prasanja">Категории</a>
    <a href="#priracnik">Прирачник</a>
    <a href="#demo">Демо</a>
  </div>
</nav>

<section>
  <div class="container etest-layout">
    <div class="etest-main">
      <div id="testovi" class="etest-block reveal">
        <div class="section-tag">МВР</div>
        <h2>Тестови за возачка дозвола</h2>
        <p>Официјални прашања за вежбање — изберете јазик.</p>
        <div class="etest-lang">
          <a class="etest-lang-btn" href="http://mvr.gov.mk/vozacka-testovi/mkd/prasanja_MK.htm" target="_blank" rel="noopener noreferrer">
            <span class="etest-lang-code">MK</span>
            Тестови (македонски)
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
          </a>
          <a class="etest-lang-btn" href="http://mvr.gov.mk/vozacka-testovi/alb/prasanja_AL.htm" target="_blank" rel="noopener noreferrer">
            <span class="etest-lang-code">AL</span>
            Тестови (албански)
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
          </a>
        </div>
      </div>

      <div id="odgovori" class="etest-block reveal">
        <div class="section-tag">Проверка</div>
        <h2>Тестови со точни одговори</h2>
        <p>Истите тестови, со означени точни одговори — за учење и самопроверка.</p>
        <div class="etest-lang">
          <a class="etest-lang-btn etest-lang-btn-alt" href="http://mvr.gov.mk/vozacka-testovi/Testovi-so-tocni-odgovori/mk/prasanjaMK.htm" target="_blank" rel="noopener noreferrer">
            <span class="etest-lang-code">MK</span>
            Тестови со одговори
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
          </a>
          <a class="etest-lang-btn etest-lang-btn-alt" href="http://mvr.gov.mk/vozacka-testovi/Testovi-so-tocni-odgovori/al/prasanjaAL.aspx.htm" target="_blank" rel="noopener noreferrer">
            <span class="etest-lang-code">AL</span>
            Тестови со одговори
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
          </a>
        </div>
      </div>

      <div id="kategorii-prasanja" class="etest-block reveal">
        <div class="section-tag">Учење</div>
        <h2>Прашања кои треба да се учат за одредена категорија</h2>
        <p>Опсегот на прашања според официјалниот фонд. Отворете ја категоријата кај нас за услови, часови и испит.</p>
        <div class="etest-cat-study">
          <a class="etest-cat-row" href="{{ route('category', 'b-kategorija') }}">
            <div class="etest-cat-icon"><i class="fa-solid fa-car" aria-hidden="true"></i></div>
            <div>
              <h3>Б категорија</h3>
              <p>Од 1 до 75 и од 91 до 636 прашање · фонд 621</p>
            </div>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
          </a>
          <a class="etest-cat-row" href="{{ route('category', 'c-kategorija') }}">
            <div class="etest-cat-icon"><i class="fa-solid fa-truck" aria-hidden="true"></i></div>
            <div>
              <h3>Ц категорија</h3>
              <p>Од 637 до 756 прашање · фонд 120</p>
            </div>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
          </a>
          <a class="etest-cat-row" href="{{ route('category', 'd-kategorija') }}">
            <div class="etest-cat-icon"><i class="fa-solid fa-bus" aria-hidden="true"></i></div>
            <div>
              <h3>Д категорија</h3>
              <p>Од 757 до 936 прашање · фонд 180</p>
            </div>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
          </a>
          <a class="etest-cat-row" href="{{ route('category', 'a-kategorija') }}">
            <div class="etest-cat-icon"><i class="fa-solid fa-motorcycle" aria-hidden="true"></i></div>
            <div>
              <h3>A / A1 / A2</h3>
              <p>Фонд за учење: 553 прашања · тестот има 28 прашања</p>
            </div>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>

    <aside class="etest-aside">
      <div id="priracnik" class="etest-book reveal">
        <div class="section-tag">МВР</div>
        <h2>Прирачник</h2>
        <p>Прирачник за полагање возачки испит — отворете го PDF документот.</p>
        <a class="etest-book-cover" href="http://www.mvr.gov.mk/Upload/Documents/Priracnik-vozacki-ispiti.pdf" target="_blank" rel="noopener noreferrer">
          <img src="{{ asset('images/priracnik-cover.png') }}" alt="Прирачник за полагање возачки испит">
          <span class="etest-book-open"><i class="fa-solid fa-file-pdf" aria-hidden="true"></i> Отвори PDF</span>
        </a>
        <div class="etest-book-counts">
          <div>
            <i class="fa-solid fa-car" aria-hidden="true"></i>
            <strong>621</strong>
            <span>прашања · Б</span>
          </div>
          <div>
            <i class="fa-solid fa-truck" aria-hidden="true"></i>
            <strong>120</strong>
            <span>прашања · Цена</span>
          </div>
          <div>
            <i class="fa-solid fa-bus" aria-hidden="true"></i>
            <strong>180</strong>
            <span>прашања · Д</span>
          </div>
        </div>
      </div>
    </aside>
  </div>
</section>

<section id="demo" class="etest-demo-section">
  <div class="container">
    <div class="etest-demo reveal">
      <div>
        <div class="section-tag">Вежба</div>
        <h2>Тестирај се онлајн, демо верзија</h2>
        <p>Официјална демо платформа за електронски тест. Вежбајте го форматот пред полагање во испитен центар.</p>
      </div>
      <a class="btn btn-yellow btn-lg" href="http://etest.amsm.mk/" target="_blank" rel="noopener noreferrer">
        <i class="fa-solid fa-play" aria-hidden="true"></i> Отвори демо
      </a>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-tag" style="justify-content:center;">На испитот</div>
      <h2>Како изгледа полагањето</h2>
      <p class="section-sub">Податоци од страниците за категории на Автошкола Мартин.</p>
    </div>
    <div class="etest-info-grid">
      <div class="etest-info-card reveal">
        <div class="ei-icon"><i class="fa-solid fa-car"></i></div>
        <h3>Категорија Б</h3>
        <p>Тестот има 31 прашање. Фонд за учење: 621 прашање. По теоријата се полага пробен тест.</p>
      </div>
      <div class="etest-info-card reveal reveal-delay-1">
        <div class="ei-icon"><i class="fa-solid fa-motorcycle"></i></div>
        <h3>Категории A</h3>
        <p>Тестот има 28 прашања. Фонд: 553 прашања. Со Б категорија не се полага теоретски дел.</p>
      </div>
      <div class="etest-info-card reveal reveal-delay-2">
        <div class="ei-icon"><i class="fa-solid fa-truck"></i></div>
        <h3>Категорија Ц</h3>
        <p>Тестот има 12 прашања. Фонд: 120 прашања.</p>
      </div>
      <div class="etest-info-card reveal reveal-delay-3">
        <div class="ei-icon"><i class="fa-solid fa-bus"></i></div>
        <h3>Категорија Д</h3>
        <p>Тестот има 18 прашања. Фонд: 180 прашања.</p>
      </div>
    </div>
  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text">
        <h2>Подготвени за Е-Тест?</h2>
        <p>Запишете се во Автошкола Мартин — теоретска настава, пробен тест и поддршка пред полагање.</p>
      </div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-outline btn-lg"><i class="fa-solid fa-phone"></i> Контакт</a>
      </div>
    </div>
  </div>
</div>
@endsection
