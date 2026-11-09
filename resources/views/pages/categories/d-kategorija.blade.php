@extends('layouts.app')
@section('title', 'Категорија Д — Автошкола Мартин')
@section('description', 'Категорија D во Автошкола Мартин Скопје.')
@section('nav', 'categories')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>Категорија D</span></div>
    <h1>Категорија Д — автобус</h1>
    <p>Обука за Д на MAN. Услови, часови и испит според Автошкола Мартин.</p>
  </div>
</div>
<section>
  <div class="container cat-page">
    <div class="cat-page-main">
<p class="cat-lead">Категорија Д — автобус. Обука на MAN.</p>
<h2>Услови и потребни документи</h2>
<div class="cat-req-grid"><div class="cat-req-item"><i class="fa-solid fa-check"></i>лична карта / пасош</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>возачка дозвола од Ц категорија најмалку две години</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>лекарско уверение за „Д“ категорија</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>навршени 23 години и шест месеци</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>завршено најмалку основно образование</div></div>
<h2>Возило за обука и полагање</h2><div class="cat-vehicles"><article class="cat-vehicle"><img src="https://wmk-ci.xsoftstatic.com/Write/07379/Images/Kategorii/bus.jpg" alt="MAN" onerror="this.style.display='none'"><div class="cat-vehicle-body"><h3>MAN</h3><p>Автобус со максимална прегледност за обука и полагање на Д категорија.</p></div></article></div>
<h2>Инструктори</h2><div class="cat-people"><article class="cat-person"><img src="{{ asset('images/instructors/ljupco.png') }}" alt="Љупчо Костенцовски" onerror="this.style.display='none'"><h3>Љупчо Костенцовски</h3><p>Категории А, А1, А2, Б, БЕ, Ц, Ц1, Ц1Е, ЦЕ, Д, Д1, Д1Е, ДЕ</p></article></div>
<h2>Обука</h2><p>Оспособувањето се состои од теоретска и практична настава.</p><div class="cat-train"><div class="cat-train-item"><strong>Теоретска настава</strong><p>12 наставни часа во училница, вкупно три дена.</p></div><div class="cat-train-item"><strong>Практична настава</strong><p>16 наставни часа, по два часа дневно, вкупно осум дена.</p></div><div class="cat-train-item"><strong>Возачки испит</strong><p>Од 45 до 60 минути градска.</p></div></div>
<h2>Возачки испит</h2><ul class="cat-exam"><li>Тестот за Д има 18 прашања. Фонд: 180 прашања.</li><li>Полигон: четири вежби.</li><li>Градска започнува од паркинг просторот кај Хотел Русија.</li></ul>
<p><a href="{{ route('etest') }}" class="btn btn-outline-dark">Е-Тест</a></p>    </div>
    <aside class="cat-aside">
      <div class="cat-price">
        <div class="label">Цена на обука</div>
        <div class="amount">40.000 денари</div>
        <p>Можност за рати. За финансирање: Мартин, 071-251-259.</p>
        <a href="{{ route('contact') }}" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:10px;">Контакт</a>
      </div>
      <div class="cat-aside-card">
        <h3>Други категории</h3>
        <div class="cat-aside-links">
          <a href="{{ route('category', 'a-kategorija') }}">A — мотоцикл</a>
          <a href="{{ route('category', 'a2-kategorija') }}">A2 — средна класа</a>
          <a href="{{ route('category', 'a1-kategorija') }}">A1 — лесен мотоцикл</a>
          <a href="{{ route('category', 'am-kategorija') }}">AM — мопед</a>
          <a href="{{ route('category', 'b-kategorija') }}">Б — автомобил</a>
          <a href="{{ route('category', 'b-automatik') }}">Б автоматик</a>
          <a href="{{ route('category', 'be-kategorija') }}">БE — приколка</a>
          <a href="{{ route('category', 'c-kategorija') }}">Ц — камион</a>
          <a href="{{ route('category', 'ce-kategorija') }}">ЦE — камион + приколка</a>
          <a href="{{ route('category', 'd-kategorija') }}" class="is-current" aria-current="page">Д — автобус</a>
        </div>
      </div>
    </aside>
  </div>
</section>
<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text"><h2>Спремни за Категорија Д?</h2><p>Прочитајте ги условите, па јавете се или пишете ни кога сте подготвени.</p></div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone"></i> Контактирај нè</a>
        <a href="{{ route('categories') }}" class="btn btn-outline btn-lg">Сите категории</a>
      </div>
    </div>
  </div>
</div>
@endsection
