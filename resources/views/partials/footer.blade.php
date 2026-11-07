<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">
          <img src="{{ asset('images/logo.png') }}" class="footer-logo-img" alt="Автошкола Мартин">
        </div>
        <p>„Учете за живот, не за испит" — над 34 години искуство во Скопје.</p>
        <div class="footer-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3073.486990823653!2d21.432204276211024!3d41.9922401712296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13541563f8f98b67%3A0x6a0f1ba9796e19ae!2sAvtoskola%20Martin!5e1!3m2!1sen!2smk!4v1793610409080!5m2!1sen!2smk"
            title="Автошкола Мартин, ул. 11 Октомври бр. 17, Скопје"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen></iframe>
        </div>
        <div class="social-links-row">
          <a href="#" class="social-link fb" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="https://www.youtube.com/@автошколаМартин" class="social-link yt" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          <a href="#" class="social-link ig" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        </div>
      </div>
      <div>
        <div class="footer-heading">Брзи Врски</div>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Почетна</a></li>
          <li><a href="{{ route('categories') }}">Категории</a></li>
          <li><a href="{{ route('team') }}">Нашиот Тим</a></li>
          <li><a href="{{ route('etest') }}">Е-Тест</a></li>
          <li><a href="{{ route('videos') }}">Видеа</a></li>
          <li><a href="{{ route('blog') }}">Блог</a></li>
          <li><a href="{{ route('contact') }}">Контакт</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-heading">Категории</div>
        <ul class="footer-links">
          <li><a href="{{ route('category', 'a-kategorija') }}">Категорија A</a></li>
          <li><a href="{{ route('category', 'b-kategorija') }}">Категорија Б</a></li>
          <li><a href="{{ route('category', 'b-automatik') }}">Категорија Б автоматик</a></li>
          <li><a href="{{ route('category', 'c-kategorija') }}">Категорија Ц</a></li>
          <li><a href="{{ route('category', 'd-kategorija') }}">Категорија Д</a></li>
          <li><a href="{{ route('category', 'be-kategorija') }}">Категорија БE</a></li>
          <li><a href="{{ route('category', 'ce-kategorija') }}">Категорија ЦE</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-heading">Контакт</div>
        <div class="footer-contact-item"><i class="fa-solid fa-location-dot"></i><span>11 Октомври бр. 17, Скопје</span></div>
        <div class="footer-contact-item"><i class="fa-solid fa-phone"></i><div><a href="tel:023114065">02-3114-065</a><br><a href="tel:071251259">071-251-259 / 070-363-449</a></div></div>
        <div class="footer-contact-item"><i class="fa-solid fa-envelope"></i><a href="mailto:avtoskolamartin@hotmail.com">avtoskolamartin@hotmail.com</a></div>
        <div class="footer-contact-item"><i class="fa-regular fa-clock"></i><span>Пон–Чет: 09:00–17:00 <br> Петок: 09:00–16:30</span></div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} Автошкола Мартин. Сите права задржани.</span>
      <span>Скопје, Северна Македонија</span>
    </div>
  </div>
</footer>
