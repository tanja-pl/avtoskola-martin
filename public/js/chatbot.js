/**
 * Avtoskola Martin — Floating AI Chatbot
 * Talks to /api/chat (OpenAI key stays on server).
 */
(function () {
  'use strict';

  const API_URL = '/api/chat';
  const MAX_HISTORY = 6; // keep in sync with api config (cost control)
  const LEAD_KEY = 'amChatLead';
  const CONVERSATION_KEY = 'amChatConversation';
  const MAX_INPUT = 500;

  const SUGGESTIONS = [
    'Каде се наоѓате?',
    'Кое е работното време?',
    'Кои категории ги нудите?',
    'Како да се запишам?',
    'Што е Е-Тест?',
    'Како можам да ве контактирам?'
  ];

  const GREETING =
    'Здраво 👋 Јас сум асистентот на Автошкола Мартин. Како можам да ви помогнам?';

  const DRIVER_SVG =
    '<svg viewBox="0 0 72 72" focusable="false">' +
      '<ellipse cx="36" cy="64.5" rx="22" ry="3" fill="#0B1220" opacity=".2"/>' +
      '<path fill="#E6C700" d="M12 46.5h46c3.2 0 6 2.2 6 5.2V56c0 2.2-2 4-4.6 4H14.2c-2.8 0-5.2-1.8-5.2-4.2v-4.8c0-2.6 1.6-4.5 3-4.5Z"/>' +
      '<path fill="#FDDE1F" d="M14 44.5h42.5c4.2 0 7.2 2.4 8 6.2l.4 2H12.2l.6-2.2c.6-3.2 2.6-6 5.2-6Z"/>' +
      '<path fill="#FDDE1F" d="M24 44.5V33.2c0-2.6 1.8-5 4.4-5.8L39 24.2h11.2c2.6 0 4.6 1.6 5.6 4.1L59 44.5H24Z"/>' +
      '<path fill="#FFF6B8" d="M30 31.5c2.2-3.6 6.4-6 11.2-6.6 1.2 2.8.4 6.2-2.2 8.2-3.2 2.4-7.2 2.2-9-.2Z" opacity=".85"/>' +
      '<path fill="#16356F" d="M30.2 32.2 37.4 26h9.4c1.8 0 3.1 1.1 3.8 2.8L53.2 42H28.4l1.8-9.8Z"/>' +
      '<path fill="#8FB6EE" d="M33.5 31.2 38.6 27.6h5.2c.6 1.6.2 3.4-1.2 4.6-2.2 1.6-4.8 1.2-6.1-.2-.6-.6-1.4-1.2-3-.8Z" opacity=".55"/>' +
      '<path fill="#2955A4" d="M34.2 36.2h9.2l1.2 6.2h-11.6l1.2-6.2Z"/>' +
      '<circle cx="38.6" cy="33.2" r="7" fill="#F4C39A"/>' +
      '<path fill="#3A2A24" d="M32.2 31.2c.6-4.6 3.4-6.6 6.6-6.6 3.4 0 6 2.2 6.4 6.4-1.8-.9-3.6-1.3-6.4-1.3-2.4 0-4.6.5-6.6 1.5Z"/>' +
      '<circle cx="36.2" cy="33.8" r="1.25" fill="#0B1220"/>' +
      '<circle cx="41.2" cy="33.8" r="1.25" fill="#0B1220"/>' +
      '<circle cx="35.8" cy="33.3" r=".45" fill="#fff"/>' +
      '<circle cx="40.8" cy="33.3" r=".45" fill="#fff"/>' +
      '<path d="M36 36.4c1 1.2 2 1.7 2.8 1.7s1.7-.5 2.6-1.7" fill="none" stroke="#0B1220" stroke-width="1.1" stroke-linecap="round"/>' +
      '<circle cx="34.2" cy="35.4" r="1.05" fill="#F3A394"/>' +
      '<circle cx="43" cy="35.4" r="1.05" fill="#F3A394"/>' +
      '<circle cx="31.2" cy="39.2" r="3.3" fill="none" stroke="#0B1220" stroke-width="1.6"/>' +
      '<path d="M31.2 36.4v5.6M28.4 39.2h5.6" stroke="#0B1220" stroke-width=".8" stroke-linecap="round"/>' +
      '<path fill="#2955A4" d="M16.5 48.2h36c1.6 0 2.4.8 2.4 1.8s-1 1.9-2.6 1.9H18.2c-1.6 0-2.6-.8-2.6-1.9s.9-1.8 2.9-1.8Z"/>' +
      '<g class="am-wave">' +
        '<path d="M45.4 35c1.4-2.4 3.8-6.6 4.6-11.6" fill="none" stroke="#F4C39A" stroke-width="4" stroke-linecap="round"/>' +
        '<circle cx="50.4" cy="20.8" r="3.8" fill="#F4C39A"/>' +
        '<circle cx="47.4" cy="17.6" r="1.55" fill="#F4C39A"/>' +
        '<circle cx="50.4" cy="16" r="1.55" fill="#F4C39A"/>' +
        '<circle cx="53.2" cy="17.8" r="1.55" fill="#F4C39A"/>' +
      '</g>' +
      '<circle cx="22" cy="58" r="6.1" fill="#0B1220"/>' +
      '<circle cx="22" cy="58" r="2.5" fill="#E7EEF8"/>' +
      '<circle cx="51" cy="58" r="6.1" fill="#0B1220"/>' +
      '<circle cx="51" cy="58" r="2.5" fill="#E7EEF8"/>' +
      '<circle cx="62.5" cy="47.5" r="1.7" fill="#FFF8C9"/>' +
    '</svg>';

  const CAR_ICON =
    '<span class="am-chat-car" aria-hidden="true">' + DRIVER_SVG + '</span>';
  const CLOSE_ICON = '<i class="fa-solid fa-xmark" aria-hidden="true"></i>';

  let history = [];
  let isOpen = false;
  let isSending = false;
  let suggestionsShown = false;
  let leadState = loadLeadState();

  function loadLeadState() {
    try {
      const raw = sessionStorage.getItem(LEAD_KEY);
      if (!raw) {
        return { asked: false, captured: false, declined: false };
      }
      const parsed = JSON.parse(raw);
      return {
        asked: !!parsed.asked,
        captured: !!parsed.captured,
        declined: !!parsed.declined
      };
    } catch (_) {
      return { asked: false, captured: false, declined: false };
    }
  }

  function saveLeadState() {
    try {
      sessionStorage.setItem(LEAD_KEY, JSON.stringify(leadState));
    } catch (_) {
      /* ignore private-mode quota */
    }
  }

  function conversationToken() {
    try {
      const existing = sessionStorage.getItem(CONVERSATION_KEY);
      if (existing && /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i.test(existing)) {
        return existing;
      }
      if (window.crypto && typeof crypto.randomUUID === 'function') {
        const token = crypto.randomUUID();
        sessionStorage.setItem(CONVERSATION_KEY, token);
        return token;
      }
    } catch (_) {
      /* private mode */
    }
    return '';
  }

  function el(tag, className, attrs) {
    const node = document.createElement(tag);
    if (className) node.className = className;
    if (attrs) {
      Object.keys(attrs).forEach((k) => {
        if (k === 'text') node.textContent = attrs[k];
        else if (k === 'html') node.innerHTML = attrs[k];
        else node.setAttribute(k, attrs[k]);
      });
    }
    return node;
  }

  function buildUI() {
    const root = el('div', 'am-chat-root');

    const dock = el('div', 'am-chat-dock');

    const nudge = el('button', 'am-chat-nudge', {
      type: 'button',
      id: 'amChatNudge',
      'aria-label': 'Отвори чат: Разговарајте со нашиот асистент',
      'aria-controls': 'amChatPanel'
    });
    nudge.innerHTML =
      '<span class="am-chat-nudge-badge" aria-hidden="true">' + DRIVER_SVG + '</span>' +
      '<span class="am-chat-nudge-copy">' +
        '<span class="am-chat-nudge-kicker">Здраво</span>' +
        '<span class="am-chat-nudge-text">Разговарајте со нашиот асистент</span>' +
      '</span>' +
      '<span class="am-chat-nudge-lane" aria-hidden="true">' +
        '<span class="am-chat-nudge-car">' +
          '<svg viewBox="0 0 36 16" focusable="false">' +
            '<path d="M6.2 11.4 8 6.6c.3-.8 1-1.3 1.8-1.3h9.4c.7 0 1.4.4 1.7 1.1L23.5 11H6.2Z" fill="#FDDE1F"/>' +
            '<path d="M8.4 11.4h19.4c1.2 0 1.8-.9 1.6-1.8l-.4-1.4c-.2-.6-.7-1-1.3-1H24L22.2 5c-.4-.8-1.2-1.3-2.1-1.3H12.4c-.8 0-1.6.5-2 1.2L8.4 8.2H6.6c-.7 0-1.2.5-1.4 1.1l-.4 1.3c-.2.9.4 1.8 1.6 1.8h2Z" fill="#2955A4"/>' +
            '<rect x="12.2" y="5.4" width="4.4" height="2.6" rx=".5" fill="#9EC4F5"/>' +
            '<rect x="17.4" y="5.4" width="4.2" height="2.6" rx=".5" fill="#9EC4F5"/>' +
            '<circle cx="11.2" cy="12.2" r="2.1" fill="#0B1220"/>' +
            '<circle cx="11.2" cy="12.2" r="1" fill="#E5E7EB"/>' +
            '<circle cx="24.6" cy="12.2" r="2.1" fill="#0B1220"/>' +
            '<circle cx="24.6" cy="12.2" r="1" fill="#E5E7EB"/>' +
          '</svg>' +
        '</span>' +
      '</span>';

    const launcher = el('button', 'am-chat-launcher', {
      type: 'button',
      'aria-label': 'Отвори чат',
      'aria-expanded': 'false',
      'aria-controls': 'amChatPanel'
    });
    launcher.innerHTML = CAR_ICON;

    const panel = el('div', 'am-chat-panel', {
      id: 'amChatPanel',
      role: 'dialog',
      'aria-label': 'Чат со Автошкола Мартин',
      'aria-hidden': 'true'
    });

    const header = el('div', 'am-chat-header');
    header.innerHTML =
      '<img class="am-chat-header-logo" src="images/logo.png" alt="Автошкола Мартин">' +
      '<div class="am-chat-header-text"><strong>Автошкола Мартин</strong><span>Онлајн асистент</span></div>';
    const closeBtn = el('button', 'am-chat-close', {
      type: 'button',
      'aria-label': 'Затвори чат'
    });
    closeBtn.innerHTML = '<i class="fa-solid fa-xmark" aria-hidden="true"></i>';
    header.appendChild(closeBtn);

    const messages = el('div', 'am-chat-messages', { id: 'amChatMessages' });

    const inputRow = el('div', 'am-chat-input-row');
    const input = el('textarea', 'am-chat-input', {
      id: 'amChatInput',
      rows: '1',
      maxlength: String(MAX_INPUT),
      placeholder: 'Напишете го вашето прашање...',
      'aria-label': 'Порака'
    });
    const sendBtn = el('button', 'am-chat-send', {
      type: 'button',
      'aria-label': 'Испрати',
      id: 'amChatSend'
    });
    sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane" aria-hidden="true"></i>';
    inputRow.appendChild(input);
    inputRow.appendChild(sendBtn);

    const note = el('div', 'am-chat-footer-note', {
      text: 'Одговорите се базирани на информации од Автошкола Мартин.'
    });

    panel.appendChild(header);
    panel.appendChild(messages);
    panel.appendChild(inputRow);
    panel.appendChild(note);

    root.appendChild(panel);
    dock.appendChild(nudge);
    dock.appendChild(launcher);
    document.body.appendChild(root);
    document.body.appendChild(dock);

    return { dock, nudge, launcher, panel, messages, input, sendBtn, closeBtn };
  }

  function vehiclePhotos(images) {
    if (!Array.isArray(images)) return [];
    return images.filter((photo) => {
      if (!photo || typeof photo.url !== 'string') return false;
      try {
        const url = new URL(photo.url, window.location.origin);
        return url.origin === window.location.origin
          && url.pathname.indexOf('/images/vehicles/') === 0
          && url.pathname.indexOf('..') === -1;
      } catch (_) {
        return false;
      }
    });
  }

  function appendMessage(messagesEl, role, text, isError, images) {
    const msg = el('div', 'am-chat-msg ' + (isError ? 'error' : role === 'user' ? 'user' : 'bot'));
    msg.textContent = text;
    const photos = !isError && role === 'bot' ? vehiclePhotos(images) : [];
    if (photos.length) {
      const wrap = el('div', 'am-chat-photos' + (photos.length === 1 ? ' am-chat-photos--single' : ''));
      photos.forEach((photo) => {
        wrap.appendChild(el('img', 'am-chat-photo', {
          src: photo.url,
          alt: typeof photo.alt === 'string' && photo.alt ? photo.alt : 'Возило за обука',
          loading: 'lazy'
        }));
      });
      msg.appendChild(wrap);
    }
    messagesEl.appendChild(msg);
    messagesEl.scrollTop = messagesEl.scrollHeight;
    return msg;
  }

  function showSuggestions(messagesEl, onPick) {
    if (suggestionsShown) return;
    suggestionsShown = true;
    const wrap = el('div', 'am-chat-suggestions');
    SUGGESTIONS.forEach((q) => {
      const btn = el('button', 'am-chat-suggestion', { type: 'button', text: q });
      btn.addEventListener('click', () => {
        wrap.remove();
        onPick(q);
      });
      wrap.appendChild(btn);
    });
    messagesEl.appendChild(wrap);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function showTyping(messagesEl) {
    const node = el('div', 'am-chat-typing', { 'aria-label': 'Пишува...' });
    node.innerHTML = '<span></span><span></span><span></span>';
    messagesEl.appendChild(node);
    messagesEl.scrollTop = messagesEl.scrollHeight;
    return node;
  }

  function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
  }

  function init() {
    if (document.getElementById('amChatPanel')) return;

    const ui = buildUI();
    appendMessage(ui.messages, 'bot', GREETING);
    showSuggestions(ui.messages, (q) => sendMessage(q));

    function setOpen(open) {
      isOpen = open;
      ui.panel.classList.toggle('open', open);
      ui.dock.classList.toggle('am-chat-dock--open', open);
      ui.panel.setAttribute('aria-hidden', open ? 'false' : 'true');
      ui.nudge.setAttribute('aria-hidden', open ? 'true' : 'false');
      ui.launcher.setAttribute('aria-expanded', open ? 'true' : 'false');
      ui.launcher.setAttribute('aria-label', open ? 'Затвори чат' : 'Отвори чат');
      ui.launcher.innerHTML = open ? CLOSE_ICON : CAR_ICON;
      if (open) {
        setTimeout(() => ui.input.focus(), 180);
      }
    }

    async function sendMessage(text) {
      const trimmed = String(text || '').trim();
      if (!trimmed || isSending) return;
      if (trimmed.length > MAX_INPUT) return;

      const sug = ui.messages.querySelector('.am-chat-suggestions');
      if (sug) sug.remove();

      appendMessage(ui.messages, 'user', trimmed);
      ui.input.value = '';
      autoResize(ui.input);

      isSending = true;
      ui.sendBtn.disabled = true;
      ui.input.disabled = true;
      const typing = showTyping(ui.messages);

      const historyPayload = history.slice(-MAX_HISTORY);

      try {
        const res = await fetch(API_URL, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            message: trimmed,
            history: historyPayload,
            lead: leadState,
            conversation_id: conversationToken()
          })
        });

        let data = null;
        try {
          data = await res.json();
        } catch (_) {
          data = null;
        }

        typing.remove();

        const reply =
          (data && (data.reply || data.error === 'not_configured' && data.reply)) ||
          'Извинете, моментално имам проблем со одговарањето. Обидете се повторно за момент.';

        appendMessage(ui.messages, 'bot', reply, !res.ok && !data?.reply, data && data.images);

        if (data && typeof data.conversation_id === 'string' && /^[0-9a-f-]{36}$/i.test(data.conversation_id)) {
          try {
            sessionStorage.setItem(CONVERSATION_KEY, data.conversation_id);
          } catch (_) {
            /* ignore private-mode quota */
          }
        }

        if (data && data.lead && typeof data.lead === 'object') {
          leadState = {
            asked: !!(leadState.asked || data.lead.asked),
            captured: !!(leadState.captured || data.lead.captured),
            declined: !!(leadState.declined || data.lead.declined)
          };
          saveLeadState();
        }

        history.push({ role: 'user', content: trimmed });
        history.push({ role: 'assistant', content: reply });
        if (history.length > MAX_HISTORY * 2) {
          history = history.slice(-MAX_HISTORY * 2);
        }
      } catch (_) {
        typing.remove();
        appendMessage(
          ui.messages,
          'bot',
          'Извинете, моментално имам проблем со одговарањето. Обидете се повторно за момент.',
          true
        );
      } finally {
        isSending = false;
        ui.sendBtn.disabled = false;
        ui.input.disabled = false;
        ui.input.focus();
      }
    }

    ui.launcher.addEventListener('click', () => setOpen(!isOpen));
    ui.nudge.addEventListener('click', () => setOpen(true));
    ui.closeBtn.addEventListener('click', () => setOpen(false));

    ui.sendBtn.addEventListener('click', () => sendMessage(ui.input.value));

    ui.input.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage(ui.input.value);
      }
    });

    ui.input.addEventListener('input', () => autoResize(ui.input));

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && isOpen) setOpen(false);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
