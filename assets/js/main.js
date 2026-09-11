/* Casa del Torero — main.js — Combined from preview.html */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // ── Scroll reveal (IntersectionObserver) ──
  const obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.reveal').forEach(function (el) { obs.observe(el); });

  // ── Sticky header (.scrolled class) ──
  const header = document.getElementById('site-header');
  if (header) {
    const onScroll = function () { header.classList.toggle('scrolled', window.scrollY > 60); };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ── Mobile nav toggle ──
  const toggle = document.querySelector('.nav-toggle');
  const nav    = document.querySelector('.primary-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      const open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', String(open));
      document.body.style.overflow = open ? 'hidden' : '';
    });
    nav.querySelectorAll('a').forEach(function (l) {
      l.addEventListener('click', function () {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      });
    });
  }

  // ── Gallery slider drag-to-scroll (#gliderTrack) ──
  (function () {
    var t = document.getElementById('gliderTrack');
    if (!t) return;
    var down = false, sx = 0, sl = 0;
    t.addEventListener('mousedown', function (e) { down = true; t.classList.add('dragging'); sx = e.pageX; sl = t.scrollLeft; });
    window.addEventListener('mouseup', function () { down = false; t.classList.remove('dragging'); });
    t.addEventListener('mousemove', function (e) { if (!down) return; e.preventDefault(); t.scrollLeft = sl - (e.pageX - sx); });
  })();

  // ── Testimonials slider drag-to-scroll (#tSlider) ──
  (function () {
    var s = document.getElementById('tSlider');
    if (!s) return;
    var down = false, sx = 0, sl = 0;
    s.addEventListener('mousedown', function (e) { down = true; s.classList.add('dragging'); sx = e.pageX; sl = s.scrollLeft; });
    window.addEventListener('mouseup', function () { down = false; s.classList.remove('dragging'); });
    s.addEventListener('mousemove', function (e) { if (!down) return; e.preventDefault(); s.scrollLeft = sl - (e.pageX - sx); });
  })();

  // ── Spaces grid slider ──
  (function () {
    var g = document.querySelector('.spaces__grid');
    if (!g) return;
    var down = false, sx = 0, sl = 0;
    g.addEventListener('mousedown', function (e) { down = true; g.classList.add('dragging'); sx = e.pageX; sl = g.scrollLeft; });
    window.addEventListener('mouseup', function () { down = false; g.classList.remove('dragging'); });
    g.addEventListener('mousemove', function (e) { if (!down) return; e.preventDefault(); g.scrollLeft = sl - (e.pageX - sx); });
  })();

  // ── Prestige track drag-to-scroll (#prestigeTrack) ──
  (function () {
    var t = document.getElementById('prestigeTrack');
    if (!t) return;
    var down = false, sx = 0, sl = 0;
    t.addEventListener('mousedown', function (e) { down = true; t.classList.add('dragging'); sx = e.pageX; sl = t.scrollLeft; });
    window.addEventListener('mouseup', function () { down = false; t.classList.remove('dragging'); });
    t.addEventListener('mousemove', function (e) { if (!down) return; e.preventDefault(); t.scrollLeft = sl - (e.pageX - sx); });
  })();

  // ── FAQ accordion (.faq-item__btn) ──
  (function () {
    document.querySelectorAll('.faq-item__btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var item = btn.closest('.faq-item');
        var isOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(function (i) {
          i.classList.remove('open');
          i.querySelector('.faq-item__btn').setAttribute('aria-expanded', 'false');
        });
        if (!isOpen) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
      });
    });
  })();

  // ── WhatsApp float visibility (#waFloat) ──
  (function () {
    var btn = document.getElementById('waFloat');
    if (!btn) return;
    window.addEventListener('scroll', function () {
      if (window.scrollY > 300) btn.classList.add('visible');
      else btn.classList.remove('visible');
    }, { passive: true });
  })();

  // ── Habitacion gallery slider drag (#habGalleryTrack) ──
  (function () {
    var s = document.getElementById('habGalleryTrack');
    if (!s) return;
    var down = false, sx = 0, sl = 0;
    s.addEventListener('mousedown', function (e) { down = true; s.classList.add('dragging'); sx = e.pageX; sl = s.scrollLeft; });
    window.addEventListener('mouseup', function () { down = false; s.classList.remove('dragging'); });
    s.addEventListener('mousemove', function (e) { if (!down) return; e.preventDefault(); s.scrollLeft = sl - (e.pageX - sx); });
  })();

});
