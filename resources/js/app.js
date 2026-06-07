import 'bootstrap/dist/js/bootstrap.bundle.min.js';

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

    root.style.setProperty('--header-height', `${header.offsetHeight}px`);
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

window.addEventListener('scroll', updateChrome, { passive: true });
window.addEventListener('resize', () => {
    updateHeaderHeight();
    updateChrome();
});

document.querySelectorAll('details.faq-item').forEach((item) => {
    item.classList.toggle('is-open', item.open);

    item.addEventListener('toggle', () => {
        item.classList.toggle('is-open', item.open);
    });
});
