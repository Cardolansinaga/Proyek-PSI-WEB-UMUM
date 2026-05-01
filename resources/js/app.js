const root = document.documentElement;

root.classList.remove('no-js');
root.classList.add('motion-ready');

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
].join(',');

const elements = Array.from(document.querySelectorAll(revealTargets))
    .filter((element) => !element.closest('header, footer'));

if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    elements.forEach((element, index) => {
        element.classList.add('reveal-on-scroll');
        element.style.setProperty('--reveal-delay', `${Math.min(index % 6, 5) * 70}ms`);
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

document.querySelectorAll('details.faq-item').forEach((item) => {
    item.addEventListener('toggle', () => {
        item.classList.toggle('is-open', item.open);
    });
});
