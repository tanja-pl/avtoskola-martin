@extends('layouts.app')
@section('title', 'Категории — Автошкола Мартин')
@section('description', 'Сите возачки категории: AM, A1, A2, A, B, B-auto, BE, C, CE, D. Запишете се во Автошкола Мартин Скопје.')
@section('nav', 'categories')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Категории</span></div>
    <h1>Возачки Категории</h1>
    <p>Отворете ја категоријата за услови, возила и обука.</p>
  </div>
</div>

<section>
  <div class="container">
    <!-- Motorcycles -->
    <div class="section-tag">Мотоцикли</div>
    <h2 class="section-heading" style="margin-bottom:32px;">Категории A</h2>
    <div class="cat-detail-grid" style="margin-bottom:64px;">
      <div class="cat-detail-card reveal">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-motorcycle" style="color:#FDDE1F;"></i></div>
          <div><h3>AM</h3><p>Мопед до 50cc</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија AM дозволува управување со мопеди и лесни моторни велосипеди со максимална брзина до 45 km/h.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 16 години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски испит (Е-Тест)</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Само теоретска обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'am-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-1">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-motorcycle" style="color:#FDDE1F;"></i></div>
          <div><h3>A1</h3><p>Лесен мотоцикл до 125cc</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија A1 е наменета за мотоцикли до 125cc и максимална снага до 11 kW (15 KS).</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 16 години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски испит (Е-Тест)</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Практична обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'a1-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-2">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-motorcycle" style="color:#FDDE1F;"></i></div>
          <div><h3>A2</h3><p>Средна класа мотоцикл до 35kW</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија A2 овозможува управување со мотоцикли до 35 kW (47 KS) и однос снага/тежина до 0.2 kW/kg.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 18 години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски испит (Е-Тест)</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Практична обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'a2-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-3">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-motorcycle" style="color:#FDDE1F;"></i></div>
          <div><h3>A</h3><p>Мотоцикл без ограничување</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија A е највисоката мотоциклска категорија, без ограничување на снагата на мотоциклот.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 23 години и 6 месеци</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски испит (Е-Тест)</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Практична обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'a-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Cars -->
    <div class="section-tag">Автомобили</div>
    <h2 class="section-heading" style="margin-bottom:32px;">Категории Б</h2>
    <div class="cat-detail-grid" style="margin-bottom:64px;">
      <div class="cat-detail-card reveal">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-car" style="color:#FDDE1F;"></i></div>
          <div><h3>Б</h3><p>Патнички автомобил</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Најпопуларната категорија. Дозволува управување со патнички автомобили до 3.500 kg со рачен менувач.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 18 години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски испит (Е-Тест)</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>36 наставни часа практична обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'b-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-1">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-car" style="color:#FDDE1F;"></i></div>
          <div><h3>Б — Автоматски</h3><p>Автоматски менувач</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Обука за управување со автомобили со автоматски менувач, идеално за почетници и за луѓе кои претпочитаат поедноставно возење.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 18 години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски испит (Е-Тест)</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Практична обука на автоматски автомобил</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'b-automatik') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-2">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-truck-pickup" style="color:#FDDE1F;"></i></div>
          <div><h3>БE</h3><p>Автомобил со приколка</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија БE дозволува управување со автомобил (Б) во комбинација со приколка чија тежина надминува 750 kg.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Поседување на категорија B</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 18 години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Специјализирана практична обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'be-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Trucks & Buses -->
    <div class="section-tag">Камиони и Автобуси</div>
    <h2 class="section-heading" style="margin-bottom:32px;">Категории Ц и Д</h2>
    <div class="cat-detail-grid" style="margin-bottom:64px;">
      <div class="cat-detail-card reveal">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-truck" style="color:#FDDE1F;"></i></div>
          <div><h3>Ц</h3><p>Камион</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија Ц дозволува управување со товарни моторни возила со максимална маса над 3.500 kg.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Категорија Б најмалку една година</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 20 години и 6 месеци</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски и практичен испит</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Специјален лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'c-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-1">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-truck-moving" style="color:#FDDE1F;"></i></div>
          <div><h3>ЦЕ</h3><p>Камион со приколка</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија ЦЕ дозволува управување со влечач (категорија Ц) поврзан со приколка — за тешки товарни комбинации.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Поседување на категорија Ц</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 21 година</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Напредна практична обука</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Специјален лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'ce-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
      <div class="cat-detail-card reveal reveal-delay-2">
        <div class="cat-detail-header">
          <div class="cat-detail-icon-wrap"><i class="fa-solid fa-bus" style="color:#FDDE1F;"></i></div>
          <div><h3>Д</h3><p>Автобус</p></div>
        </div>
        <div class="cat-detail-body">
          <p>Категорија Д е наменета за управување со автобуси со повеќе од 8 седишта, вклучувајќи јавен и приватен превоз.</p>
          <div class="cat-reqs">
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Категорија Ц најмалку две години</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Минимална возраст: 23 години и 6 месеци</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Теоретски и практичен испит</div>
            <div class="cat-req-item"><i class="fa-solid fa-check"></i>Специјален лекарски преглед</div>
          </div>
          <div class="cat-actions">
            <a href="{{ route('category', 'd-kategorija') }}" class="btn btn-primary" style="width:100%;justify-content:center;">Повеќе информации</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text"><h2>Не знаете која категорија?<br>Ние ќе ви помогнеме!</h2><p>Контактирајте не и ќе ви дадеме бесплатен совет за вашата идеална категорија.</p></div>
      <div class="cta-actions"><a href="{{ route('contact') }}" class="btn btn-yellow btn-lg"><i class="fa-solid fa-phone"></i> Контактирај нè</a></div>
    </div>
  </div>
</div>
@endsection
