@extends('layouts.app')
@section('title', 'Категорија A2 — Автошкола Мартин')
@section('description', 'Категорија A2 во Автошкола Мартин: услови, возила, обука и испит.')
@section('nav', 'categories')
@section('content')
    <div class="page-hero">
        <div class="container page-hero-content">
            <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><a
                    href="{{ route('categories') }}">Категории</a><i class="fa-solid fa-chevron-right"></i><span>Категорија
                    A2</span></div>
            <h1>Категорија A2 — средна класа мотоцикл</h1>
            <p>Обука за A2 со Kawasaki Z500 и CF Moto 400.</p>
        </div>
    </div>
    <section>
        <div class="container cat-page">
            <div class="cat-page-main">
                <p class="cat-lead">Категорија A2 е за мотоцикли со ограничена снага, средна класа.</p>
                <h2>Услови и потребни документи</h2>
                <div class="cat-req-grid">
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>лична карта / пасош</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>лекарско уверение за „A2“ категорија</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>навршени 18 години</div>
                    <div class="cat-req-item"><i class="fa-solid fa-check"></i>завршено најмалку основно образование</div>
                </div>
                <h2>Возило за обука и полагање</h2>
                <div class="cat-vehicles">
                    <article class="cat-vehicle"><img
                            src="https://wmk-ci.xsoftstatic.com/Write/07379/Images/z500-550x700.png"
                            alt="KAWASAKI Z500, 2025" loading="lazy" onerror="this.style.display='none'">
                        <div class="cat-vehicle-body">
                            <h3>KAWASAKI Z500, 2025</h3>
                            <p>Мотор 500 ccm и 33 kW, погоден за практичниот дел и полигонските вежби.</p>
                        </div>
                    </article>
                    <article class="cat-vehicle"><img
                            src="https://wmk-ci.xsoftstatic.com/Write/07379/Images/zaedno-550x700.png"
                            alt="CF MOTO 400, 2022" loading="lazy" onerror="this.style.display='none'">
                        <div class="cat-vehicle-body">
                            <h3>CF MOTO 400, 2022</h3>
                            <p>Мотор 400 ccm и 29 kW за совладување на практичниот дел.</p>
                        </div>
                    </article>
                </div>
                <h2>Инструктори</h2>
                <div class="cat-people">
                    <article class="cat-person"><img src="{{ asset('images/instructors/martin1.png') }}"
                            alt="Мартин Трајановски" loading="lazy" onerror="this.style.display='none'">
                        <h3>Мартин Трајановски</h3>
                        <p>Инструктор за A, A2, Б, Ц, ЦE и Д</p>
                    </article>
                    <article class="cat-person"><img src="{{ asset('images/instructors/stefan.png') }}"
                            alt="Стефан Трајановски" loading="lazy" onerror="this.style.display='none'">
                        <h3>Стефан Трајановски</h3>
                        <p>Инструктор за A, A2, Б, Ц, ЦE и Д</p>
                    </article>
                    <article class="cat-person"><img src="{{ asset('images/instructors/miki.png') }}" alt="Мики Трајановски"
                            loading="lazy" onerror="this.style.display='none'">
                        <h3>Мики Трајановски</h3>
                        <p>Инструктор за A, A1, A2, Б</p>
                    </article>
                </div>
                <h2>Обука</h2>
                <p>Оспособувањето се состои од теоретска и практична настава.</p>
                <div class="cat-train">
                    <div class="cat-train-item"><strong>Теоретска настава</strong>
                        <p>4 наставни часа ако кандидатот има Б категорија. Се одржува во училница, еден ден со Б
                            категорија.</p>
                    </div>
                    <div class="cat-train-item"><strong>Практична настава</strong>
                        <p>16 наставни часа, по два часа дневно, вкупно осум дена.</p>
                    </div>
                    <div class="cat-train-item"><strong>Возачки испит</strong>
                        <p>Од 25 до 40 минути градска.</p>
                    </div>
                </div>
                <h2>Возачки испит</h2>
                <ul class="cat-exam">
                    <li>Со Б категорија не се полага теоретски дел, туку само практичен.</li>
                    <li>Тестот има 28 прашања. Фонд: 553 прашања.</li>
                    <li>Полигон: две вежби.</li>
                    <li>Градска: паркинг кај поликлиника Јане Сандански (Аеродром).</li>
                </ul>
            </div>
            <aside class="cat-aside">
                <div class="cat-price">
                    <div class="label">Цена на обука</div>
                    <div class="amount">24.000 / 26.000 денари</div>
                    <p>Можност за плаќање на рати. За финансирање: Мартин, 071-251-259.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline"
                        style="width:100%;justify-content:center;margin-top:10px;">Контакт</a>
                </div>
                <div class="cat-aside-card">
                    <h3>Други категории</h3>
                    <div class="cat-aside-links">
                        <a href="{{ route('category', 'a-kategorija') }}">A — мотоцикл</a>
                        <a href="{{ route('category', 'a2-kategorija') }}" class="is-current" aria-current="page">A2 —
                            средна класа</a>
                        <a href="{{ route('category', 'a1-kategorija') }}">A1 — лесен мотоцикл</a>
                        <a href="{{ route('category', 'am-kategorija') }}">AM — мопед</a>
                        <a href="{{ route('category', 'b-kategorija') }}">Б — автомобил</a>
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
                    <h2>Спремни за Категорија A2?</h2>
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
