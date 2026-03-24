/* ========== HOOGAH V3 SHARED JS ========== */

(function() {
    'use strict';

    // ---- GSAP Setup ----
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        document.body.classList.add('gsap-ready');

        // Scroll reveals
        gsap.utils.toArray('.gs-reveal').forEach(function(el) {
            gsap.to(el, {
                opacity: 1,
                y: 0,
                x: 0,
                duration: 0.85,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 92%',
                    once: true
                }
            });
        });
    }

    // ---- Topbar ----
    var topbar = document.getElementById('topbar');
    if (topbar) {
        var lastScrollY = 0;
        function handleTopbar() {
            var currentY = window.scrollY;
            topbar.classList.toggle('scrolled', currentY > 60);
            if (currentY > 100 && currentY > lastScrollY) {
                topbar.classList.add('hidden');
            } else {
                topbar.classList.remove('hidden');
            }
            lastScrollY = currentY;
        }
        window.addEventListener('scroll', handleTopbar, { passive: true });
        handleTopbar();
    }

    // ---- Mobile menu ----
    var mobileToggle = document.getElementById('mobileToggle');
    var mobileMenu = document.getElementById('mobileMenu');
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            mobileToggle.classList.toggle('active');
            mobileMenu.classList.toggle('open');
            document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
        });
        mobileMenu.querySelectorAll('a').forEach(function(a) {
            a.addEventListener('click', function() {
                mobileToggle.classList.remove('active');
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            });
        });
    }

    // ---- Sticky mobile CTA ----
    var stickyCta = document.getElementById('stickyCta');
    if (stickyCta) {
        function handleStickyCta() {
            if (window.innerWidth > 768) return;
            stickyCta.classList.toggle('visible', window.scrollY > 400);
        }
        window.addEventListener('scroll', handleStickyCta, { passive: true });
        handleStickyCta();
    }

    // ---- Smooth scroll for anchor links ----
    document.querySelectorAll('a[href^="#"]').forEach(function(a) {
        a.addEventListener('click', function(e) {
            var t = document.querySelector(this.getAttribute('href'));
            if (t) {
                e.preventDefault();
                window.scrollTo({ top: t.getBoundingClientRect().top + window.scrollY - 80, behavior: 'smooth' });
            }
        });
    });

})();
