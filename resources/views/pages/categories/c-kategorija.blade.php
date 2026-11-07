@extends('layouts.app')
@section('title', 'Категорија Ц — Автошкола Мартин')
@section('description', 'Категорија Ц во Автошкола Мартин Скопје.')
@section('nav', 'categories')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>Категорија Ц</span></div>
    <h1>Категорија Ц — товарен камион</h1>
    <p>Обука за Ц на Mercedes Atego 1218. Услови, часови и испит.</p>
  </div>
</div>
<section>
  <div class="container cat-page">
    <div class="cat-page-main">
<p class="cat-lead">Категорија Ц — товарно возило над 3.500 kg. Обука на Mercedes Atego 1218.</p>
<h2>Услови и потребни документи</h2>
<div class="cat-req-grid"><div class="cat-req-item"><i class="fa-solid fa-check"></i>лична карта / пасош</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>возачка дозвола од Б категорија најмалку една година</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>лекарско уверение за „Ц“ категорија</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>навршени 20 години и шест месеци</div><div class="cat-req-item"><i class="fa-solid fa-check"></i>завршено најмалку основно образование</div></div>
<h2>Возило за обука и полагање</h2><div class="cat-vehicles"><article class="cat-vehicle is-hero"><img src="{{ asset('images/vehicles/c.jpg') }}" alt="Mercedes Atego 1218"><div class="cat-vehicle-body"><h3>Mercedes Atego 1218</h3><p>Стандарден менувач како кај патничките автомобили, ергономни ретровизори, серво волан и ABS.</p></div></article></div>
<h2>Инструктори</h2><div class="cat-people"><article class="cat-person"><img src="{{ asset('images/instructors/ljupco.png') }}" alt="Љупчо Костенцовски" onerror="this.style.display='none'"><h3>Љупчо Костенцовски</h3><p>Инструктор за професионални категории — над 24 години искуство, дипломиран педагог</p></article></div>
<h2>Обука</h2><p>Оспособувањето се состои од теоретска и практична настава.</p><div class="cat-train"><div class="cat-train-item"><strong>Теоретска настава</strong><p>12 наставни часа во училница, вкупно три дена.</p></div><div class="cat-train-item"><strong>Практична настава</strong><p>20 наставни часа, по 2 часа дневно, вкупно десет дена.</p></div><div class="cat-train-item"><strong>Возачки испит</strong><p>Од 45 до 60 минути градска.</p></div></div>
<h2>Возачки испит</h2><ul class="cat-exam"><li>Тестот за Ц има 12 прашања. Фонд: 120 прашања.</li><li>Полигон: четири вежби.</li><li>Градска започнува од паркинг просторот кај Хотел Русија.</li></ul>
<p><a href="{{ route('etest') }}" class="btn btn-outline-dark">Е-Тест</a></p>    </div>
    <aside class="cat-aside">
      <div class="cat-price">
        <div class="label">Цена на обука</div>
        <div class="amount">30.000 денари</div>
        <p>Можност за рати. За финансирање: Билјана, 070-363-449.</p>
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
          <a href="{{ route('category', 'c-kategorija') }}" class="is-current" aria-current="page">Ц — камион</a>
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
      <div class="cta-text"><h2>Спремни за Категорија Ц?</h2><p>Прочитајте ги условите, па јавете се или пишете ни кога сте подготвени.</p></div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone"></i> Контактирај нè</a>
        <a href="{{ route('categories') }}" class="btn btn-outline btn-lg">Сите категории</a>
      </div>
    </div>
  </div>
</div>
@endsection
