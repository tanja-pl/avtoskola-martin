/* ================================================================
   AVTOSKOLA MARTIN — Main JavaScript
================================================================ */

function csrfToken() {
  const meta = document.querySelector('meta[name="csrf-token"]');
  return meta ? meta.getAttribute('content') : '';
}

function jsonHeaders() {
  return {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-TOKEN': csrfToken()
  };
}

/* ── Navbar scroll effect ──────────────────────────────────────── */
(function () {
  const navbar = document.querySelector('.navbar');
  if (!navbar) return;

  function updateNav() {
    if (window.scrollY > 40) {
      navbar.classList.add('scrolled');
      navbar.classList.remove('transparent');
    } else {
      navbar.classList.remove('scrolled');
      navbar.classList.add('transparent');
    }
  }

  updateNav();
  window.addEventListener('scroll', updateNav, { passive: true });
})();

/* ── Mobile hamburger menu ─────────────────────────────────────── */
(function () {
  const btn = document.getElementById('navHamburger');
  const mobileNav = document.getElementById('navMobile');
  if (!btn || !mobileNav) return;

  btn.addEventListener('click', () => {
    const isOpen = btn.classList.toggle('open');
    mobileNav.classList.toggle('open', isOpen);
    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });

  // Close on link click
  mobileNav.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => {
      btn.classList.remove('open');
      mobileNav.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });
})();

/* ── Scroll reveal ─────────────────────────────────────────────── */
(function () {
  const els = document.querySelectorAll('.reveal');
  if (!els.length) return;

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          io.unobserve(e.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
  );

  els.forEach(el => io.observe(el));
})();

/* ── Animated counters ─────────────────────────────────────────── */
(function () {
  const counters = document.querySelectorAll('[data-count]');
  if (!counters.length) return;

  function animateCount(el) {
    const target = parseInt(el.getAttribute('data-count'), 10);
    const suffix = el.getAttribute('data-suffix') || '';
    const duration = 1800;
    const start = performance.now();

    function easeOut(t) { return 1 - Math.pow(1 - t, 3); }

    function update(now) {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const val = Math.round(easeOut(progress) * target);
      el.textContent = String(val).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + suffix;
      if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  }

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          animateCount(e.target);
          io.unobserve(e.target);
        }
      });
    },
    { threshold: 0.5 }
  );

  counters.forEach(c => io.observe(c));
})();

/* ── Contact form ──────────────────────────────────────────────── */
(function () {
  const form = document.getElementById('contactForm');
  if (!form) return;
  const btn = form.querySelector('button[type="submit"]');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (btn && btn.disabled) return;

    const payload = {
      name: (form.querySelector('#cName') || {}).value || '',
      phone: (form.querySelector('#cPhone') || {}).value || '',
      email: (form.querySelector('#cEmail') || {}).value || '',
      subject: (form.querySelector('#cSubject') || {}).value || '',
      message: (form.querySelector('#cMsg') || {}).value || '',
      website: (form.querySelector('#cWebsite') || {}).value || ''
    };

    if (btn) {
      btn.disabled = true;
    }

    try {
      const res = await fetch('/kontakt', {
        method: 'POST',
        headers: jsonHeaders(),
        body: JSON.stringify(payload)
      });
      let data = null;
      try {
        data = await res.json();
      } catch (_) {
        data = null;
      }

      if (res.ok && data && data.ok) {
        showToast(data.message || 'Вашата порака е испратена! Ќе ве контактираме наскоро.');
        form.reset();
      } else {
        showToast(
          (data && data.message) || 'Пораката не можеше да се испрати. Јавете се на 02-3114-065.',
          true
        );
      }
    } catch (_) {
      showToast('Пораката не можеше да се испрати. Проверете ја врската и обидете се повторно.', true);
    } finally {
      if (btn) {
        btn.disabled = false;
      }
    }
  });
})();

/* ── Toast notification ────────────────────────────────────────── */
function showToast(msg, isError) {
  let toast = document.querySelector('.toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = '<i class="fa-solid fa-circle-check"></i><span></span>';
    document.body.appendChild(toast);
  }
  const icon = toast.querySelector('i');
  if (icon) {
    icon.className = isError ? 'fa-solid fa-circle-exclamation' : 'fa-solid fa-circle-check';
  }
  toast.classList.toggle('toast-error', !!isError);
  toast.querySelector('span').textContent = msg;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 5000);
}

/* ── Video modal ───────────────────────────────────────────────── */
(function () {
  const cards = document.querySelectorAll('.video-card[data-video]');
  if (!cards.length) return;

  let modal = null;

  function createModal(videoId) {
    if (modal) modal.remove();
    modal = document.createElement('div');
    modal.style.cssText = `
      position:fixed;inset:0;z-index:9999;
      background:rgba(0,0,0,.88);backdrop-filter:blur(8px);
      display:flex;align-items:center;justify-content:center;
      padding:24px;
    `;
    modal.innerHTML = `
      <div style="width:100%;max-width:900px;position:relative;">
        <button onclick="this.closest('[style]').remove()" style="
          position:absolute;top:-44px;right:0;
          color:rgba(255,255,255,.7);background:none;border:none;
          font-size:1.5rem;cursor:pointer;font-family:inherit;
        ">✕ Затвори</button>
        <div style="position:relative;padding-bottom:56.25%;height:0;border-radius:16px;overflow:hidden;">
          <iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1"
            style="position:absolute;inset:0;width:100%;height:100%;border:none;"
            allow="autoplay;encrypted-media" allowfullscreen></iframe>
        </div>
      </div>
    `;
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.remove(); });
    document.body.appendChild(modal);
  }

  cards.forEach(card => {
    const playBtn = card.querySelector('.video-play');
    const open = () => createModal(card.getAttribute('data-video'));
    if (playBtn) playBtn.addEventListener('click', open);
  });
})();

