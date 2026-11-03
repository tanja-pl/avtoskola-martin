@extends('layouts.app')
@section('title', 'Категорија BE — Автошкола Мартин')
@section('description', 'Категорија BE во Автошкола Мартин.')
@section('nav', 'categories')
@section('content')
    <div class="page-hero">
        <div class="container page-hero-content">
            <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a
                    href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>Категорија
                    BE</span></div>
            <h1>Категорија BE — автомобил со приколка</h1>
            <p>Обука за BE: услови, возило, практика и испит.</p>
        </div>
    </div>
    <section>
        <div class="container cat-page">
            <div class="cat-page-main">
                <p class="cat-lead">Категорија BE: автомобил со приколка. Обука на Seat Ibiza 2020.</p>
                <h2>Услови и потребни документи</h2>
                <div class="cat-req-grid">
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>лична карта / пасош</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>лекарско уверение за „БЕ“ категорија</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>завршено најмалку основно образование</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>поседување на категорија B</div>
                </div>
                <h2>Возило за обука и полагање</h2>
                <div class="cat-vehicles is-fleet">
                    <article class="cat-vehicle is-large"><img src="{{ asset('images/vehicles/be.png') }}"
                            alt="SEAT Ibiza со приколка" loading="lazy">
                        <div class="cat-vehicle-body">
                            <h3>SEAT Ibiza, 2020</h3>
                            <p>Патничко возило со приколка, серво волан, клима и ABS, за обука и полагање на BE.</p>
                        </div>
                    </article>
                </div>
                <h2>Инструктори</h2>
                <div class="cat-people is-visible">
                    <article class="cat-person"><img src="{{ asset('images/instructors/martin1.png') }}"
                            alt="Мартин Трајановски" loading="lazy">
                        <h3>Мартин Трајановски</h3>
                        <p>Инструктор за БE</p>
                    </article>
                    <article class="cat-person"><img src="{{ asset('images/instructors/stefan.png') }}"
                            alt="Стефан Трајановски" loading="lazy">
                        <h3>Стефан Трајановски</h3>
                        <p>Инструктор за БE</p>
                    </article>
                </div>
                <h2>Обука</h2>
                <p>Оспособувањето се состои од теоретска и практична настава.</p>
                <div class="cat-train">
                    <div class="cat-train-item"><strong>Теоретска настава</strong>
                        <p>Теоретска настава во училница во автошколата.</p>
                    </div>
                    <div class="cat-train-item"><strong>Практична настава</strong>
                        <p>8 наставни часа, по 2 часа дневно, вкупно 4 дена.</p>
                    </div>
                    <div class="cat-train-item"><strong>Возачки испит</strong>
                        <p>Од 25 до 40 минути градска.</p>
                    </div>
                </div>
                <h2>Возачки испит</h2>
                <ul class="cat-exam">
                    <li>Испитот за BE се состои од практичен дел (градска).</li>
                    <li>Градската започнува од паркинг просторите пред Железничка станица.</li>
                </ul>
            </div>
            <aside class="cat-aside">
                <div class="cat-price">
                    <div class="label">Цена на обука</div>
                    <div class="amount">15.000 денари</div>
                    <p>Можност за рати. За финансирање: Билјана, 070-363-449.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline"
                        style="width:100%;justify-content:center;margin-top:10px;">Контакт</a>
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
                        <a href="{{ route('category', 'be-kategorija') }}" class="is-current" aria-current="page">БЕ —
                            приколка</a>
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
                <div class="cta-text">
                    <h2>Спремни за Категорија БE?</h2>
                    <p>Прочитајте ги условите, па јавете се или пишете ни кога сте подготвени.</p>
                </div>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone"></i>
                        Контактирај нè</a>
                    <a href="{{ route('categories') }}" class="btn btn-outline btn-lg">Сите категории</a>
                </div>
            </div>
        </div>
    </div>
@endsection
