(function () {
  'use strict';

  function qs(sel, ctx)  { return (ctx || document).querySelector(sel); }
  function qsa(sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); }

  /* Wait for DOM to be ready */
  function init() {
    console.log('Initializing main.js');

  /* ── Hero slider ───────────────────────────────────────────────── */
  var slider = qs('[data-slider]');
  if (slider) {
    var slides = qsa('.eba-slide', slider);
    var dots   = qsa('.eba-slide-dot', slider);
    var idx    = 0;
    var prev   = qs('.eba-slide-prev', slider);
    var next   = qs('.eba-slide-next', slider);
    var timer;

    function show(i) {
      slides.forEach(function (s, n) { s.classList.toggle('active', n === i); });
      dots.forEach(function (d, n)   { d.classList.toggle('active', n === i); });
      idx = i;
    }
    function advance(dir) { show((idx + dir + slides.length) % slides.length); }
    function start() {
      clearInterval(timer);
      timer = setInterval(function () { advance(1); }, 3000);
    }

    if (prev) prev.addEventListener('click', function () { advance(-1); start(); });
    if (next) next.addEventListener('click', function () { advance(1);  start(); });
    dots.forEach(function (btn) {
      btn.addEventListener('click', function () {
        show(parseInt(btn.getAttribute('data-slide'), 10) || 0);
        start();
      });
    });
    start();
  }

  /* ── Video slider ──────────────────────────────────────────────── */
  var videoSlider = qs('[data-video-slider]');
  if (videoSlider) {
    var vTrack  = qs('.eba-video-track', videoSlider);
    var vSlides = qsa('.eba-video-slide', videoSlider);
    var vThumbs = qsa('.eba-video-thumbs button', videoSlider.parentElement || videoSlider);
    var vPrev   = qs('.eba-v-prev', videoSlider);
    var vNext   = qs('.eba-v-next', videoSlider);
    var vIdx = 0, vTimer;

    function showVideo(i) {
      vIdx = (i + vSlides.length) % vSlides.length;
      if (vTrack) vTrack.style.transform = 'translateX(-' + (vIdx * 100) + '%)';
      vThumbs.forEach(function (t, n) { t.classList.toggle('active', n === vIdx); });
    }
    function startVideo() {
      clearInterval(vTimer);
      vTimer = setInterval(function () { showVideo(vIdx + 1); }, 8000);
    }
    if (vPrev) vPrev.addEventListener('click', function () { showVideo(vIdx - 1); startVideo(); });
    if (vNext) vNext.addEventListener('click', function () { showVideo(vIdx + 1); startVideo(); });
    vThumbs.forEach(function (btn) {
      btn.addEventListener('click', function () {
        showVideo(parseInt(btn.getAttribute('data-index'), 10) || 0);
        startVideo();
      });
    });
    startVideo();
  }

  /* ── Members carousel ──────────────────────────────────────────── */
  var members = qs('[data-members]');
  if (members) {
    var mTrack = qs('.eba-members-track', members);
    var mItems = qsa('.eba-member', members);
    var mPrev  = qs('.eba-m-prev', members);
    var mNext  = qs('.eba-m-next', members);
    var mIdx = 0, mTimer;

    function perView() {
      if (window.innerWidth <= 480)  return 2;
      if (window.innerWidth <= 768)  return 3;
      if (window.innerWidth <= 1024) return 4;
      return 5;
    }
    function maxIdx() { return Math.max(0, mItems.length - perView()); }
    function moveMembers(i) {
      mIdx = Math.max(0, Math.min(i, maxIdx()));
      var item = mItems[0];
      if (!item) return;
      mTrack.style.transform = 'translateX(-' + (mIdx * (item.offsetWidth + 8)) + 'px)';
    }
    function startMembers() {
      clearInterval(mTimer);
      mTimer = setInterval(function () { moveMembers(mIdx >= maxIdx() ? 0 : mIdx + 1); }, 5000);
    }
    if (mPrev) mPrev.addEventListener('click', function () { moveMembers(mIdx - 1); startMembers(); });
    if (mNext) mNext.addEventListener('click', function () { moveMembers(mIdx + 1); startMembers(); });
    window.addEventListener('resize', function () { moveMembers(mIdx); });
    startMembers();
  }

  /* ── Hamburger menu ────────────────────────────────────────────── */
  var toggle  = qs('.eba-menu-toggle');
  var menu    = qs('.eba-menu');
  var menuBar = qs('.eba-menu-bar');
  var overlay  = qs('#eba-menu-overlay');
  var closeBtn = qs('.eba-menu-close-btn');

  function openMenu() {
    console.log('Opening menu');
    menu.classList.add('open');
    if (overlay) overlay.classList.add('active');
    if (toggle) toggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('menu-open');
  }
  function closeMenu() {
    console.log('Closing menu');
    menu.classList.remove('open');
    if (overlay) overlay.classList.remove('active');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('menu-open');
  }

  console.log('Menu elements found:', { toggle: !!toggle, menu: !!menu, overlay: !!overlay, closeBtn: !!closeBtn });

  if (toggle && menu) {
    toggle.addEventListener('click', function (e) {
      console.log('Hamburger clicked');
      e.stopPropagation();
      menu.classList.contains('open') ? closeMenu() : openMenu();
    });

    /* Close via close button */
    if (closeBtn) {
      closeBtn.addEventListener('click', function (e) {
        console.log('Close button clicked');
        e.stopPropagation();
        closeMenu();
      });
    }    /* Sub-menu accordion on mobile and tablet */
    qsa('.has-sub > a', menu).forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (window.innerWidth <= 1024) {
          e.preventDefault();
          var li = link.parentElement;
          var wasOpen = li.classList.contains('open');
          qsa('.has-sub', menu).forEach(function (s) { s.classList.remove('open'); });
          if (!wasOpen) li.classList.add('open');
        }
      });
    });
    if (overlay) {
      overlay.addEventListener('click', function () { closeMenu(); });
    }

    /* Close on Escape */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeMenu();
    });
  }

  /* ── Smooth scroll ─────────────────────────────────────────────── */
  document.addEventListener('click', function (e) {
    var link = e.target.closest('a[href*="#"]');
    if (!link) return;
    var href = link.getAttribute('href');
    if (!href || href === '#') return;
    var hash = href.substring(href.indexOf('#') + 1);
    if (!hash) return;
    var target = document.getElementById(hash);
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
  });

  /* ── Relative dates ────────────────────────────────────────────── */
  function relDate(str) {
    var d = new Date(str), now = new Date(), diff = Math.floor((now - d) / 1000);
    if (diff < 60)         return 'just now';
    if (diff < 3600)       return Math.floor(diff/60)   + ' minutes ago';
    if (diff < 86400)      return Math.floor(diff/3600)  + ' hours ago';
    if (diff < 2592000)    return Math.floor(diff/86400) + ' days ago';
    if (diff < 31536000)   return Math.floor(diff/2592000) + ' months ago';
    return Math.floor(diff/31536000) + ' years ago';
  }
  qsa('.eba-meta-date').forEach(function (el) {
    var m = el.textContent.trim().match(/(\w+ \d{1,2}, \d{4})/);
    if (m) { el.textContent = relDate(m[1]); el.setAttribute('title', m[1]); }
  });

  /* ── Language switcher — Google Translate widget (persistent across all pages) ── */
  var langSwitcher = qs('#eba-lang-switcher');
  var langTrigger  = qs('#eba-translate-trigger');
  var langDropdown = qs('#eba-lang-dropdown');
  var langCurrent  = qs('#eba-lang-current');

  /* ------------------------------------------------------------------
   * ebaGTInit is called by the Google Translate script after it loads.
   * It mounts the hidden widget onto #google_translate_element.
   * GT then reads/writes the googtrans cookie automatically on every
   * page, translating everything — navigation, footer, dates, content.
   * ------------------------------------------------------------------ */
  /* Helper: read a cookie value */
  function ebaGetCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]\\/+^])/g, '\\$1') + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : '';
  }

  /* Helper: write a cookie on root path + root domain */
  function ebaSetCookie(name, value, days) {
    var exp = '';
    if (days) {
      var d = new Date();
      d.setTime(d.getTime() + days * 86400000);
      exp = '; expires=' + d.toUTCString();
    }
    document.cookie = name + '=' + encodeURIComponent(value) + exp + '; path=/';
    /* Also set on bare domain so GT picks it up on sub-paths (only if not localhost or IP) */
    var host = window.location.hostname.replace(/^www\./, '');
    if (host.indexOf('.') !== -1 && !/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/.test(host)) {
      document.cookie = name + '=' + encodeURIComponent(value) + exp + '; path=/; domain=.' + host;
    }
  }

  /* ------------------------------------------------------------------
   * ebaGTInit is called by the Google Translate script after it loads.
   * It mounts the hidden widget onto #google_translate_element.
   * GT then reads/writes the googtrans cookie automatically on every
   * page, translating everything — navigation, footer, dates, content.
   * ------------------------------------------------------------------ */
  window.ebaGTInit = function () {
    if (typeof google === 'undefined' || !google.translate) return;
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,am,es,zh-CN,ar,de,fr',
      autoDisplay: false
    }, 'google_translate_element');

    /* Programmatically enforce active language from cookie on load */
    var gtCookie = ebaGetCookie('googtrans');
    if (gtCookie) {
      var parts = gtCookie.split('/');
      var activeLang = parts[parts.length - 1];
      if (activeLang && activeLang !== 'en') {
        var checkCombo = setInterval(function () {
          var combo = document.querySelector('.goog-te-combo');
          if (combo) {
            clearInterval(checkCombo);
            if (combo.value !== activeLang) {
              combo.value = activeLang;
              combo.dispatchEvent(new Event('change'));
            }
          }
        }, 100);
        setTimeout(function () { clearInterval(checkCombo); }, 5000);
      }
    }
  };

  /* Restore label from saved cookie on every page load */
  var gtCookie = ebaGetCookie('googtrans'); /* format: /en/es */
  if (gtCookie) {
    var parts = gtCookie.split('/');
    var activeLang = parts[parts.length - 1];
    if (activeLang) {
      var activeBtn = qs('button[data-lang="' + activeLang + '"]', langDropdown);
      if (activeBtn && langCurrent) {
        langCurrent.textContent = activeBtn.getAttribute('data-label') || activeLang.toUpperCase();
        qsa('button[data-lang]', langDropdown).forEach(function (b) { b.classList.remove('active'); });
        activeBtn.classList.add('active');
      }
      /* Update date in selected language */
      var dateElement = document.getElementById('eba-current-date');
      if (dateElement) {
        var now = new Date();
        var options = { year: 'numeric', month: 'long', day: 'numeric' };
        if (activeLang === 'am') {
          options.calendar = 'ethiopic';
        }
        dateElement.textContent = now.toLocaleDateString(activeLang === 'zh-CN' ? 'zh-CN' : activeLang, options);
      }
    }
  }

  if (langSwitcher && langTrigger && langDropdown) {

    /* Ensure dropdown starts hidden */
    langDropdown.style.display = 'none';

    /* Open/close on mousedown (more reliable than click) */
    langTrigger.addEventListener('mousedown', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if (langDropdown.style.display === 'none') {
        langDropdown.style.display = 'block';
        langTrigger.setAttribute('aria-expanded', 'true');
      } else {
        langDropdown.style.display = 'none';
        langTrigger.setAttribute('aria-expanded', 'false');
      }
    });

    /* Also handle touch for mobile */
    langTrigger.addEventListener('touchstart', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if (langDropdown.style.display === 'none') {
        langDropdown.style.display = 'block';
        langTrigger.setAttribute('aria-expanded', 'true');
      } else {
        langDropdown.style.display = 'none';
        langTrigger.setAttribute('aria-expanded', 'false');
      }
    });

    /* Close on outside click */
    document.addEventListener('mousedown', function (e) {
      if (!langSwitcher.contains(e.target)) {
        langDropdown.style.display = 'none';
        langTrigger.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('touchstart', function (e) {
      if (!langSwitcher.contains(e.target)) {
        langDropdown.style.display = 'none';
        langTrigger.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && langDropdown.style.display !== 'none') {
        langDropdown.style.display = 'none';
        langTrigger.setAttribute('aria-expanded', 'false');
        langTrigger.focus();
      }
    });

    /* Language button clicks */
    qsa('button[data-lang]', langDropdown).forEach(function (btn) {
      btn.addEventListener('mousedown', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var lang  = btn.getAttribute('data-lang');
        var label = btn.getAttribute('data-label') || lang.toUpperCase();

        /* Update button label */
        qsa('button[data-lang]', langDropdown).forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        if (langCurrent) langCurrent.textContent = label;

        /* Close dropdown */
        langDropdown.style.display = 'none';
        langTrigger.setAttribute('aria-expanded', 'false');

        if (lang === 'en') {
          /* Clear the googtrans cookie so GT removes translation on next load */
          ebaSetCookie('googtrans', '', -1);
          ebaSetCookie('googtrans', '/en/en', 30);
          /* Let GT finish, then reload */
          setTimeout(function () { window.location.reload(); }, 50);
          return;
        }

        /* Set googtrans cookie — GT reads this on every page and auto-translates */
        var cookieVal = '/en/' + lang;
        ebaSetCookie('googtrans', cookieVal, 30);

        /* Update date in selected language immediately */
        var dateElement = document.getElementById('eba-current-date');
        if (dateElement) {
          var now = new Date();
          var options = { year: 'numeric', month: 'long', day: 'numeric' };
          if (lang === 'am') {
            options.calendar = 'ethiopic';
          }
          dateElement.textContent = now.toLocaleDateString(lang === 'zh-CN' ? 'zh-CN' : lang, options);
        }

        /* If GT widget is already loaded, trigger it immediately */
        var combo = document.querySelector('.goog-te-combo');
        if (combo) {
          combo.value = lang;
          combo.dispatchEvent(new Event('change'));
          /* Add visual indicator during translation */
          document.body.classList.add('eba-translating');
          setTimeout(function() {
            document.body.classList.remove('eba-translating');
          }, 2000);
        } else {
          /* Widget not loaded yet — reload so GT picks up the cookie */
          setTimeout(function () { window.location.reload(); }, 50);
        }
      });
    });
  }

  }

  /* Call init when DOM is ready */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
