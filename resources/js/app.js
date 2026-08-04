const root = document.documentElement;
const body = document.body;

root.classList.remove('no-js');
root.classList.add('motion-ready');

if ('scrollRestoration' in window.history) {
    window.history.scrollRestoration = 'manual';
}

if (!window.location.hash) {
    window.scrollTo(0, 0);
}

const scrollToHashTarget = (hash = window.location.hash) => {
    if (!hash || hash.length < 2) {
        return;
    }

    let targetId = hash.slice(1);

    try {
        targetId = decodeURIComponent(targetId);
    } catch (error) {
        return;
    }

    const target = document.getElementById(targetId);

    if (!target) {
        return;
    }

    window.requestAnimationFrame(() => {
        target.scrollIntoView({ block: 'start', behavior: 'smooth' });
    });
};

const header = document.querySelector('header');
const progress = document.createElement('span');
progress.className = 'scroll-progress';

if (body?.classList.contains('public-site')) {
    body.appendChild(progress);
}

const updateHeaderHeight = () => {
    if (!header) {
        return;
    }

    const expandedMobilePanel = header.querySelector('.site-nav-panel.show');
    const panelHeight = window.matchMedia('(max-width: 1199.98px)').matches
        ? expandedMobilePanel?.offsetHeight ?? 0
        : 0;
    const collapsedHeaderHeight = Math.max(header.offsetHeight - panelHeight, 0);

    root.style.setProperty('--header-height', `${collapsedHeaderHeight}px`);
};

const updateChrome = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const ratio = maxScroll > 0 ? Math.min(scrollTop / maxScroll, 1) : 0;

    if (progress.isConnected) {
        progress.style.transform = `scaleX(${ratio})`;
    }

    header?.classList.toggle('is-scrolled', scrollTop > 24);
};

updateHeaderHeight();
updateChrome();

let ticking = false;

const requestChromeUpdate = () => {
    if (ticking) {
        return;
    }

    ticking = true;
    window.requestAnimationFrame(() => {
        updateChrome();
        ticking = false;
    });
};

window.addEventListener('scroll', requestChromeUpdate, { passive: true });
window.addEventListener('resize', () => {
    updateHeaderHeight();
    updateChrome();
});

document.querySelectorAll('[data-nav-toggle]').forEach((button) => {
    const targetSelector = button.getAttribute('aria-controls')
        ? `#${button.getAttribute('aria-controls')}`
        : button.getAttribute('data-target');
    const panel = targetSelector ? document.querySelector(targetSelector) : null;

    if (!panel) {
        return;
    }

    const setOpen = (isOpen) => {
        panel.classList.toggle('show', isOpen);
        button.classList.toggle('is-open', isOpen);
        button.closest('.site-header')?.classList.toggle('nav-open', isOpen);
        button.setAttribute('aria-expanded', String(isOpen));
        button.setAttribute('aria-label', isOpen ? 'Tutup navigasi' : 'Buka navigasi');
    };

    button.addEventListener('click', () => {
        setOpen(!panel.classList.contains('show'));
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            if (window.matchMedia('(max-width: 1199.98px)').matches) {
                setOpen(false);
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && panel.classList.contains('show')) {
            setOpen(false);
            button.focus();
        }
    });

    document.addEventListener('click', (event) => {
        if (
            panel.classList.contains('show')
            && !panel.contains(event.target)
            && !button.contains(event.target)
        ) {
            setOpen(false);
        }
    });

    window.addEventListener('resize', () => {
        if (window.matchMedia('(min-width: 1200px)').matches) {
            setOpen(false);
        }
    });
});

document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', () => {
        scrollToHashTarget(link.getAttribute('href'));
    });
});

window.addEventListener('hashchange', () => {
    scrollToHashTarget();
});

window.addEventListener('load', () => {
    scrollToHashTarget();
});

document.querySelectorAll('details.faq-item').forEach((item) => {
    item.classList.toggle('is-open', item.open);

    item.addEventListener('toggle', () => {
        item.classList.toggle('is-open', item.open);
    });
});

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const naturalSite = body?.classList.contains('public-site-natural');

if (naturalSite && !prefersReducedMotion && 'IntersectionObserver' in window) {
    const revealTargets = document.querySelectorAll([
        'main > section:not(.school-hero):not(.ppdb-hero)',
        '.home-service-grid > a',
        '.natural-news-grid > article',
        '.program-card',
        '.achievement-card',
        '.info-card',
        '.club-card',
        '.ppdb-stage-card',
        '.ppdb-pathway-card',
        '.news-card',
        '.featured-news',
    ].join(','));

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.08,
    });

    root.classList.add('natural-motion-enabled');

    revealTargets.forEach((element, index) => {
        element.classList.add('natural-reveal');
        element.style.setProperty('--natural-reveal-delay', `${Math.min(index % 4, 3) * 70}ms`);
        revealObserver.observe(element);
    });
}
