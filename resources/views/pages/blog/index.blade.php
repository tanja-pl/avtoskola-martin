@extends('layouts.app')
@section('title', 'Блог — Автошкола Мартин')
@section('description', 'Статии од Автошкола Мартин: обука, испит, сообраќајни правила и совети за возачи.')
@section('nav', 'blog')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Блог</span></div>
    <h1>Блог статии</h1>
    <p>Совети, новости и објаснувања од Автошкола Мартин — обука, испит и безбедност во сообраќајот.</p>
  </div>
</div>
<section>
  <div class="container">
    <div class="blog-filters" id="blogFilters"><button type="button" class="blog-filter is-active" data-filter="all">Сите</button><button type="button" class="blog-filter" data-filter="informator">Сообраќаен информатор <span>5</span></button><button type="button" class="blog-filter" data-filter="martin">Автошкола Мартин <span>6</span></button><button type="button" class="blog-filter" data-filter="situacii">Сообраќајни ситуации <span>2</span></button><button type="button" class="blog-filter" data-filter="zakon">Законски одредби <span>2</span></button><button type="button" class="blog-filter" data-filter="greshki">Најчести грешки за време на полагање <span>3</span></button><button type="button" class="blog-filter" data-filter="a-kat">А и А2 категорија <span>4</span></button></div>
    <div class="blog-layout">
      <div>
        
        <article class="blog-card reveal blog-card-featured" data-cats="">
          <a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}" class="blog-thumb"><img src="{{ asset('images/blog/potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete.jpg') }}" alt="Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 12.06.2026</span></div>
            <h3><a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}">Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?</a></h3>
            <p>Одлична вест за сите возачи кои поседуваат Б категорија!</p>
            <a href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <div class="blog-grid blog-grid-2" id="blogGrid">
          
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}" class="blog-thumb"><img src="{{ asset('images/blog/kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija.png') }}" alt="Како да ја добиете возачката дозвола за мотор во Македонија?"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 02.06.2026</span></div>
            <h3><a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}">Како да ја добиете возачката дозвола за мотор во Македонија?</a></h3>
            <p>Доколку размислувате да станете моторџија, првиот чекор е стекнување на соодветна возачка дозвола. Во продолжение ќе објасниме како изгледа процесот за добивање возачка дозвола за мотор во Македонија.</p>
            <a href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}" class="blog-thumb"><img src="{{ asset('images/blog/5-soveti-za-uspeshno-polaganje-na-vozachki-ispit.jpg') }}" alt="5 совети за успешно полагање на возачки испит"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 04.03.2026</span></div>
            <h3><a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}">5 совети за успешно полагање на возачки испит</a></h3>
            <p>Полагањето на возачки испит е важен момент за секој млад возач. Нервозата е нормална, но со добра подготовка шансите за успех значително се зголемуват. Еве 5 практични совети кои ќе ви помогнат да го положите испитот на…</p>
            <a href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}" class="blog-thumb"><img src="{{ asset('images/blog/subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija.png') }}" alt="Субвенции на млади лица од општина Центар за обука за Б категорија"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 01.02.2026</span></div>
            <h3><a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}">Субвенции на млади лица од општина Центар за обука за Б категорија</a></h3>
            <p>Општина Центар информира дека распиша Јавен повик за доделување субвенции на младите жители на општината за полагање на возачки испит Б-категорија во автошколи регистрирани на подрачјето на Центар. Овој повик е отворен н…</p>
            <a href="{{ route('blog.show', 'subvencii-na-mladi-lica-od-opshtina-centar-za-obuka-za-b-kategorija') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="informator greshki">
          <a href="{{ route('blog.show', 'koja-e-odgovornosta-na-vozachite-i-peshacite-koi-greshki-gi-pravat-vo-soobrakjajot') }}" class="blog-thumb"><img src="{{ asset('images/blog/koja-e-odgovornosta-na-vozachite-i-peshacite-koi-greshki-gi-pravat-vo-.png') }}" alt="Која е одговорноста на возачите и пешаците, кои грешки ги прават во сообраќајот?"><span class="blog-tag">Сообраќаен информатор</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 11.05.2022</span></div>
            <h3><a href="{{ route('blog.show', 'koja-e-odgovornosta-na-vozachite-i-peshacite-koi-greshki-gi-pravat-vo-soobrakjajot') }}">Која е одговорноста на возачите и пешаците, кои грешки ги прават во сообраќајот?</a></h3>
            <p>Една од најчестите причини кај кандидатите, за паѓање на возачкиот испит, се пешаците !</p>
            <a href="{{ route('blog.show', 'koja-e-odgovornosta-na-vozachite-i-peshacite-koi-greshki-gi-pravat-vo-soobrakjajot') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="martin a-kat">
          <a href="{{ route('blog.show', 'obuka-za-a1-a2-i-a-kategorija-shto-da-ochekuvate-od-obukata-i-instruktorot-') }}" class="blog-thumb"><img src="{{ asset('images/blog/obuka-za-a1-a2-i-a-kategorija-shto-da-ochekuvate-od-obukata-i-instrukt.png') }}" alt="Обука за А1, А2 и А категорија. Што да очекувате од обуката и инструкторот !"><span class="blog-tag">Автошкола Мартин</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 12.04.2022</span></div>
            <h3><a href="{{ route('blog.show', 'obuka-za-a1-a2-i-a-kategorija-shto-da-ochekuvate-od-obukata-i-instruktorot-') }}">Обука за А1, А2 и А категорија. Што да очекувате од обуката и инструкторот !</a></h3>
            <p>Практичната обука за „А1“, „А2“ и „А“ категорија се состои од 16 наставни часа. Наставниот план и програма за спроведување на обуката, предвидува најмалку четири наставни часа на автодром-полигон и 12 наставни часа на пат надвор и во населено место. Спроведувањето на практичната обука се изведува од страна на возач-инструктор.</p>
            <a href="{{ route('blog.show', 'obuka-za-a1-a2-i-a-kategorija-shto-da-ochekuvate-od-obukata-i-instruktorot-') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="martin">
          <a href="{{ route('blog.show', 'uloga-i-znachenje-na-teoretskata-nastava-zoshto-e-bitna-za-kandidatite-za-vozachi-') }}" class="blog-thumb"><img src="{{ asset('images/blog/uloga-i-znachenje-na-teoretskata-nastava-zoshto-e-bitna-za-kandidatite.png') }}" alt="Улога и значење на теоретската настава. Зошто е битна за кандидатите за возачи !"><span class="blog-tag">Автошкола Мартин</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 07.04.2022</span></div>
            <h3><a href="{{ route('blog.show', 'uloga-i-znachenje-na-teoretskata-nastava-zoshto-e-bitna-za-kandidatite-za-vozachi-') }}">Улога и значење на теоретската настава. Зошто е битна за кандидатите за возачи !</a></h3>
            <p>Оспособувањето на кандидат за возач е наставен процес, кој задолжително се спроведува според Наставен план и програма за обука на кандидати за возачи. Според Законот за безбедност во патниот сообраќај, обуката за секој кандидат за возач е задолжителна.</p>
            <a href="{{ route('blog.show', 'uloga-i-znachenje-na-teoretskata-nastava-zoshto-e-bitna-za-kandidatite-za-vozachi-') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="martin">
          <a href="{{ route('blog.show', 'obuka-za-am-kategorija-vo-avtoshkola-martin') }}" class="blog-thumb"><img src="{{ asset('images/blog/obuka-za-am-kategorija.png') }}" alt="Обука за АМ категорија во автошкола Мартин"><span class="blog-tag">Автошкола Мартин</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 16.02.2022</span></div>
            <h3><a href="{{ route('blog.show', 'obuka-za-am-kategorija-vo-avtoshkola-martin') }}">Обука за АМ категорија во автошкола Мартин</a></h3>
            <p>Во категорија „АМ“ спаѓаат мопеди, мотокултиватор, односно возила на две или три тркала со максимална брзина која не надминува 45 km/h и лесни четирицикли.</p>
            <a href="{{ route('blog.show', 'obuka-za-am-kategorija-vo-avtoshkola-martin') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="">
          <a href="{{ route('blog.show', 'avto-shkola-martin-ima-potreba-od-vozach-instruktor-za-b-kategorija') }}" class="blog-thumb"><img src="{{ asset('images/blog/avto-shkola-martin-ima-potreba-od-vozach-instruktor-za-b-kategorija.jpg') }}" alt="Авто школа Мартин има потреба од возач-инструктор за &quot;Б&quot; категорија"><span class="blog-tag">Блог</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 29.12.2021</span></div>
            <h3><a href="{{ route('blog.show', 'avto-shkola-martin-ima-potreba-od-vozach-instruktor-za-b-kategorija') }}">Авто школа Мартин има потреба од возач-инструктор за &quot;Б&quot; категорија</a></h3>
            <p>Авто школа Мартин ја завршува 2021 година со вработување на нов инструктор за &quot;Б&quot; категорија</p>
            <a href="{{ route('blog.show', 'avto-shkola-martin-ima-potreba-od-vozach-instruktor-za-b-kategorija') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="martin">
          <a href="{{ route('blog.show', 'ushte-edno-vozilo-za-obuka-za-b-kategorija-') }}" class="blog-thumb"><img src="{{ asset('images/blog/ushte-edno-vozilo-za-obuka-za-b-kategorija.png') }}" alt="Уште едно возило за обука за „Б“ категорија !"><span class="blog-tag">Автошкола Мартин</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 20.11.2020</span></div>
            <h3><a href="{{ route('blog.show', 'ushte-edno-vozilo-za-obuka-za-b-kategorija-') }}">Уште едно возило за обука за „Б“ категорија !</a></h3>
            <p>Возниот парк го зголемивме со уште едно возило од марката Рено. Станува збор за Рено Клио кое е едно од најдобрите возила за обука на кандидати за возачи.</p>
            <a href="{{ route('blog.show', 'ushte-edno-vozilo-za-obuka-za-b-kategorija-') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="situacii greshki a-kat">
          <a href="{{ route('blog.show', 'najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje') }}" class="blog-thumb"><img src="{{ asset('images/blog/obikoluvanje-so-logo.png') }}" alt="Најчести грешки за време на полагање 2 (Обиколување)"><span class="blog-tag">Сообраќајни ситуации</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 14.11.2020</span></div>
            <h3><a href="{{ route('blog.show', 'najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje') }}">Најчести грешки за време на полагање 2 (Обиколување)</a></h3>
            <p>Обиколување е возење покрај запрено или паркирано возило или друг објект што се наоѓа на сообраќајната лента по која се движи возилото</p>
            <a href="{{ route('blog.show', 'najchesti-greshki-za-vreme-na-polaganje-2-obikoluvanje') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="martin zakon">
          <a href="{{ route('blog.show', 'uspeshno-polozheni-zadolzhitelni-licenci-na-site-instruktori') }}" class="blog-thumb"><img src="{{ asset('images/blog/uspeshno-polozheni-zadolzhitelni-licenci-na-site-instruktori.png') }}" alt="Успешно положени задолжителни лиценци на сите инструктори"><span class="blog-tag">Автошкола Мартин</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 21.10.2020</span></div>
            <h3><a href="{{ route('blog.show', 'uspeshno-polozheni-zadolzhitelni-licenci-na-site-instruktori') }}">Успешно положени задолжителни лиценци на сите инструктори</a></h3>
            <p>Автошкола Мартин може да се пофали со успешно положени задолжителни лиценци на сите инструктори.</p>
            <a href="{{ route('blog.show', 'uspeshno-polozheni-zadolzhitelni-licenci-na-site-instruktori') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="martin">
          <a href="{{ route('blog.show', 'povtorno-otvoreni-po-povekjenedelna-pauza-poradi-pandemijata-na-koronavirus') }}" class="blog-thumb"><img src="{{ asset('images/blog/povtorno-otvoreni-po-povekjenedelna-pauza-poradi-pandemijata-na-korona.png') }}" alt="Повторно отворени по повеќенеделна пауза поради пандемијата на коронавирус"><span class="blog-tag">Автошкола Мартин</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 18.05.2020</span></div>
            <h3><a href="{{ route('blog.show', 'povtorno-otvoreni-po-povekjenedelna-pauza-poradi-pandemijata-na-koronavirus') }}">Повторно отворени по повеќенеделна пауза поради пандемијата на коронавирус</a></h3>
            <p>Со задоволство сакаме да ве информираме дека Автошкола Мартин согласно одлуката за попуштање на мерките за заштита од коронавирус започна со работа.</p>
            <a href="{{ route('blog.show', 'povtorno-otvoreni-po-povekjenedelna-pauza-poradi-pandemijata-na-koronavirus') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="greshki a-kat">
          <a href="{{ route('blog.show', 'najchesti-greshki-za-vreme-na-polaganje-1-svrtuvanje-nadesno-na-dopolnitelen-semafor') }}" class="blog-thumb"><img src="{{ asset('images/blog/najchesti-greshki-za-vreme-na-polaganje-1-svrtuvanje-nadesno-na-dopoln.png') }}" alt="Најчести грешки за време на полагање 1 (Свртување надесно на дополнителен семафор)"><span class="blog-tag">Најчести грешки за време на полагање</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 28.02.2020</span></div>
            <h3><a href="{{ route('blog.show', 'najchesti-greshki-za-vreme-na-polaganje-1-svrtuvanje-nadesno-na-dopolnitelen-semafor') }}">Најчести грешки за време на полагање 1 (Свртување надесно на дополнителен семафор)</a></h3>
            <p>Свртување надесно на дополнителен семафор</p>
            <a href="{{ route('blog.show', 'najchesti-greshki-za-vreme-na-polaganje-1-svrtuvanje-nadesno-na-dopolnitelen-semafor') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="zakon">
          <a href="{{ route('blog.show', 'dali-gi-znaete-kaznenite-odredbi-za-pobrzo-vozenje') }}" class="blog-thumb"><img src="{{ asset('images/blog/dali-gi-znaete-kaznenite-odredbi-za-pobrzo-vozenje.png') }}" alt="Дали ги знаете казнените одредби за побрзо возење?"><span class="blog-tag">Законски одредби</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 22.05.2019</span></div>
            <h3><a href="{{ route('blog.show', 'dali-gi-znaete-kaznenite-odredbi-za-pobrzo-vozenje') }}">Дали ги знаете казнените одредби за побрзо возење?</a></h3>
            <p>Еден од основните услови за безбедно управување со возилото на пат е да ја прилагодите брзината на движење кон условите на сообраќајот:</p>
            <a href="{{ route('blog.show', 'dali-gi-znaete-kaznenite-odredbi-za-pobrzo-vozenje') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="informator">
          <a href="{{ route('blog.show', 'zoshto-rasporedot-na-boite-na-semaforot-e-standarden-vo-site-zemji-crveno-zholto-zeleno-') }}" class="blog-thumb"><img src="{{ asset('images/blog/zoshto-rasporedot-na-boite-na-semaforot-e-standarden-vo-site-zemji-crv.png') }}" alt="Зошто распоредот на боите на семафорот е стандарден во сите земји, црвено, жолто, зелено ?"><span class="blog-tag">Сообраќаен информатор</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 30.01.2019</span></div>
            <h3><a href="{{ route('blog.show', 'zoshto-rasporedot-na-boite-na-semaforot-e-standarden-vo-site-zemji-crveno-zholto-zeleno-') }}">Зошто распоредот на боите на семафорот е стандарден во сите земји, црвено, жолто, зелено ?</a></h3>
            <p>На крстосница каде сообраќајот е регулиран со светлосни сообраќајни уреди, возачот е должен да постапува според светлосните знаци, кои се вклучуваат по пропишан редослед на семафорот.</p>
            <a href="{{ route('blog.show', 'zoshto-rasporedot-na-boite-na-semaforot-e-standarden-vo-site-zemji-crveno-zholto-zeleno-') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="situacii a-kat">
          <a href="{{ route('blog.show', 'podeleni-se-mislenjata-za-redosledot-na-minuvanje-dali-go-znaete-tochniot-odgovor') }}" class="blog-thumb"><img src="{{ asset('images/blog/podeleni-se-mislenjata-za-redosledot-na-minuvanje-dali-go-znaete-tochn.png') }}" alt="Поделени се мислењата за редоследот на минување, дали го знаете точниот одговор?"><span class="blog-tag">Сообраќајни ситуации</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 14.01.2019</span></div>
            <h3><a href="{{ route('blog.show', 'podeleni-se-mislenjata-za-redosledot-na-minuvanje-dali-go-znaete-tochniot-odgovor') }}">Поделени се мислењата за редоследот на минување, дали го знаете точниот одговор?</a></h3>
            <p>Крстосница е сообраќајна површина, на која се крстосуваат или соединуваат два или повеќе јавни патишта. Статистиката покажува дека, најмногу сообраќајни незгоди се случуваат токму на крстосниците.На сликата е прикажана крстосница, на која сообраќајот се одвива според поставените сообраќајни знаци.Размислете по кој редослед ќе поминат.</p>
            <a href="{{ route('blog.show', 'podeleni-se-mislenjata-za-redosledot-na-minuvanje-dali-go-znaete-tochniot-odgovor') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="informator">
          <a href="{{ route('blog.show', 'vozenje-po-sneg') }}" class="blog-thumb"><img src="{{ asset('images/blog/vozenje-po-sneg.png') }}" alt="Возење по снег"><span class="blog-tag">Сообраќаен информатор</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 09.01.2019</span></div>
            <h3><a href="{{ route('blog.show', 'vozenje-po-sneg') }}">Возење по снег</a></h3>
            <p>Под возење во зимски услови се подразбира возење по коловоз покриен со снег и во услови на снежни врнежи.</p>
            <a href="{{ route('blog.show', 'vozenje-po-sneg') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="informator">
          <a href="{{ route('blog.show', 'doznajte-shto-znachat-oznakite-na-gumite') }}" class="blog-thumb"><img src="{{ asset('images/blog/doznajte-shto-znachat-oznakite-na-gumite.png') }}" alt="Дознајте што значат ознаките на гумите?"><span class="blog-tag">Сообраќаен информатор</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 04.01.2019</span></div>
            <h3><a href="{{ route('blog.show', 'doznajte-shto-znachat-oznakite-na-gumite') }}">Дознајте што значат ознаките на гумите?</a></h3>
            <p>Секоја гума на страничниот дел има ознаки кои можат да ви кажат се за карактеристиките на гумите. Ако знаете која ознака што претставува, многу лесно можете да одредите која гума ви одговара, без дополнителни консултации со продавачот. Во следните примери ќе ги објасниме сите ознаки на страничниот дел на гумата.</p>
            <a href="{{ route('blog.show', 'doznajte-shto-znachat-oznakite-na-gumite') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="blog-card reveal" data-cats="informator">
          <a href="{{ route('blog.show', 'zoshto-ambulance-e-napishano-obratno-na-voziloto-na-brza-pomosh') }}" class="blog-thumb"><img src="{{ asset('images/blog/zoshto-ambulance-e-napishano-obratno-na-voziloto-na-brza-pomosh.jpg') }}" alt="Зошто „AMBULANCE“ е напишано обратно на возилото на брза помош?"><span class="blog-tag">Сообраќаен информатор</span></a>
          <div class="blog-body">
            <div class="blog-meta"><span><i class="fa-regular fa-calendar"></i> 20.12.2018</span></div>
            <h3><a href="{{ route('blog.show', 'zoshto-ambulance-e-napishano-obratno-na-voziloto-na-brza-pomosh') }}">Зошто „AMBULANCE“ е напишано обратно на возилото на брза помош?</a></h3>
            <p>Сигурно барем еднаш сте се запрашале зошто натписот „AMBULANCE„ на предната страна на возилото на брза помош е напишано обратно?</p>
            <a href="{{ route('blog.show', 'zoshto-ambulance-e-napishano-obratno-na-voziloto-na-brza-pomosh') }}" class="blog-link">Прочитај повеќе <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>
        </div>
        <p class="blog-empty" id="blogEmpty" hidden>Нема статии во оваа категорија.</p>
      </div>
      <aside class="blog-sidebar">
        <div class="sidebar-widget">
          <h4>Категории</h4>
          <ul class="sidebar-cat-list"><li><button type="button" class="sidebar-cat-item" data-filter="informator"><span>Сообраќаен информатор</span><span class="sidebar-cat-count">5</span></button></li><li><button type="button" class="sidebar-cat-item" data-filter="martin"><span>Автошкола Мартин</span><span class="sidebar-cat-count">6</span></button></li><li><button type="button" class="sidebar-cat-item" data-filter="situacii"><span>Сообраќајни ситуации</span><span class="sidebar-cat-count">2</span></button></li><li><button type="button" class="sidebar-cat-item" data-filter="zakon"><span>Законски одредби</span><span class="sidebar-cat-count">2</span></button></li><li><button type="button" class="sidebar-cat-item" data-filter="greshki"><span>Најчести грешки за време на полагање</span><span class="sidebar-cat-count">3</span></button></li><li><button type="button" class="sidebar-cat-item" data-filter="a-kat"><span>А и А2 категорија</span><span class="sidebar-cat-count">4</span></button></li></ul>
        </div>
        <div class="sidebar-widget">
          <h4>Најнови статии</h4>
          
          <a class="recent-post" href="{{ route('blog.show', 'potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete') }}">
            <div class="recent-thumb"><img src="{{ asset('images/blog/potvrda-za-motocikl-do-125cc-so-b-kategorija-shto-treba-da-znaete.jpg') }}" alt="Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?"></div>
            <div class="recent-info"><h5>Потврда за мотоцикл до 125cc со Б категорија – што треба да знаете?</h5><span>12.06.2026</span></div>
          </a>
          <a class="recent-post" href="{{ route('blog.show', 'kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija') }}">
            <div class="recent-thumb"><img src="{{ asset('images/blog/kako-da-ja-dobiete-vozachkata-dozvola-za-motor-vo-makedonija.png') }}" alt="Како да ја добиете возачката дозвола за мотор во Македонија?"></div>
            <div class="recent-info"><h5>Како да ја добиете возачката дозвола за мотор во Македонија?</h5><span>02.06.2026</span></div>
          </a>
          <a class="recent-post" href="{{ route('blog.show', '5-soveti-za-uspeshno-polaganje-na-vozachki-ispit') }}">
            <div class="recent-thumb"><img src="{{ asset('images/blog/5-soveti-za-uspeshno-polaganje-na-vozachki-ispit.jpg') }}" alt="5 совети за успешно полагање на возачки испит"></div>
            <div class="recent-info"><h5>5 совети за успешно полагање на возачки испит</h5><span>04.03.2026</span></div>
          </a>
        </div>
        <div class="sidebar-widget sidebar-cta">
          <h4>Запишете се</h4>
          <p>Готови за возачка дозвола? Јавете се или пишете ни.</p>
          <a href="{{ route('contact') }}" class="btn btn-yellow" style="width:100%;justify-content:center;">Контактирај нè</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<div class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text">
        <h2>Спремни за возачка?</h2>
        <p>Запишете се во Автошкола Мартин — обука, теорија и поддршка пред испит.</p>
      </div>
      <div class="cta-actions">
        <a href="{{ route('contact') }}" class="btn btn-outline btn-lg"><i class="fa-solid fa-phone"></i> Контакт</a>
      </div>
    </div>
  </div>
</div>
@endsection
