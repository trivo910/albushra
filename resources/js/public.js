// Mobile nav toggle
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', menu.classList.contains('hidden') ? 'false' : 'true');
        });
    }

    // Packages dropdown (mobile: click to expand; desktop: hover via CSS)
    document.querySelectorAll('[data-dropdown-toggle]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                e.preventDefault();
                btn.closest('[data-dropdown]')?.classList.toggle('is-open');
            }
        });
    });

    // Hero carousel
    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const slides = carousel.querySelectorAll('[data-slide]');
        const dotsWrap = carousel.querySelector('[data-carousel-dots]');
        if (slides.length <= 1) return;

        let current = 0;
        const dots = [];

        if (dotsWrap) {
            slides.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'w-2.5 h-2.5 rounded-full transition-colors';
                dot.style.background = i === 0 ? 'var(--p-primary)' : 'rgba(255,255,255,0.6)';
                dot.addEventListener('click', () => show(i));
                dotsWrap.appendChild(dot);
                dots.push(dot);
            });
        }

        function show(index) {
            slides[current].classList.add('opacity-0');
            slides[current].classList.remove('opacity-100');
            if (dots[current]) dots[current].style.background = 'rgba(255,255,255,0.6)';
            current = index;
            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
            if (dots[current]) dots[current].style.background = 'var(--p-primary)';
        }

        setInterval(() => show((current + 1) % slides.length), 4000);
    });

    // Lightbox for galleries
    const lightbox = document.querySelector('[data-lightbox]');
    if (lightbox) {
        const lightboxImg = lightbox.querySelector('[data-lightbox-img]');
        const closeBtn = lightbox.querySelector('[data-lightbox-close]');
        const prevBtn = lightbox.querySelector('[data-lightbox-prev]');
        const nextBtn = lightbox.querySelector('[data-lightbox-next]');
        let items = [];
        let current = 0;

        function open(index) {
            current = index;
            lightboxImg.src = items[current].href;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function close() {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function nav(delta) {
            current = (current + delta + items.length) % items.length;
            lightboxImg.src = items[current].href;
        }

        document.querySelectorAll('[data-lightbox-trigger]').forEach((group) => {
            const links = Array.from(group.querySelectorAll('a'));
            links.forEach((link, i) => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    items = links;
                    open(i);
                });
            });
        });

        closeBtn?.addEventListener('click', close);
        prevBtn?.addEventListener('click', () => nav(-1));
        nextBtn?.addEventListener('click', () => nav(1));
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) close();
        });
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('hidden')) return;
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowLeft') nav(-1);
            if (e.key === 'ArrowRight') nav(1);
        });
    }

    // WhatsApp widget bubble
    const waWidget = document.querySelector('[data-whatsapp-widget]');
    if (waWidget) {
        const bubble = waWidget.querySelector('[data-whatsapp-bubble]');
        const closeBubble = waWidget.querySelector('[data-whatsapp-bubble-close]');
        setTimeout(() => bubble?.classList.remove('hidden'), 1500);
        closeBubble?.addEventListener('click', (e) => {
            e.stopPropagation();
            bubble?.classList.add('hidden');
        });
    }
});
