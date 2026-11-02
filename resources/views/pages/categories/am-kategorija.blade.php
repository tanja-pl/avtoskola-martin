@extends('layouts.app')
@section('title', 'Категорија AM — Автошкола Мартин')
@section('description', 'Категорија AM во Автошкола Мартин: мопед, услови и теоретски испит.')
@section('nav', 'categories')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>Категорија AM</span></div>
    <h1>Категорија AM — мопед</h1>
    <p>Теоретска обука за AM (до 45 km/h). Услови, часови и испит според Автошкола Мартин.</p>
  </div>
</div>
<section>
  <div class="container cat-page">
    <div class="cat-page-main">
<p class="cat-lead">Во категорија AM спаѓаат мопеди, мотокултиватор, односно возила на две или три тркала со максимална брзина која не надминува 45 km/h и лесни четирицикли. Возач-почетник не смее да управува возило во патниот сообраќај од 23 часот до 5 часот.</p>
<h2>Услови и потребни документи</h2>
<div class="cat-req-grid"><div class="cat-req-item"><i class="fa-solid fa-check"></i>лична карта</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>лекарско уверение за AM категорија</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>согласност од родителите</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>прва помош</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>завршено најмалку основно образование</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>навршени 16 години</div></div>
<h2>Обука</h2><p>Оспособувањето се состои од теоретска и практична настава.</p><div class="cat-train"><div class="cat-train-item"><strong>Теоретска настава</strong><p>12 наставни часа во просториите на автошколата, вкупно три дена. За AM обуката се состои само од теоретска настава.</p></div><div class="cat-train-item"><strong>Возачки испит</strong><p>Само теоретски дел. Тестовите се достапни на страницата Е-Тест.</p></div></div>
<h2>Возачки испит</h2><ul class="cat-exam"><li>Испитот за AM се состои само од теоретски дел.</li><li>Тестовите може да ги најдете на страницата Е-Тест.</li></ul>
<p><a href="{{ route('etest') }}" class="btn btn-outline-dark">Отвори Е-Тест</a></p>    </div>
    <aside class="cat-aside">
      <div class="cat-price">
        <div class="label">Цена на обука</div>
        <div class="amount">6.000 денари</div>
        <p>За повеќе информации: Мартин, 071-251-259.</p>
        <a href="{{ route('contact') }}" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:10px;">Контакт</a>
      </div>
      <div class="cat-aside-card">
        <h3>Други категории</h3>
        <div class="cat-aside-links">
          <a href="{{ route('category', 'a-kategorija') }}">A — мотоцикл</a>
          <a href="{{ route('category', 'a2-kategorija') }}">A2 — средна класа</a>
          <a href="{{ route('category', 'a1-kategorija') }}">A1 — лесен мотоцикл</a>
          <a href="{{ route('category', 'am-kategorija') }}" class="is-current" aria-current="page">AM — мопед</a>
          <a href="{{ route('category', 'b-kategorija') }}">Б автомобил</a>
          <a href="{{ route('category', 'b-automatik') }}">Б автоматик</a>
          <a href="{{ route('category', 'be-kategorija') }}">БE — приколка</a>
          <a href="{{ route('category', 'c-kategorija') }}">Ц — камион</a>
          <a href="{{ route('category', 'ce-kategorija') }}">ЦE — камион + приколка</a>
          <a href="{{ route('category', 'd-kategorija') }}">Д — автобус</a>
        </div>
      </div>
    </aside>
  </div>
</section>
<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text"><h2>Спремни за Категорија AM?</h2><p>Прочитајте ги условите, па јавете се или пишете ни кога сте подготвени.</p></div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone"></i> Контактирај нè</a>
        <a href="{{ route('categories') }}" class="btn btn-outline btn-lg">Сите категории</a>
      </div>
    </div>
  </div>
</div>
@endsection
