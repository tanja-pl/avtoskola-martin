@extends('layouts.app')
@section('title', 'Контакт — Автошкола Мартин')
@section('description', 'Контактирајте ја Автошкола Мартин во Скопје. Телефон: 02-3114-065 / 071-251-259. Адреса: 11 Октомври бр. 17.')
@section('nav', 'contact')
@section('content')
<div class="page-hero">
  <div class="container page-hero-content">
    <div class="breadcrumb"><a href="{{ route('home') }}">Почетна</a><i class="fa-solid fa-chevron-right"></i><span>Контакт</span></div>
    <h1>Контактирајте нè</h1>
    <p>Имате прашање? Сакате да се запишете? Нашиот тим е тука за вас — јавете се, пишете ни или посетете не.</p>
  </div>
</div>

<section>
  <div class="container">
    <div class="contact-layout">
      <!-- Left: Info -->
      <div>
        <div class="section-tag">Информации</div>

        <div class="contact-info-block">
          <div class="contact-info-item reveal">
            <div class="contact-info-icon"><i class="fa-solid fa-location-dot"></i></div>
            <div class="contact-info-text">
              <h5>Адреса</h5>
              <p>ул. 11 Октомври бр. 17<br>Скопје, Северна Македонија</p>
              {{-- <a href="https://maps.app.goo.gl/KZuZ8rrhfrfQjYpA6" target="_blank" rel="noopener" style="color:var(--blue);font-weight:600;font-size:.85rem;display:inline-flex;align-items:center;gap:6px;margin-top:8px;">Отвори во Maps <i class="fa-solid fa-external-link"></i></a> --}}
            </div>
          </div>
          <div class="contact-info-item reveal">
            <div class="contact-info-icon"><i class="fa-solid fa-phone"></i></div>
            <div class="contact-info-text">
              <h5>Телефон</h5>
              <a href="tel:023114065">02-3114-065</a><br>
              <a href="tel:071251259">071-251-259 / 070-363-449</a>
            </div>
          </div>
          <div class="contact-info-item reveal">
            <div class="contact-info-icon"><i class="fa-solid fa-envelope"></i></div>
            <div class="contact-info-text">
              <h5>Е-пошта</h5>
              <a href="mailto:avtoskolamartin@hotmail.com">avtoskolamartin@hotmail.com</a>
            </div>
          </div>
          <div class="contact-info-item reveal">
            <div class="contact-info-icon"><i class="fa-regular fa-clock"></i></div>
            <div class="contact-info-text">
              <h5>Работно Време</h5>
              <p>Понеделник – Четврток: 09:00 – 17:00 <br>
                Петок: 09:00 – 16:30<br>Сабота: Затворено<br>Недела: Затворено</p>
            </div>
          </div>
        </div>

        <div class="section-tag" style="margin-top:40px;">Социјални Мрежи</div>
        <h3 style="margin-bottom:20px;">Следете не</h3>
        <div class="social-links-row">
          <a href="https://www.facebook.com/avtoskolamartin/?locale=mk_MK" target="_blank" class="social-link fb" style="width:48px;height:48px;" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="https://www.youtube.com/@%D0%B0%D0%B2%D1%82%D0%BE%D1%88%D0%BA%D0%BE%D0%BB%D0%B0%D0%9C%D0%B0%D1%80%D1%82%D0%B8%D0%BD" target="_blank" class="social-link yt" style="width:48px;height:48px;" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          <a href="https://www.instagram.com/avtoskolamartin/?hl=en" target="_blank" class="social-link ig" style="width:48px;height:48px;" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        </div>

        <!-- Map -->
        <div class="map-wrap" style="margin-top:40px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3073.486990823653!2d21.432204276211024!3d41.9922401712296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13541563f8f98b67%3A0x6a0f1ba9796e19ae!2sAvtoskola%20Martin!5e1!3m2!1sen!2smk!4v1793610409080!5m2!1sen!2smk" width="600" height="450" style="border:0;" allowfullscreen="" referrerpolicy="strict-origin-when-cross-origin"></iframe>

        </div>
      </div>

      <!-- Right: Form -->
      <div class="contact-form-wrap reveal">
        <h3>Испратете порака</h3>
        <p>Пополнете ја формата и ние ќе ве контактираме во рок од 24 часа.</p>
        <form id="contactForm" method="post" action="{{ route('contact.store') }}" novalidate>
          @csrf
          <div class="form-hp" aria-hidden="true">
            <label for="cWebsite">Website</label>
            <input type="text" id="cWebsite" name="website" tabindex="-1" autocomplete="off">
          </div>
          <div class="form-row">
            <div class="form-group"><label for="cName">Име и презиме <span style="color:#FDDE1F;">*</span></label><input type="text" id="cName" name="name" placeholder="Вашето полно име" required></div>
            <div class="form-group"><label for="cPhone">Телефон <span style="color:#FDDE1F;">*</span></label><input type="tel" id="cPhone" name="phone" placeholder="+389 7X XXX XXX" required></div>
          </div>
          <div class="form-group"><label for="cEmail">Е-пошта</label><input type="email" id="cEmail" name="email" placeholder="vasa@email.com"></div>
          <div class="form-group">
            <label for="cSubject">Предмет</label>
            <select id="cSubject" name="subject">
              <option value="">Изберете предмет</option>
              <option>Запишување / Регистрација</option>
              <option>Информации за категории</option>
              <option>Ценовник и плаќање</option>
              <option>Е-Тест</option>
              <option>Друго прашање</option>
            </select>
          </div>
          <div class="form-group"><label for="cMsg">Порака <span style="color:#FDDE1F;">*</span></label><textarea id="cMsg" name="message" rows="5" placeholder="Вашето прашање или барање..." required></textarea></div>
          <div class="form-group" style="margin-bottom:28px;">
            <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;">
              <input type="checkbox" required style="width:18px;height:18px;margin-top:2px;accent-color:var(--blue);">
              <span style="font-size:.875rem;color:var(--mid);">Се согласувам со обработката на личните податоци.</span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary btn-lg" style="width:100%;justify-content:center;"><i class="fa-solid fa-paper-plane"></i> Испрати Порака</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Quick contact bar -->
