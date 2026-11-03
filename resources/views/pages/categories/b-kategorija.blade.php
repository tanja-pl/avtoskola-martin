@extends('layouts.app')
@section('title', 'Категорија B — Автошкола Мартин')
@section('description', 'Категорија B во Автошкола Мартин Скопје — автомобил, услови и цена.')
@section('nav', 'categories')
@section('content')
    <div class="page-hero">
        <div class="container page-hero-content">
            <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a
                    href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>Категорија
                    B</span></div>
            <h1>Категорија Б — патнички автомобил</h1>
            <p>Обука за Б категорија: услови, возила, инструктори, теорија, практика и испит.</p>
        </div>
    </div>
    <section>
        <div class="container cat-page">
            <div class="cat-page-main">
                <p class="cat-lead">Најпопуларната категорија. Патнички автомобил со рачен менувач — Peugeot, Citroen, Fiat,
                    Opel, Renault. Возилата се со серво волан, клима и ABS.</p>
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
                <div class="cat-fleet-thumbs">
                    @foreach ([
                        ['b-1.png', 'Citroën C3'],
                        ['b-2.png', 'Peugeot 208'],
                        ['b-3.png', 'Peugeot 208'],
                        ['b-4.png', 'Citroën C3'],
                        ['b-5.png', 'Citroën C3'],
                        ['b-6.png', 'Renault Clio'],
                        ['b-7.png', 'Renault Clio'],
                        ['b-8.png', 'Renault Clio'],
                    ] as [$file, $name])
                        <button type="button" class="cat-fleet-thumb"
                            data-full="{{ asset('images/vehicles/'.$file) }}"
                            data-caption="{{ $name }}">
                            <img src="{{ asset('images/vehicles/'.$file) }}" alt="{{ $name }} — Автошкола Мартин" loading="lazy">
                            <span>{{ $name }}</span>
                        </button>
                    @endforeach
                </div>
                <dialog class="cat-lightbox" id="fleetLightbox" aria-label="Возило за обука">
                    <div class="cat-lightbox-bar">
                        <p></p>
                        <form method="dialog">
                            <button class="cat-lightbox-close" aria-label="Затвори"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <img alt="">
                </dialog>
                <h2>Инструктори</h2>
                <div class="cat-people is-visible">
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/stefan.png') }}" alt="Стефан Трајановски" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Стефан Трајановски</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/miki.png') }}" alt="Мики Трајановски" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Мики Трајановски</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/ljupco.png') }}" alt="Љупчо Костенцовски" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Љупчо Костенцовски</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/martin1.png') }}" alt="Мартин Трајановски" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Мартин Трајановски</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/igor.png') }}" alt="Игор Вичишки" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Игор Вичишки</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/zoki.png') }}" alt="Зоран Крстевски" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Зоран Крстевски</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/sase.jpg') }}" alt="Сашо Тодоровски" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Сашо Тодоровски</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/martina.jpg') }}" alt="Мартина Крстевска" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Мартина Крстевска</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person">
                        <img src="{{ asset('images/instructors/cece.jpg') }}" alt="Светлана Спасовска" loading="lazy"
                            onerror="this.style.display='none'">
                        <h3>Светлана Спасовска</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person"><img src="{{ asset('images/instructors/bube.jpg') }}" alt="Љупка Илијоска"
                            loading="lazy" onerror="this.style.display='none'">
                        <h3>Љупка Илијоска</h3>
                        <p>Инструктор</p>
                    </article>
                    <article class="cat-person"><img src="{{ asset('images/instructors/liljana.jpg') }}" alt="Лилјана Тодорова"
                          loading="lazy" onerror="this.style.display='none'">
                      <h3>Лилјана Тодорова</h3>
                      <p>Инструктор</p>
                  </article>
                </div>
                <h2>Обука</h2>
                <p>Оспособувањето се состои од теоретска и практична настава.</p>
                <div class="cat-train">
                    <div class="cat-train-item"><strong>Теоретска настава</strong>
                        <p>20 наставни часа во училница, вкупно пет дена. По теоријата се полага пробен тест.</p>
                    </div>
                    <div class="cat-train-item"><strong>Практична настава</strong>
                        <p>36 наставни часа, по 2 часа дневно, вкупно 18 дена.</p>
                    </div>
                    <div class="cat-train-item"><strong>Возачки испит</strong>
                        <p>Од 25 до 40 минути градска.</p>
                    </div>
                </div>
                <h2>Возачки испит</h2>
                <ul class="cat-exam">
                    <li>Тестот за B има 31 прашање. Фонд: 621 прашање.</li>
                    <li>Полигон: четири вежби.</li>
                    <li>Градска започнува од паркинг просторите пред Железничка станица, хотел Русија, поликлиника Јане
                        Сандански, Зоолошка градина (Центар) и сала Борис Трајковски (Карпош).
                    </li>
                </ul>
                <p><a href="{{ route('etest') }}" class="btn btn-outline-dark">Подготовка за Е-Тест</a></p>
            </div>
            <aside class="cat-aside">
                <div class="cat-price">
                    <div class="label">Цена на обука</div>
                    <div class="amount">32.000 денари</div>
                    <p>Можност за плаќање на рати. Автоматски менувач: 38.000 денари. За финансирање: Билјана, 070-363-449.
                    </p>
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
                        <a href="{{ route('category', 'b-kategorija') }}" class="is-current" aria-current="page">Б
                            автомобил</a>
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
                <div class="cta-text">
                    <h2>Спремни за Категорија Б?</h2>
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
