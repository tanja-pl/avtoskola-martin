@extends('layouts.app')
@section('title', 'Видеа од обуки — Автошкола Мартин')
@section('description', 'Полигонски видеа за A, Б, Ц и Д категорија од Автошкола Мартин Скопје.')
@section('nav', 'videos')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Видеа</span></div>
    <h1>Видеа од обуки</h1>
    <p>Полигонски вежби снимени во Автошкола Мартин — за категориите A, Б, Ц и Д. Пуштете ги тука или на YouTube.</p>
  </div>
</div>

<nav class="video-jump" aria-label="Категории видеа">
  <div class="container video-jump-inner">
    <a href="#video-a">A категорија</a>
    <a href="#video-b">Б категорија</a>
    <a href="#video-c">Ц категорија</a>
    <a href="#video-d">Д категорија</a>
  </div>
</nav>

<section>
  <div class="container">
    <div class="video-grid">
      <article class="video-card reveal" id="video-a" data-video="Fq5TcZ3ysyo">
        <div class="video-thumb">
          <img src="{{ asset('images/video/a-poligon.jpg') }}" alt="Автошкола Мартин А категорија — полигон">
          <button type="button" class="video-play" aria-label="Пушти видео за A категорија"><i class="fa-solid fa-play" aria-hidden="true"></i></button>
        </div>
        <div class="video-body">
          <div class="video-tag">A категорија</div>
          <h2>Полигон | 2 вежби</h2>
          <p>Автошкола Мартин А категорија — полигонски вежби.</p>
          <div class="video-actions">
            <a href="{{ route('category', 'a-kategorija') }}">За A категорија</a>
            <a href="https://www.youtube.com/watch?v=Fq5TcZ3ysyo" target="_blank" rel="noopener noreferrer">YouTube <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
          </div>
        </div>
      </article>

      <article class="video-card reveal reveal-delay-1" id="video-b" data-video="Up_JP5Y-veo">
        <div class="video-thumb">
          <img src="{{ asset('images/video/b-poligon.jpg') }}" alt="Автошкола Мартин Б категорија — полигон">
          <button type="button" class="video-play" aria-label="Пушти видео за Б категорија"><i class="fa-solid fa-play" aria-hidden="true"></i></button>
        </div>
        <div class="video-body">
          <div class="video-tag">Б категорија</div>
          <h2>Полигон | 4 вежби</h2>
          <p>Автошкола Мартин Б категорија — полигон.</p>
          <div class="video-actions">
            <a href="{{ route('category', 'b-kategorija') }}">За Б категорија</a>
            <a href="https://www.youtube.com/watch?v=Up_JP5Y-veo" target="_blank" rel="noopener noreferrer">YouTube <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
          </div>
        </div>
      </article>

      <article class="video-card reveal reveal-delay-2" id="video-c" data-video="jnoqB-WfP34">
        <div class="video-thumb">
          <img src="{{ asset('images/video/c-poligon.jpg') }}" alt="Автошкола Мартин Ц категорија — полигон">
          <button type="button" class="video-play" aria-label="Пушти видео за Ц категорија"><i class="fa-solid fa-play" aria-hidden="true"></i></button>
        </div>
        <div class="video-body">
          <div class="video-tag">Ц категорија</div>
          <h2>Полигон | 4 вежби</h2>
          <p>Автошкола Мартин Ц категорија — полигон.</p>
          <div class="video-actions">
            <a href="{{ route('category', 'c-kategorija') }}">За Ц категорија</a>
            <a href="https://www.youtube.com/watch?v=jnoqB-WfP34" target="_blank" rel="noopener noreferrer">YouTube <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
          </div>
        </div>
      </article>

      <article class="video-card reveal" id="video-d" data-video="vto-m0mdwtE">
        <div class="video-thumb">
          <img src="{{ asset('images/video/d-poligon.jpg') }}" alt="Автошкола Мартин Д категорија — полигон">
          <button type="button" class="video-play" aria-label="Пушти видео за Д категорија"><i class="fa-solid fa-play" aria-hidden="true"></i></button>
        </div>
        <div class="video-body">
          <div class="video-tag">Д категорија</div>
          <h2>Полигон | 4 вежби</h2>
          <p>Автошкола Мартин Д категорија — полигон.</p>
          <div class="video-actions">
            <a href="{{ route('category', 'd-kategorija') }}">За Д категорија</a>
            <a href="https://www.youtube.com/watch?v=vto-m0mdwtE" target="_blank" rel="noopener noreferrer">YouTube <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
          </div>
        </div>
      </article>
    </div>

    <div class="video-channel">
      <div>
        <div class="section-tag">YouTube</div>
        <h2>Канал на Автошкола Мартин</h2>
        <p>Повеќе видеа од обуките гледајте ги на официјалниот YouTube канал.</p>
      </div>
      <a class="btn btn-yellow btn-lg" href="https://www.youtube.com/@автошколаМартин" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-youtube" aria-hidden="true"></i> Отвори канал
      </a>
    </div>
  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text">
        <h2>Спремни за обука?</h2>
        <p>Запишете се во Автошкола Мартин — полигон, градска и поддршка пред испит.</p>
      </div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone"></i> Контактирај нè</a>
        <a href="{{ route('categories') }}" class="btn btn-outline btn-lg">Категории</a>
      </div>
    </div>
  </div>
</div>
@endsection