<div style="background:var(--dark);padding:48px 0;">
  <div class="container">
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:32px;text-align:center;">
      <div><div style="width:52px;height:52px;background:rgba(204,0,0,.2);border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.3rem;color:#FDDE1F;"><i class="fa-solid fa-phone"></i></div><div style="color:rgba(255,255,255,.5);font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;">Канцеларија</div><a href="tel:023114065" style="color:#fff;font-weight:700;font-size:1.1rem;">02-3114-065</a></div>
      <div><div style="width:52px;height:52px;background:rgba(204,0,0,.2);border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.3rem;color:#FDDE1F;"><i class="fa-solid fa-mobile-screen"></i></div><div style="color:rgba(255,255,255,.5);font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;">Мобилен</div><a href="tel:071251259" style="color:#fff;font-weight:700;font-size:1.1rem;">071-251-259 <br> 070-363-449</a></div>
      <div><div style="width:52px;height:52px;background:rgba(204,0,0,.2);border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.3rem;color:#FDDE1F;"><i class="fa-solid fa-envelope"></i></div><div style="color:rgba(255,255,255,.5);font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;">Е-пошта</div><a href="mailto:avtoskolamartin@hotmail.com" style="color:#fff;font-weight:700;font-size:.95rem;">avtoskolamartin@hotmail.com</a></div>
      <div><div style="width:52px;height:52px;background:rgba(204,0,0,.2);border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.3rem;color:#FDDE1F;"><i class="fa-solid fa-location-dot"></i></div><div style="color:rgba(255,255,255,.5);font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;">Адреса</div><span style="color:#fff;font-weight:700;font-size:.95rem;">11 Октомври бр. 17, Скопје</span></div>
    </div>
  </div>
</div>
@endsection
