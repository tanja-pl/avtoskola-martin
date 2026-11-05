@extends('layouts.app')
@section('title', 'Категорија Б автоматик — Автошкола Мартин')
@section('description', 'B автоматик во Автошкола Мартин Скопје.')
@section('nav', 'categories')
@section('content')
    <div class="page-hero">
        <div class="container page-hero-content">
            <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a
                    href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>B
                    автоматик</span></div>
            <h1>Категорија Б — автоматски менувач</h1>
            <p>Обука за автомобил со автоматски менувач.</p>
        </div>
    </div>
    <section>
        <div class="container cat-page">
            <div class="cat-page-main">
                <p class="cat-lead">Обука за патнички автомобил со автоматски менувач. Истите услови како категорија Б, со
                    обука на автоматско возило.</p>
                <h2>Услови и потребни документи</h2>
                <div class="cat-req-grid">
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>лична карта / пасош</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>лекарско уверение за „Б“ категорија</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>завршено најмалку основно образование</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>навршени 18 години</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>може и со 17 години и шест месеци, со
                        согласност од двајцата родители заверена на нотар</div>
                </div>
                <h2>Возило за обука и полагање</h2>
                <div class="cat-vehicles is-fleet">
                    <article class="cat-vehicle is-large"><img src="{{ asset('images/vehicles/b-automatic.png') }}"
                            alt="Fiat 500 со автоматски менувач" loading="lazy">
                        <div class="cat-vehicle-body">
                            <h3>Fiat 500 — автоматски менувач</h3>
                            <p>Обука и полагање со автоматски менувач. Серво волан, клима и ABS.</p>
                        </div>
                    </article>
                </div>
                <h2>Инструктор</h2>
                <div class="cat-people is-visible">
                    <article class="cat-person"><img src="{{ asset('images/instructors/zoki.png') }}" alt="Зоран Крстевски"
                            loading="lazy">
                        <h3>Зоран Крстевски</h3>
                        <p>Инструктор за автоматски менувач</p>
                    </article>
                </div>
                <h2>Обука</h2>
                <p>Оспособувањето се состои од теоретска и практична настава.</p>
                <div class="cat-train">
                    <div class="cat-train-item"><strong>Теоретска настава</strong>
                        <p>20 наставни часа теорија во училница, пет дена, плус пробен тест.</p>
                    </div>
                    <div class="cat-train-item"><strong>Практична настава</strong>
                        <p>Практична обука на автоматски автомобил.</p>
                    </div>
                    <div class="cat-train-item"><strong>Возачки испит</strong>
                        <p>Од 25 до 40 минути градска.</p>
                    </div>
                </div>
                <h2>Возачки испит</h2>
                <ul class="cat-exam">
                    <li>Тестот за Б има 31 прашање. Фонд: 621 прашање.</li>
                    <li>Полигон и градска според програмата за Б категорија.</li>
                </ul>
            </div>
            <aside class="cat-aside">
                <div class="cat-price">
                    <div class="label">Цена на обука</div>
                    <div class="amount">38.000 денари</div>
                    <p>Со автоматски менувач. Можност за рати. За финансирање: Билјана, 070-363-449.</p>
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
                        <a href="{{ route('category', 'b-automatik') }}" class="is-current" aria-current="page">Б
                            автоматик</a>
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
                <div class="cta-text">
                    <h2>Спремни за Б автоматик?</h2>
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