/* ── FAQ / Accordion ───────────────────────────────────────────── */
(function () {
  const items = document.querySelectorAll('.faq-item');
  items.forEach(item => {
    const btn = item.querySelector('.faq-btn');
    const body = item.querySelector('.faq-body');
    if (!btn || !body) return;
    btn.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      items.forEach(i => {
        i.classList.remove('open');
        const b = i.querySelector('.faq-body');
        if (b) { b.style.maxHeight = '0'; b.style.opacity = '0'; }
      });
      if (!isOpen) {
        item.classList.add('open');
        body.style.maxHeight = body.scrollHeight + 'px';
        body.style.opacity = '1';
      }
    });
  });
})();

/* ── Homepage stage ────────────────────────────────────────────── */
(function () {
  const root = document.getElementById('homeStage');
  if (!root) return;

  const copies = [...root.querySelectorAll('.home-copy')];
  const images = [...root.querySelectorAll('.home-screen img')];
  const screen = root.querySelector('.home-screen');
  const dotsWrap = root.querySelector('.home-dots');
  const indexEl = root.querySelector('[data-home-index]');
  const live = root.querySelector('[data-home-live]');
  const bar = root.querySelector('.home-progress span');
  const pauseBtn = root.querySelector('.home-pause');
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let index = 0;
  let paused = reduceMotion;
  let touchX = null;

  copies.forEach((copy, i) => {
    const dot = document.createElement('button');
    dot.type = 'button';
    dot.className = 'home-dot' + (i === 0 ? ' is-active' : '');
    dot.setAttribute('role', 'tab');
    dot.setAttribute('aria-label', 'Информација ' + (i + 1));
    dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
    dot.addEventListener('click', () => goTo(i));
    dotsWrap.appendChild(dot);
    copy.querySelectorAll('a').forEach((link) => {
      if (i !== 0) link.setAttribute('tabindex', '-1');
    });
  });

  function applyTone(tone) {
    screen.dataset.tone = tone || 'photo';
    screen.classList.toggle('is-graphic', tone === 'light' || tone === 'dark');
    screen.classList.toggle('is-light', tone === 'light');
  }

  function goTo(n) {
    const next = (n + copies.length) % copies.length;
    if (next === index) {
      restartProgress();
      return;
    }
    const prev = index;
    index = next;

    copies.forEach((copy, i) => {
      const on = i === index;
      copy.classList.toggle('is-active', on);
      copy.setAttribute('aria-hidden', on ? 'false' : 'true');
      copy.querySelectorAll('a').forEach((link) => {
        if (on) link.removeAttribute('tabindex');
        else link.setAttribute('tabindex', '-1');
      });
    });
    images.forEach((img, i) => {
      img.classList.toggle('is-active', i === index);
      img.classList.toggle('is-prev', i === prev);
    });
    [...dotsWrap.children].forEach((dot, i) => {
      dot.classList.toggle('is-active', i === index);
      dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
    });
    applyTone(images[index].dataset.tone);
    if (indexEl) indexEl.textContent = String(index + 1).padStart(2, '0');
    const title = copies[index].querySelector('.home-title');
    if (live && title) live.textContent = title.innerText.replace(/\s+/g, ' ').trim();
    restartProgress();
  }

  function restartProgress() {
    if (!bar) return;
    bar.classList.remove('is-run');
    if (paused || reduceMotion) return;
    void bar.offsetWidth;
    bar.classList.add('is-run');
  }

  if (bar) {
    bar.addEventListener('animationend', () => {
      if (!paused && !reduceMotion) goTo(index + 1);
    });
  }

  root.querySelector('[data-dir="prev"]').addEventListener('click', () => goTo(index - 1));
  root.querySelector('[data-dir="next"]').addEventListener('click', () => goTo(index + 1));

  pauseBtn.addEventListener('click', () => {
    paused = !paused;
    pauseBtn.setAttribute('aria-pressed', paused ? 'true' : 'false');
    pauseBtn.setAttribute('aria-label', paused ? 'Продолжи' : 'Паузирај');
    pauseBtn.innerHTML = paused
      ? '<i class="fa-solid fa-play" aria-hidden="true"></i>'
      : '<i class="fa-solid fa-pause" aria-hidden="true"></i>';
    root.classList.toggle('is-paused', paused);
    restartProgress();
  });

  root.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') { e.preventDefault(); goTo(index - 1); }
    if (e.key === 'ArrowRight') { e.preventDefault(); goTo(index + 1); }
  });

  screen.addEventListener('touchstart', (e) => {
    touchX = e.changedTouches[0].clientX;
  }, { passive: true });
  screen.addEventListener('touchend', (e) => {
    if (touchX == null) return;
    const dx = e.changedTouches[0].clientX - touchX;
    if (Math.abs(dx) > 48) goTo(index + (dx < 0 ? 1 : -1));
    touchX = null;
  }, { passive: true });

  root.addEventListener('mouseenter', () => root.classList.add('is-held'));
  root.addEventListener('mouseleave', () => root.classList.remove('is-held'));

  applyTone(images[0].dataset.tone);
  if (reduceMotion) root.classList.add('is-paused');
  else restartProgress();
})();

/* ── Active nav link highlight ─────────────────────────────────── */
(function () {
  const page = location.pathname.split('/').filter(Boolean).pop() || 'index.html';
  document.querySelectorAll('.nav-links a, .nav-mobile a').forEach(a => {
    const href = a.getAttribute('href');
    if (href === page || (href === 'index.html' && page === '')) {
      a.classList.add('active');
    }
  });
})();
