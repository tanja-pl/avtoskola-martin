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
      el.textContent = val.toLocaleString() + suffix;
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
  const refreshBtn = form.querySelector('#humanCheckRefresh');

  function applyChallenge(challenge) {
    if (!challenge || !challenge.token) return;
    const token = form.querySelector('#cHumanToken');
    const visual = form.querySelector('#humanCheckVisual');
    const answer = form.querySelector('#cHuman');
    if (token) {
      token.value = challenge.token;
      token.defaultValue = challenge.token;
    }
    if (visual && challenge.image) {
      visual.innerHTML = challenge.image;
    }
    if (answer) {
      answer.value = '';
    }
  }

  function errorText(data) {
    if (!data) return '';
    if (data.message) return data.message;
    if (data.errors) {
      const first = Object.values(data.errors).flat()[0];
      if (first) return first;
    }
    return '';
  }

  if (refreshBtn) {
    refreshBtn.addEventListener('click', async () => {
      if (refreshBtn.disabled) return;
      refreshBtn.disabled = true;
      try {
        const res = await fetch(form.dataset.challenge, {
          method: 'POST',
          headers: jsonHeaders(),
          body: '{}'
        });
        let data = null;
        try {
          data = await res.json();
        } catch (_) {
          data = null;
        }
        if (res.ok && data && data.challenge) {
          applyChallenge(data.challenge);
          const answer = form.querySelector('#cHuman');
          if (answer) answer.focus();
        } else {
          showToast(errorText(data) || 'Проверката не можеше да се обнови. Освежете ја страницата.', true);
        }
      } catch (_) {
        showToast('Проверката не можеше да се обнови. Проверете ја врската и обидете се повторно.', true);
      } finally {
        refreshBtn.disabled = false;
      }
    });
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (btn && btn.disabled) return;

    const answer = form.querySelector('#cHuman');
    const consent = form.querySelector('input[name="consent"]');
    if (!answer || answer.value.trim().length < 4) {
      showToast('Потврдете дека сте човек.', true);
      if (answer) answer.focus();
      return;
    }
    if (!consent || !consent.checked) {
      showToast('Потребна е согласност за обработка на личните податоци.', true);
      if (consent) consent.focus();
      return;
    }

    const payload = {
      name: (form.querySelector('#cName') || {}).value || '',
      phone: (form.querySelector('#cPhone') || {}).value || '',
      email: (form.querySelector('#cEmail') || {}).value || '',
      subject: (form.querySelector('#cSubject') || {}).value || '',
      message: (form.querySelector('#cMsg') || {}).value || '',
      website: (form.querySelector('#cWebsite') || {}).value || '',
      consent: true,
      human_token: (form.querySelector('#cHumanToken') || {}).value || '',
      human_answer: answer.value || ''
    };

    if (btn) {
      btn.disabled = true;
    }

    try {
      const res = await fetch(form.action, {
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
        if (data.challenge) {
          applyChallenge(data.challenge);
        }
      } else {
        if (data && data.challenge) {
          applyChallenge(data.challenge);
        }
        showToast(
          errorText(data) || 'Пораката не можеше да се испрати. Јавете се на 02-3114-065.',
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

/* ── Homepage highlight carousel ───────────────────────────────── */
(function () {
  const root = document.getElementById('highlightCarousel');
  if (!root) return;

  const slides = [...root.querySelectorAll('.highlight-slide')];
  const dotsWrap = root.querySelector('.highlight-dots');
  if (slides.length < 2) return;

  let index = slides.findIndex((s) => s.classList.contains('is-active'));
  if (index < 0) index = 0;
  let timer = null;
  const interval = parseInt(root.getAttribute('data-interval'), 10) || 3000;
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) root.setAttribute('data-reduced', '');

  slides.forEach((_, i) => {
    const dot = document.createElement('button');
    dot.type = 'button';
    dot.className = 'highlight-dot' + (i === index ? ' is-active' : '');
    dot.setAttribute('aria-label', 'Слајд ' + (i + 1));
    dot.addEventListener('click', () => goTo(i, true));
    dotsWrap.appendChild(dot);
  });

  function goTo(n, user) {
    slides[index].classList.remove('is-active');
    dotsWrap.children[index].classList.remove('is-active');
    index = (n + slides.length) % slides.length;
    slides[index].classList.add('is-active');
    dotsWrap.children[index].classList.add('is-active');
    if (user) restart();
  }

  function restart() {
    if (reduceMotion) return;
    clearInterval(timer);
    timer = setInterval(() => goTo(index + 1), interval);
  }

  root.querySelector('[data-dir="prev"]').addEventListener('click', () => goTo(index - 1, true));
  root.querySelector('[data-dir="next"]').addEventListener('click', () => goTo(index + 1, true));

  root.addEventListener('mouseenter', () => clearInterval(timer));
  root.addEventListener('mouseleave', restart);
  root.addEventListener('focusin', () => clearInterval(timer));
  root.addEventListener('focusout', restart);

  root.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') goTo(index - 1, true);
    if (e.key === 'ArrowRight') goTo(index + 1, true);
  });

  if (!reduceMotion) restart();
})();

/* ── Category fleet lightbox ───────────────────────────────────── */
(function () {
  const dialog = document.getElementById('fleetLightbox');
  if (!dialog) return;

  const img = dialog.querySelector('img');
  const caption = dialog.querySelector('p');

  document.querySelectorAll('.cat-fleet-thumb').forEach((button) => {
    button.addEventListener('click', () => {
      img.src = button.dataset.full;
      img.alt = button.dataset.caption;
      caption.textContent = button.dataset.caption;
      dialog.showModal();
    });
  });

  dialog.addEventListener('click', (event) => {
    if (event.target === dialog) dialog.close();
  });
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
