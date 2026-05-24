const root = document.documentElement;

root.classList.remove('no-js');
root.classList.add('motion-ready');

window.requestAnimationFrame(() => {
    document.body.classList.add('page-ready');
});

if ('scrollRestoration' in window.history) {
    window.history.scrollRestoration = 'manual';
}

if (!window.location.hash) {
    window.scrollTo(0, 0);
}

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const header = document.querySelector('header');
const progress = document.createElement('span');
progress.className = 'scroll-progress';
document.body.appendChild(progress);

const updateHeaderHeight = () => {
    if (!header) {
        return;
    }

    root.style.setProperty('--header-height', `${header.offsetHeight}px`);
};

const updateChrome = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const ratio = maxScroll > 0 ? Math.min(scrollTop / maxScroll, 1) : 0;

    progress.style.transform = `scaleX(${ratio})`;
    header?.classList.toggle('is-scrolled', scrollTop > 24);
};

updateHeaderHeight();
updateChrome();
window.addEventListener('scroll', updateChrome, { passive: true });
window.addEventListener('resize', () => {
    updateHeaderHeight();
    updateChrome();
});

const revealTargets = [
    'main > section',
    'main section > div',
    '.feature-card',
    '.info-card',
    '.news-card',
    '.achievement-card',
    '.teacher-card',
    '.staff-card',
    '.club-card',
    '.program-card',
    '.soft-card',
    '.calendar-card',
    '.profile-stat',
    '.facility-tile',
    '.testimonial',
    '.document-row',
    '.mini-video',
    '.leader-card',
    '.metric-card',
    '.gallery-tile',
    '.illustration',
    '.page-head',
    '.status-card',
    '.module-grid .card',
    '.overview-grid .card',
    '.content-row',
    '.auth-card',
    '.auth-intro',
    '.card',
    '.table-container',
    '.filter-container',
    '.editor-box',
].join(',');

const elements = Array.from(document.querySelectorAll(revealTargets))
    .filter((element) => !element.closest('header, footer'));

const publicSections = Array.from(document.querySelectorAll('.public-site main > section'))
    .filter((section) => !section.classList.contains('school-hero') && !section.classList.contains('page-hero') && !section.classList.contains('public-hero'));

publicSections.forEach((section, index) => {
    section.style.setProperty('--section-delay', `${index * 85}ms`);
});

if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    elements.forEach((element, index) => {
        element.classList.add('reveal-on-scroll');
        element.dataset.revealIndex = String(index);
        element.style.setProperty('--reveal-delay', `${Math.min(index % 8, 7) * 60}ms`);
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.12,
    });

    elements.forEach((element) => observer.observe(element));
} else {
    elements.forEach((element) => element.classList.add('is-visible'));
}

window.requestAnimationFrame(() => {
    document.querySelectorAll('.reveal-on-scroll').forEach((element) => {
        element.classList.add('is-visible');
    });
});

const hero = document.querySelector('.school-hero, .page-hero');

if (hero && !prefersReducedMotion) {
    let ticking = false;

    const updateHero = () => {
        const offset = Math.min(window.scrollY * 0.08, 34);
        hero.style.setProperty('--hero-drift', `${offset}px`);
        ticking = false;
    };

    window.addEventListener('scroll', () => {
        if (ticking) {
            return;
        }

        window.requestAnimationFrame(updateHero);
        ticking = true;
    }, { passive: true });
}

const ambientTargets = document.querySelectorAll(
    '.hero-campus-card, .campus-photo, .illustration, .gallery-tile, .facility-tile, .portrait-visual, .teaching-visual, .principal-photo, .academic-portrait, .achievement-portrait, .video-hero'
);

if (!prefersReducedMotion && ambientTargets.length) {
    window.addEventListener('mousemove', (event) => {
        const pointerX = (event.clientX / window.innerWidth - 0.5) * 12;
        const pointerY = (event.clientY / window.innerHeight - 0.5) * 12;

        ambientTargets.forEach((element) => {
            element.style.setProperty('--tilt-x', `${pointerX.toFixed(2)}px`);
            element.style.setProperty('--tilt-y', `${pointerY.toFixed(2)}px`);
        });
    }, { passive: true });
}

document.querySelectorAll('details.faq-item').forEach((item) => {
    item.addEventListener('toggle', () => {
        item.classList.toggle('is-open', item.open);
    });
});

document.querySelectorAll('a, button, summary, input, select, textarea').forEach((element) => {
    element.addEventListener('focus', () => {
        element.classList.add('is-focused');
    });

    element.addEventListener('blur', () => {
        element.classList.remove('is-focused');
    });
});
