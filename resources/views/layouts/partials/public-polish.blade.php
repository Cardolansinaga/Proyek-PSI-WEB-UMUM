<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --site-navy: #08213b;
        --site-navy-2: #12395f;
        --site-ink: #102033;
        --site-muted: #667789;
        --site-line: #d9e3ee;
        --site-soft: #f4f8fb;
        --site-gold: #c9962c;
        --site-green: #0f9f7a;
        --site-blue: #2563eb;
        --site-card: #ffffff;
        --site-radius: 8px;
        --site-shadow: 0 14px 34px rgba(15, 23, 42, .08);
        --site-shadow-sm: 0 6px 18px rgba(15, 23, 42, .06);
    }

    html {
        scroll-behavior: smooth;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }

    body {
        font-family: "Plus Jakarta Sans", "Manrope", "Segoe UI", ui-sans-serif, system-ui, sans-serif !important;
        background: var(--site-soft) !important;
        color: var(--site-ink) !important;
    }

    body * {
        letter-spacing: 0 !important;
    }

    header.sticky {
        background: rgba(255, 255, 255, .96) !important;
        border-bottom: 1px solid rgba(217, 227, 238, .9) !important;
        box-shadow: 0 10px 28px rgba(15, 23, 42, .06) !important;
        backdrop-filter: blur(14px);
    }

    header nav {
        background: transparent !important;
    }

    .nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        min-height: 38px;
        border-radius: 999px;
        padding: 0 10px;
        color: #40566f !important;
        text-decoration: none;
        transition: background .18s ease, color .18s ease;
        white-space: nowrap;
    }

    .nav-link:hover,
    .nav-link.active {
        background: #eef4f9;
        color: var(--site-navy) !important;
    }

    .mobile-link {
        display: block;
        border-radius: var(--site-radius);
        padding: 11px 12px;
        text-decoration: none;
    }

    main {
        overflow: hidden;
    }

    section {
        position: relative;
    }

    .school-hero,
    .public-hero,
    .hero-home {
        min-height: auto !important;
        background-color: var(--site-navy);
        overflow: hidden;
    }

    .hero-profile { background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-academic { background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-achievement { background-image: linear-gradient(90deg, rgba(8,33,59,.84), rgba(8,33,59,.32)), url('https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-student { background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-dorm { background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-ppdb { background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-news { background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }
    .hero-gallery { background-image: linear-gradient(90deg, rgba(8,33,59,.84), rgba(8,33,59,.28)), url('https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1800&q=85') !important; background-size: cover !important; background-position: center !important; }

    .page-hero,
    .teacher-hero,
    .contact-hero,
    .alumni-hero {
        position: relative;
        overflow: hidden;
        background-color: var(--site-navy);
        background-size: cover !important;
        background-position: center !important;
    }

    .contact-hero { background-image: linear-gradient(90deg, rgba(8,33,59,.88), rgba(8,33,59,.36)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=85') !important; }
    .teacher-hero { background-image: linear-gradient(90deg, rgba(8,33,59,.88), rgba(8,33,59,.32)), url('https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=1800&q=85') !important; }
    .alumni-hero { background-image: linear-gradient(90deg, rgba(8,33,59,.88), rgba(8,33,59,.28)), url('https://images.unsplash.com/photo-1515169067865-5387ec356754?auto=format&fit=crop&w=1800&q=85') !important; }

    .page-hero-overlay,
    .page-hero::before,
    .page-hero::after {
        display: none !important;
    }

    .page-hero > .mx-auto {
        min-height: clamp(440px, 58vh, 610px) !important;
    }

    .page-hero h1 {
        max-width: 920px !important;
        font-size: 48px !important;
        line-height: 1.08 !important;
        font-weight: 800 !important;
    }

    .page-hero p {
        max-width: 720px !important;
        font-size: 16px !important;
        line-height: 1.8 !important;
        font-weight: 600 !important;
    }

    .school-hero > .hero-shade,
    .public-hero > .hero-shade {
        display: none !important;
    }

    .school-hero h1,
    .public-hero h1,
    .hero-home h1 {
        max-width: 880px;
        font-size: 48px !important;
        line-height: 1.05 !important;
        font-weight: 800 !important;
    }

    .school-hero p,
    .public-hero p,
    .hero-home p {
        max-width: 700px;
        font-size: 16px !important;
        line-height: 1.8 !important;
        font-weight: 600 !important;
    }

    .section-pill,
    .eyebrow,
    .meta-line {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        background: #fff8e7;
        color: #8a6211 !important;
        padding: 7px 11px;
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: none !important;
    }

    .eyebrow {
        background: #eaf7f2;
        color: #0f755d !important;
    }

    .gold-button,
    .outline-button,
    .ghost-button {
        min-height: 44px;
        border-radius: var(--site-radius) !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 18px !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        text-decoration: none !important;
        transition: background .18s ease, border-color .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease;
    }

    .gold-button {
        background: var(--site-gold) !important;
        color: #071f3a !important;
        border: 1px solid var(--site-gold) !important;
        box-shadow: 0 10px 20px rgba(201, 150, 44, .18);
    }

    .outline-button {
        background: #ffffff !important;
        color: var(--site-navy) !important;
        border: 1px solid var(--site-line) !important;
    }

    .ghost-button {
        background: rgba(255, 255, 255, .12) !important;
        color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, .32) !important;
    }

    .gold-button:hover,
    .outline-button:hover,
    .ghost-button:hover {
        transform: translateY(-1px);
        box-shadow: var(--site-shadow-sm);
    }

    .rounded-2xl,
    .rounded-xl,
    [class*="rounded-[1.5rem]"],
    [class*="rounded-[1.6rem]"],
    [class*="rounded-[2rem]"] {
        border-radius: var(--site-radius) !important;
    }

    .feature-card,
    .info-card,
    .news-card,
    .achievement-card,
    .teacher-card,
    .staff-card,
    .leader-card,
    .club-card,
    .program-card,
    .soft-card,
    .calendar-card,
    .map-card,
    .metric-card,
    .quote-card,
    .showcase-card,
    .step-card,
    .contact-card,
    .dorm-story,
    .portrait-card,
    .preview-web-card {
        border: 1px solid var(--site-line) !important;
        border-radius: var(--site-radius) !important;
        background: var(--site-card) !important;
        box-shadow: var(--site-shadow-sm) !important;
        overflow: hidden;
    }

    .feature-card,
    .info-card,
    .soft-card,
    .program-card,
    .calendar-card,
    .club-card,
    .contact-card,
    .metric-card,
    .step-card {
        padding: 22px !important;
    }

    .feature-card h3,
    .info-card h2,
    .info-card h3,
    .news-card h3,
    .achievement-card h3,
    .teacher-card h3,
    .club-card h3,
    .program-card h3 {
        color: var(--site-navy) !important;
        font-size: 18px !important;
        line-height: 1.35 !important;
        font-weight: 800 !important;
    }

    .feature-card p,
    .info-card p,
    .info-card p,
    .news-card p,
    .achievement-card p,
    .teacher-card p,
    .club-card p,
    .program-card p,
    .soft-card p {
        color: var(--site-muted) !important;
        font-size: 14px !important;
        line-height: 1.7 !important;
    }

    .feature-icon {
        width: 40px !important;
        height: 40px !important;
        border-radius: var(--site-radius) !important;
        display: inline-grid !important;
        place-items: center !important;
        background: #eef6ff !important;
        color: var(--site-blue) !important;
        border: 1px solid #d8e7ff !important;
        font-size: 0 !important;
    }

    .feature-icon::before {
        content: "\F4D7";
        font-family: "bootstrap-icons";
        font-size: 18px;
    }

    .feature-card:nth-child(2) .feature-icon::before { content: "\F4CF"; }
    .feature-card:nth-child(3) .feature-icon::before { content: "\F5E7"; }
    .feature-card:nth-child(4) .feature-icon::before { content: "\F3E8"; }
    .feature-card:nth-child(5) .feature-icon::before { content: "\F4B8"; }

    .news-card a,
    .featured-news a,
    .final-link,
    .achievement-card a,
    .teacher-card a,
    .club-card a,
    .program-card a {
        color: var(--site-blue) !important;
        font-weight: 800 !important;
        text-decoration: none !important;
    }

    .final-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--site-navy) !important;
    }

    .section-title,
    .mini-heading {
        color: var(--site-navy) !important;
        font-size: 34px !important;
        line-height: 1.18 !important;
        font-weight: 800 !important;
    }

    .mini-heading {
        font-size: 24px !important;
    }

    .round-icon {
        width: 42px !important;
        height: 42px !important;
        border-radius: var(--site-radius) !important;
        display: inline-grid !important;
        place-items: center !important;
        background: #eef6ff !important;
        color: var(--site-blue) !important;
        border: 1px solid #d8e7ff !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
    }

    .round-icon i {
        font-size: 18px !important;
        line-height: 1;
    }

    .program-card.dark,
    .dark-value,
    .service-panel,
    aside[class*="bg-[#071f3a]"] {
        background: linear-gradient(135deg, var(--site-navy), var(--site-navy-2)) !important;
        color: #ffffff !important;
        border-radius: var(--site-radius) !important;
    }

    .program-card.dark h3,
    .program-card.dark p,
    .program-card.dark strong,
    .dark-value h3,
    .dark-value p {
        color: inherit !important;
    }

    .program-card.gold,
    article[class*="bg-[#bd9140]"] {
        background: #fff8e7 !important;
        color: var(--site-navy) !important;
        border: 1px solid #f1dcaa !important;
        border-radius: var(--site-radius) !important;
    }

    .big-stat,
    .profile-stat,
    .metric-card,
    .track-card,
    .service-tile,
    .document-row,
    .schedule-row,
    .testimonial,
    .mini-video,
    .featured-news,
    .faq-item,
    .message-panel,
    .social-card {
        border: 1px solid var(--site-line) !important;
        border-radius: var(--site-radius) !important;
        background: #ffffff !important;
        box-shadow: var(--site-shadow-sm) !important;
    }

    .profile-stat,
    .metric-card,
    .track-card,
    .service-tile {
        min-height: 126px !important;
        padding: 22px !important;
    }

    .track-card span {
        width: 42px;
        height: 42px;
        border-radius: var(--site-radius);
        display: grid;
        place-items: center;
        margin-bottom: 16px;
        background: #eef6ff;
        color: var(--site-blue);
        font-size: 18px;
    }

    .big-stat strong,
    .profile-stat strong,
    .metric-card strong,
    .track-card strong {
        display: block;
        color: var(--site-navy) !important;
        font-size: 34px !important;
        line-height: 1.05 !important;
        font-weight: 800 !important;
        background: none !important;
        -webkit-text-fill-color: currentColor !important;
    }

    .big-stat span,
    .profile-stat span,
    .metric-card span,
    .track-card small {
        display: block;
        margin-top: 9px !important;
        color: var(--site-muted) !important;
        font-size: 12px !important;
        font-weight: 800 !important;
        line-height: 1.45 !important;
        text-transform: none !important;
    }

    .profile-stat.dark,
    .metric-card.dark {
        background: linear-gradient(135deg, var(--site-navy), var(--site-navy-2)) !important;
        color: #ffffff !important;
    }

    .profile-stat.dark strong,
    .metric-card.dark strong,
    .profile-stat.dark span,
    .metric-card.dark span {
        color: #ffffff !important;
    }

    .calendar-card,
    .document-row,
    .partner-line,
    .value-line {
        display: flex !important;
        align-items: flex-start !important;
        gap: 16px !important;
    }

    .calendar-card,
    .document-row {
        padding: 20px !important;
    }

    .calendar-card > span,
    .schedule-row > span {
        width: 56px !important;
        height: 56px !important;
        border-radius: var(--site-radius) !important;
        display: grid !important;
        place-items: center !important;
        flex: 0 0 auto !important;
        background: #fff8e7 !important;
        color: #8a6211 !important;
        font-size: 13px !important;
        font-weight: 800 !important;
        text-align: center !important;
    }

    .document-row > span,
    .partner-line > span,
    .value-line > span {
        width: 22px !important;
        height: 22px !important;
        margin-top: 2px;
        border-radius: 999px;
        flex: 0 0 auto;
        background: #eaf7f2 !important;
        border: 6px solid #bce8da !important;
    }

    .document-row strong,
    .schedule-row strong,
    .calendar-card h3,
    .service-tile strong {
        color: var(--site-navy) !important;
        font-weight: 800 !important;
    }

    .document-row p,
    .calendar-card p,
    .service-tile p,
    .partner-line p {
        margin-top: 6px !important;
        color: var(--site-muted) !important;
        font-size: 13px !important;
        line-height: 1.7 !important;
        font-weight: 600 !important;
    }

    .faq-item {
        padding: 22px 24px !important;
    }

    .faq-item summary {
        cursor: pointer;
        color: var(--site-navy) !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        list-style: none;
    }

    .faq-item summary::-webkit-details-marker {
        display: none;
    }

    .faq-item summary::after {
        float: right;
        content: "\F282";
        font-family: "bootstrap-icons";
        color: var(--site-gold);
        font-size: 14px;
    }

    .faq-item[open] summary::after {
        content: "\F286";
    }

    .faq-item p {
        margin-top: 16px !important;
        color: var(--site-muted) !important;
        font-size: 14px !important;
        line-height: 1.8 !important;
        font-weight: 600 !important;
    }

    .message-panel {
        padding: 28px !important;
    }

    .message-panel h2 {
        color: var(--site-navy) !important;
        font-size: 30px !important;
        line-height: 1.2 !important;
        font-weight: 800 !important;
    }

    .message-panel > p {
        margin-top: 12px !important;
        color: var(--site-muted) !important;
        font-size: 14px !important;
        line-height: 1.75 !important;
        font-weight: 600 !important;
    }

    .form-field {
        display: grid;
        gap: 8px;
    }

    .form-field span {
        color: #40566f;
        font-size: 12px;
        font-weight: 800;
    }

    .form-field input,
    .form-field select,
    .form-field textarea {
        width: 100%;
        border: 1px solid var(--site-line);
        border-radius: var(--site-radius);
        background: #ffffff;
        padding: 13px 14px;
        color: var(--site-ink);
        font: inherit;
        outline: none;
    }

    .form-field input:focus,
    .form-field select:focus,
    .form-field textarea:focus {
        border-color: var(--site-green);
        box-shadow: 0 0 0 4px rgba(15, 159, 122, .1);
    }

    .primary-wide {
        min-height: 48px;
        border: 0;
        border-radius: var(--site-radius);
        background: var(--site-navy);
        color: #ffffff;
        font: inherit;
        font-weight: 800;
        cursor: pointer;
    }

    .map-card {
        min-height: 370px !important;
        position: relative;
        padding: 22px !important;
        background-image: linear-gradient(180deg, rgba(8,33,59,.08), rgba(8,33,59,.14)), url('https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1000&q=85') !important;
        background-size: cover !important;
        background-position: center !important;
    }

    .map-pin {
        position: absolute;
        left: 22px;
        bottom: 22px;
        max-width: calc(100% - 44px);
        border-radius: var(--site-radius);
        background: rgba(255,255,255,.95);
        border: 1px solid var(--site-line);
        padding: 18px;
        box-shadow: var(--site-shadow-sm);
    }

    .map-pin span {
        display: inline-grid;
        width: 34px;
        height: 34px;
        place-items: center;
        border-radius: var(--site-radius);
        background: var(--site-gold);
        color: var(--site-navy);
        font-weight: 800;
    }

    .map-pin strong,
    .map-pin small,
    .map-pin a {
        display: block;
    }

    .map-pin strong {
        margin-top: 12px;
        color: var(--site-navy);
        font-weight: 800;
    }

    .map-pin small {
        margin-top: 4px;
        color: var(--site-muted);
        font-weight: 700;
    }

    .map-pin a {
        margin-top: 12px;
        color: var(--site-blue);
        font-weight: 800;
        text-decoration: none;
    }

    .social-card {
        min-height: 74px;
        display: flex !important;
        align-items: center;
        gap: 14px;
        padding: 18px !important;
        color: var(--site-navy) !important;
        text-decoration: none !important;
        font-weight: 800 !important;
    }

    .social-card span {
        width: 40px;
        height: 40px;
        border-radius: var(--site-radius);
        display: grid;
        place-items: center;
        background: #eef6ff;
        color: var(--site-blue);
    }

    .filter-pill,
    .pager,
    .tag,
    .icon-button,
    .share {
        border-radius: 999px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        font-weight: 800 !important;
    }

    .filter-pill,
    .pager,
    .tag {
        min-height: 38px;
        padding: 0 14px !important;
        border: 1px solid var(--site-line);
        background: #ffffff;
        color: #40566f !important;
        font-size: 12px !important;
    }

    .filter-pill.active,
    .pager.active {
        background: var(--site-navy) !important;
        border-color: var(--site-navy) !important;
        color: #ffffff !important;
    }

    .icon-button,
    .share {
        width: 40px !important;
        height: 40px !important;
        border: 1px solid var(--site-line) !important;
        background: #ffffff !important;
        color: var(--site-navy) !important;
    }

    .featured-news {
        display: grid;
        overflow: hidden;
    }

    @media (min-width: 900px) {
        .featured-news {
            grid-template-columns: 1.05fr .95fr;
        }
    }

    .featured-news h2 {
        color: var(--site-navy) !important;
        font-size: 36px !important;
        line-height: 1.16 !important;
        font-weight: 800 !important;
    }

    .featured-news p:not(.meta-line) {
        margin-top: 18px;
        color: var(--site-muted);
        font-weight: 600;
        line-height: 1.8;
    }

    .play-button {
        width: 64px !important;
        height: 64px !important;
        border-radius: 999px !important;
        display: grid !important;
        place-items: center !important;
        background: #ffffff !important;
        color: var(--site-navy) !important;
        box-shadow: var(--site-shadow) !important;
        text-decoration: none !important;
        font-size: 28px !important;
    }

    .illustration,
    .gallery-tile,
    .portrait-visual,
    .hero-campus-card,
    .preview-web-card,
    .map-visual,
    .showcase-media {
        border-radius: var(--site-radius) !important;
        background-size: cover !important;
        background-position: center !important;
    }

    .illustration {
        min-height: 220px;
        background-color: #dbe7f1 !important;
    }

    .hero-campus-card {
        min-height: 360px !important;
        border: 1px solid rgba(255, 255, 255, .22) !important;
        background-image: linear-gradient(180deg, rgba(8, 33, 59, .08), rgba(8, 33, 59, .42)), url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1100&q=85') !important;
        box-shadow: 0 24px 52px rgba(0, 0, 0, .18) !important;
    }

    .hero-campus-card > *,
    .portrait-visual > * {
        display: none !important;
    }

    .portrait-card {
        min-height: 440px;
        background-image: linear-gradient(180deg, rgba(8, 33, 59, .04), rgba(8, 33, 59, .24)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1000&q=85') !important;
        background-size: cover !important;
        background-position: center !important;
    }

    .portrait-visual {
        min-height: 440px;
        background: transparent !important;
    }

    .illustration.graduates { background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.olympiad { background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.workshop { background-image: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.victory, .illustration.trophy { background-image: url('https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1000&q=85') !important; }
    .illustration.speech { background-image: url('https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.runner, .illustration.sports { background-image: url('https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.dance, .illustration.culture, .illustration.art { background-image: url('https://images.unsplash.com/photo-1504609813442-a8924e83f76e?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.campus, .illustration.meeting { background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1000&q=85') !important; }
    .illustration.robot { background-image: url('https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.alumni, .illustration.graduation { background-image: url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.medalists { background-image: url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1100&q=85') !important; }
    .illustration.study, .illustration.class, .illustration.labroom, .illustration.presentation, .illustration.assembly { background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.basketball-real { background-image: url('https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.band-real { background-image: url('https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.robotics-real { background-image: url('https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=900&q=85') !important; }
    .illustration.dance-real { background-image: url('https://images.unsplash.com/photo-1504609813442-a8924e83f76e?auto=format&fit=crop&w=900&q=85') !important; }

    .academic-portrait,
    .achievement-portrait,
    .student-mentoring,
    .character-collage,
    .teaching-visual,
    .partnership-visual,
    .principal-photo,
    .campus-photo,
    .dorm-study-card,
    .gallery-showcase,
    .video-hero {
        position: relative;
        min-height: 360px;
        border-radius: var(--site-radius) !important;
        overflow: hidden;
        background-size: cover !important;
        background-position: center !important;
        box-shadow: var(--site-shadow-sm) !important;
    }

    .academic-portrait { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.22)), url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1000&q=85') !important; }
    .achievement-portrait { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.22)), url('https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1000&q=85') !important; }
    .student-mentoring { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.22)), url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1000&q=85') !important; }
    .character-collage { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.24)), url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1000&q=85') !important; }
    .teaching-visual { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.22)), url('https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=1000&q=85') !important; }
    .partnership-visual { background-image: linear-gradient(180deg, rgba(8,33,59,.04), rgba(8,33,59,.28)), url('https://images.unsplash.com/photo-1515169067865-5387ec356754?auto=format&fit=crop&w=1000&q=85') !important; }
    .principal-photo { background-image: linear-gradient(180deg, rgba(8,33,59,.04), rgba(8,33,59,.28)), url('https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=900&q=85') !important; }
    .campus-photo.historic, .campus-photo { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.25)), url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1000&q=85') !important; filter: none !important; }
    .dorm-study-card { background-image: linear-gradient(180deg, rgba(8,33,59,.02), rgba(8,33,59,.26)), url('https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=85') !important; }
    .video-hero { background-image: linear-gradient(180deg, rgba(8,33,59,.06), rgba(8,33,59,.58)), url('https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1300&q=85') !important; }

    .floating-quote,
    .quote-card,
    .showcase-card,
    .collab-badge {
        border-radius: var(--site-radius) !important;
        background: rgba(255,255,255,.94) !important;
        color: var(--site-navy) !important;
        border: 1px solid var(--site-line) !important;
        box-shadow: var(--site-shadow-sm) !important;
        font-weight: 800 !important;
    }

    .facility-mosaic,
    .dorm-gallery,
    .academic-grid,
    .masonry-gallery {
        display: grid;
        gap: 16px !important;
    }

    .facility-mosaic,
    .dorm-gallery {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .academic-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .masonry-gallery {
        grid-template-columns: repeat(12, minmax(0, 1fr));
    }

    .masonry-gallery .illustration {
        grid-column: span 4;
        min-height: 240px;
    }

    .masonry-gallery .tall {
        grid-column: span 8;
    }

    .facility-tile {
        min-height: 250px !important;
        border-radius: var(--site-radius) !important;
        overflow: hidden;
        display: flex !important;
        align-items: flex-end !important;
        padding: 18px !important;
        color: #ffffff !important;
        background-size: cover !important;
        background-position: center !important;
        box-shadow: var(--site-shadow-sm) !important;
    }

    .facility-tile span {
        color: #ffffff !important;
        font-weight: 800 !important;
        text-shadow: 0 2px 12px rgba(0,0,0,.28);
    }

    .facility-tile.library-real, .illustration.library { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=85') !important; }
    .facility-tile.lab-real, .facility-tile.science-lab, .illustration.lab { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1581093458791-9f3c3900df7b?auto=format&fit=crop&w=900&q=85') !important; }
    .facility-tile.gym-real, .facility-tile.court-real { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=900&q=85') !important; }
    .facility-tile.classroom-real { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=85') !important; }
    .facility-tile.osis-real { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=85') !important; }
    .facility-tile.dorm-room, .facility-tile.night-study { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=900&q=85') !important; }
    .facility-tile.canteen-real { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.72)), url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=900&q=85') !important; }

    .leader-card .avatar,
    .staff-card .avatar,
    .teacher-card > div {
        background-size: cover !important;
        background-position: center !important;
        filter: none !important;
    }

    .avatar {
        border: 4px solid #ffffff !important;
        box-shadow: var(--site-shadow-sm) !important;
    }

    .leader-card:nth-child(1) .avatar, .staff-card:nth-child(2) .avatar, .teacher-card.teacher-b > div { background-image: url('https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=500&q=85') !important; }
    .leader-card:nth-child(2) .avatar, .staff-card:nth-child(1) .avatar, .teacher-card.teacher-a > div { background-image: url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=500&q=85') !important; }
    .leader-card:nth-child(3) .avatar, .staff-card:nth-child(4) .avatar, .teacher-card.teacher-c > div { background-image: url('https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=500&q=85') !important; }
    .staff-card:nth-child(3) .avatar, .teacher-card.teacher-d > div { background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=500&q=85') !important; }

    .contact-hero-card {
        min-height: 340px !important;
        border-radius: var(--site-radius) !important;
        border: 1px solid rgba(255,255,255,.24) !important;
        background-image: linear-gradient(180deg, rgba(8,33,59,.08), rgba(8,33,59,.38)), url('https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=900&q=85') !important;
        background-size: cover !important;
        background-position: center !important;
        box-shadow: 0 24px 52px rgba(0,0,0,.18) !important;
    }

    .contact-hero-card > span {
        display: none !important;
    }

    .gallery-grid {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .gallery-tile {
        min-height: 250px;
        display: flex;
        align-items: flex-end;
        padding: 18px;
        color: #ffffff;
        font-weight: 800;
        box-shadow: var(--site-shadow-sm);
    }

    .gallery-tile.library { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.7)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=85') !important; }
    .gallery-tile.lab { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.7)), url('https://images.unsplash.com/photo-1581093458791-9f3c3900df7b?auto=format&fit=crop&w=900&q=85') !important; }
    .gallery-tile.hall { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.7)), url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=85') !important; }
    .gallery-tile.court { background-image: linear-gradient(180deg, transparent, rgba(8,33,59,.7)), url('https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=900&q=85') !important; }

    .stat-item strong {
        display: block;
        color: #ffffff;
        font-size: 34px;
        font-weight: 800;
        line-height: 1;
    }

    .stat-item span {
        display: block;
        margin-top: 8px;
        color: rgba(255, 255, 255, .68);
        font-size: 13px;
        font-weight: 700;
    }

    .cta-panel {
        max-width: 1180px;
        margin: 0 auto;
        border-radius: var(--site-radius);
        background: linear-gradient(135deg, var(--site-navy), var(--site-navy-2));
        padding: 56px 28px;
        text-align: center;
        box-shadow: var(--site-shadow);
    }

    .cta-panel h2 {
        color: #ffffff !important;
        font-size: 38px !important;
        line-height: 1.15 !important;
        font-weight: 800 !important;
    }

    .cta-panel p {
        max-width: 680px;
        margin: 14px auto 0;
        color: rgba(255, 255, 255, .72) !important;
        line-height: 1.8;
        font-weight: 600;
    }

    .dark-footer-title {
        color: #ffffff;
        font-size: 14px;
        font-weight: 800;
    }

    .dark-footer-list {
        margin-top: 20px;
        display: grid;
        gap: 11px;
        color: rgba(255, 255, 255, .82);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.6;
    }

    .dark-footer-list a {
        color: rgba(255, 255, 255, .88);
        text-decoration: none;
    }

    .dark-footer-list a:hover {
        color: #ffffff;
    }

    .footer-social {
        min-width: 38px;
        height: 38px;
        border-radius: var(--site-radius);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
        background: rgba(255, 255, 255, .08);
        color: #ffffff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
    }

    .footer-social i {
        font-size: 16px;
    }

    .contact-form input,
    .contact-form textarea,
    .ppdb-form input,
    .ppdb-form select,
    .ppdb-form textarea {
        width: 100%;
        border: 1px solid var(--site-line);
        border-radius: var(--site-radius);
        padding: 12px 14px;
        color: var(--site-ink);
        background: #ffffff;
        font: inherit;
    }

    .contact-form label,
    .ppdb-form label {
        display: block;
        margin-bottom: 7px;
        color: var(--site-muted);
        font-size: 12px;
        font-weight: 800;
    }

    @media (max-width: 1180px) {
        .school-hero h1,
        .public-hero h1,
        .hero-home h1 {
            font-size: 42px !important;
        }
    }

    @media (max-width: 900px) {
        .school-hero h1,
        .public-hero h1,
        .hero-home h1 {
            font-size: 34px !important;
        }

        .hero-campus-card,
        .portrait-card,
        .portrait-visual {
            min-height: 280px !important;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 580px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }

        .cta-panel h2 {
            font-size: 28px !important;
        }

        .gold-button,
        .outline-button,
        .ghost-button {
            width: 100%;
        }
    }
</style>

<style>
    .public-site main > section:not(.school-hero):not(.page-hero):not(.public-hero) {
        padding-top: clamp(64px, 6vw, 96px) !important;
        padding-bottom: clamp(64px, 6vw, 96px) !important;
    }

    .public-site .school-hero > .mx-auto,
    .public-site .page-hero > .mx-auto,
    .public-site .hero-home > .mx-auto {
        min-height: clamp(520px, 62vh, 680px) !important;
    }

    .public-site h1,
    .public-site h2,
    .public-site h3,
    .public-site strong {
        letter-spacing: 0 !important;
    }

    .public-site h2 {
        max-width: 900px;
    }

    .public-site .section-pill,
    .public-site .eyebrow,
    .public-site .meta-line {
        border: 1px solid rgba(214, 166, 58, .16);
        background: #fff7df !important;
        color: #8a6211 !important;
    }

    .public-site .nav-link {
        font-size: 13px !important;
        color: #324b63 !important;
    }

    .public-site .nav-link.active,
    .public-site .nav-link:hover {
        background: #edf5fb !important;
        color: #071f3a !important;
    }

    .public-site .feature-card,
    .public-site .info-card,
    .public-site .news-card,
    .public-site .achievement-card,
    .public-site .teacher-card,
    .public-site .staff-card,
    .public-site .leader-card,
    .public-site .program-card,
    .public-site .soft-card,
    .public-site .calendar-card,
    .public-site .service-tile,
    .public-site .document-row,
    .public-site .step-card,
    .public-site .track-card,
    .public-site .metric-card,
    .public-site .faq-item {
        min-height: auto !important;
        border: 1px solid #d9e5ef !important;
        background: #ffffff !important;
        box-shadow: 0 12px 28px rgba(7, 31, 58, .07) !important;
    }

    .public-site .program-card,
    .public-site .info-card,
    .public-site .soft-card,
    .public-site .step-card,
    .public-site .service-tile {
        display: flex !important;
        flex-direction: column;
        justify-content: flex-start;
        gap: 12px;
        padding: 26px !important;
    }

    .public-site .program-card.dark,
    .public-site aside[class*="bg-[#071f3a]"] {
        background: linear-gradient(135deg, #071f3a 0%, #103d5f 100%) !important;
        color: #ffffff !important;
    }

    .public-site .program-card.dark h3,
    .public-site .program-card.dark p,
    .public-site aside[class*="bg-[#071f3a]"] h3,
    .public-site aside[class*="bg-[#071f3a]"] strong,
    .public-site aside[class*="bg-[#071f3a]"] p {
        color: rgba(255, 255, 255, .9) !important;
    }

    .public-site .program-card.gold {
        background: #fff4dd !important;
        border-color: rgba(214, 166, 58, .4) !important;
    }

    .public-site .academic-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 18px !important;
        align-items: stretch !important;
    }

    .public-site .academic-grid .program-card.wide {
        grid-column: span 2;
    }

    .public-site #kurikulum .academic-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        align-items: stretch !important;
    }

    .public-site #kurikulum .academic-grid .program-card,
    .public-site #kurikulum .academic-grid .program-card.wide {
        grid-column: auto !important;
        grid-row: auto !important;
        width: 100% !important;
        min-height: 220px !important;
        height: 100% !important;
    }

    .public-site .facility-mosaic {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 18px !important;
    }

    .public-site .facility-tile {
        min-height: 230px !important;
        padding: 22px !important;
        align-items: flex-end !important;
        border: 1px solid rgba(255, 255, 255, .16) !important;
    }

    .public-site .facility-tile span,
    .public-site .gallery-tile span {
        display: inline-flex;
        width: fit-content;
        border-radius: 6px;
        background: rgba(7, 31, 58, .72);
        padding: 9px 12px;
        color: #ffffff !important;
        text-shadow: none !important;
    }

    .public-site .stat-item strong {
        font-size: clamp(30px, 3vw, 42px) !important;
    }

    .public-site .stat-item span {
        color: rgba(255, 255, 255, .82) !important;
        font-size: 12px !important;
    }

    .public-site .cta-panel {
        border-radius: 8px !important;
        background: linear-gradient(135deg, #071f3a 0%, #0f4c5c 100%) !important;
        box-shadow: 0 24px 60px rgba(7, 31, 58, .18) !important;
    }

    .public-site .leadership-panel {
        border: 1px solid #d9e5ef;
        border-radius: 8px;
        background: linear-gradient(135deg, #ffffff 0%, #f5f9fc 100%);
        box-shadow: 0 18px 45px rgba(7, 31, 58, .08);
    }

    .public-site .leadership-card {
        border-radius: 8px;
        background: #071f3a;
        color: #ffffff;
        padding: clamp(26px, 4vw, 46px);
    }

    .public-site .leadership-card p,
    .public-site .leadership-card blockquote {
        color: rgba(255, 255, 255, .84) !important;
    }

    .public-site .commitment-list {
        display: grid;
        gap: 14px;
    }

    .public-site .commitment-list li {
        display: flex;
        gap: 12px;
        border: 1px solid #d9e5ef;
        border-radius: 8px;
        background: #ffffff;
        padding: 16px;
        color: #334e68;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.6;
    }

    .public-site .commitment-list li::before {
        display: grid;
        flex: 0 0 auto;
        width: 28px;
        height: 28px;
        place-items: center;
        border-radius: 999px;
        background: #fff4dd;
        color: #8a6211;
        content: "\F26A";
        font-family: "bootstrap-icons";
        font-size: 13px;
    }

    @media (max-width: 1024px) {
        .public-site .academic-grid,
        .public-site .facility-mosaic {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .public-site .academic-grid .program-card.wide {
            grid-column: auto !important;
        }
    }

    @media (max-width: 640px) {
        .public-site .academic-grid,
        .public-site .facility-mosaic,
        .public-site .gallery-grid {
            grid-template-columns: 1fr !important;
        }

        .public-site .school-hero h1,
        .public-site .page-hero h1,
        .public-site .hero-home h1 {
            font-size: 36px !important;
        }

        .public-site .school-hero > .mx-auto,
        .public-site .page-hero > .mx-auto,
        .public-site .hero-home > .mx-auto {
            min-height: auto !important;
        }
    }
</style>

<style>
    .public-site {
        background:
            linear-gradient(180deg, rgba(246, 249, 252, .96), rgba(255, 255, 255, 1) 42%, rgba(246, 249, 252, .92)),
            #f6f9fc;
    }

    .site-header {
        border-bottom: 1px solid rgba(7, 31, 58, .07);
    }

    .public-site .nav-link {
        position: relative;
        padding: 9px 0;
    }

    .public-site .nav-link::after {
        position: absolute;
        right: 0;
        bottom: 1px;
        left: 0;
        height: 2px;
        border-radius: 999px;
        background: linear-gradient(90deg, #d6a63a, #18a999, #e85d5a);
        content: "";
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .24s ease;
    }

    .public-site .nav-link:hover::after,
    .public-site .nav-link.active::after {
        transform: scaleX(1);
    }

    .public-site .school-hero,
    .public-site .public-hero {
        position: relative;
        overflow: hidden;
        isolation: isolate;
    }

    .public-site .school-hero::before,
    .public-site .public-hero::before {
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            linear-gradient(120deg, transparent 0 34%, rgba(240, 199, 94, .18) 34% 35%, transparent 35% 62%, rgba(24, 169, 153, .14) 62% 63%, transparent 63%),
            repeating-linear-gradient(135deg, rgba(255, 255, 255, .08) 0 1px, transparent 1px 22px);
        content: "";
        opacity: .72;
        animation: heroPatternShift 18s linear infinite;
    }

    .public-site .section-pill,
    .public-site .eyebrow {
        letter-spacing: .18em;
    }

    .public-site .gold-button,
    .public-site .outline-button,
    .public-site .ghost-button {
        position: relative;
        overflow: hidden;
        transform: translateZ(0);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }

    .public-site .gold-button::after,
    .public-site .outline-button::after,
    .public-site .ghost-button::after {
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg, transparent 0 30%, rgba(255, 255, 255, .4) 46%, transparent 62% 100%);
        content: "";
        transform: translateX(-120%);
        transition: transform .7s ease;
    }

    .public-site .gold-button:hover,
    .public-site .outline-button:hover,
    .public-site .ghost-button:hover {
        transform: translateY(-2px);
    }

    .public-site .gold-button:hover::after,
    .public-site .outline-button:hover::after,
    .public-site .ghost-button:hover::after {
        transform: translateX(120%);
    }

    .public-site .feature-card,
    .public-site .news-card,
    .public-site .program-card,
    .public-site .soft-card,
    .public-site .profile-stat,
    .public-site .achievement-card,
    .public-site .gallery-tile,
    .public-site .facility-tile,
    .public-site .timeline-row,
    .public-site .org-node {
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease, filter .24s ease;
    }

    .public-site .feature-card:hover,
    .public-site .news-card:hover,
    .public-site .program-card:hover,
    .public-site .soft-card:hover,
    .public-site .profile-stat:hover,
    .public-site .achievement-card:hover,
    .public-site .gallery-tile:hover,
    .public-site .facility-tile:hover,
    .public-site .timeline-row:hover,
    .public-site .org-node:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 55px rgba(7, 31, 58, .14);
    }

    .public-site .feature-card:nth-child(5n + 1) .feature-icon,
    .public-site .soft-card:nth-child(3n + 1) span {
        background: linear-gradient(135deg, #071f3a, #0f4c5c);
        color: #f0c75e;
    }

    .public-site .feature-card:nth-child(5n + 2) .feature-icon,
    .public-site .soft-card:nth-child(3n + 2) span {
        background: linear-gradient(135deg, #18a999, #0f4c5c);
        color: #ffffff;
    }

    .public-site .feature-card:nth-child(5n + 3) .feature-icon,
    .public-site .soft-card:nth-child(3n + 3) span {
        background: linear-gradient(135deg, #d6a63a, #e85d5a);
        color: #071f3a;
    }

    .public-site .profile-stat,
    .public-site .vision-card,
    .public-site .value-card,
    .public-site .cta-panel {
        position: relative;
        overflow: hidden;
    }

    .public-site .profile-stat::before,
    .public-site .vision-card::before,
    .public-site .value-card::before,
    .public-site .cta-panel::before {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(135deg, rgba(255, 255, 255, .22), transparent 34%),
            repeating-linear-gradient(90deg, rgba(255, 255, 255, .08) 0 1px, transparent 1px 18px);
        content: "";
        opacity: .42;
        pointer-events: none;
    }

    .public-site .value-card {
        border: 1px solid rgba(214, 166, 58, .46) !important;
        background: #fff4dd !important;
        color: #071f3a !important;
    }

    .public-site .value-card h3 {
        color: #071f3a !important;
    }

    .public-site .value-card ul,
    .public-site .value-card li {
        color: #334e68 !important;
    }

    .public-site .text-white\/55,
    .public-site .text-white\/56,
    .public-site .text-white\/58,
    .public-site .text-white\/72,
    .public-site .text-white\/74,
    .public-site .text-white\/76,
    .public-site .text-white\/78,
    .public-site .text-white\/80 {
        color: rgba(255, 255, 255, .84) !important;
    }

    .public-site .text-\[\#6b7f91\] {
        color: #52687d !important;
    }

    .public-site .dark-footer-title {
        color: #f8fbff !important;
    }

    .public-site .dark-footer-list {
        color: rgba(255, 255, 255, .82) !important;
    }

    .public-site .dark-footer-list a {
        color: rgba(255, 255, 255, .88) !important;
    }

    .public-site .dark-footer-list a:hover {
        color: #f0c75e !important;
    }

    .public-site .gallery-tile span,
    .public-site .facility-tile span {
        backdrop-filter: blur(10px);
    }

    .public-site footer {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg, #061a31 0%, #082946 52%, #0c3f4c 100%);
    }

    .public-site footer::before {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(120deg, transparent 0 58%, rgba(214, 166, 58, .11) 58% 59%, transparent 59%),
            repeating-linear-gradient(135deg, rgba(255, 255, 255, .055) 0 1px, transparent 1px 24px);
        content: "";
        pointer-events: none;
    }

    .public-site footer > div {
        position: relative;
    }

    .public-site .footer-social {
        transition: transform .22s ease, background-color .22s ease, color .22s ease;
    }

    .public-site .footer-social:hover {
        background: #f0c75e;
        color: #071f3a;
        transform: translateY(-3px);
    }

    .public-site .footer-text-link,
    .public-site .footer-internal-link {
        display: inline-flex;
        align-items: center;
        min-height: 38px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .12em;
        text-transform: uppercase;
        transition: color .22s ease, border-color .22s ease, background-color .22s ease;
    }

    .public-site .footer-text-link {
        border: 1px solid rgba(240, 199, 94, .28);
        padding: 0 14px;
        color: #f0c75e;
    }

    .public-site .footer-text-link:hover {
        border-color: rgba(240, 199, 94, .7);
        background: rgba(240, 199, 94, .08);
        color: #ffffff;
    }

    .public-site .footer-internal-link {
        padding: 0;
        color: rgba(255, 255, 255, .64);
    }

    .public-site .footer-internal-link:hover {
        color: #ffffff;
    }

    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .68s ease, transform .68s ease;
        transition-delay: var(--reveal-delay, 0ms);
    }

    .reveal-on-scroll.is-visible {
        opacity: 1;
        transform: none;
    }

    @keyframes heroPatternShift {
        0% {
            background-position: 0 0, 0 0;
        }

        100% {
            background-position: 220px 0, 120px 120px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .public-site *,
        .public-site *::before,
        .public-site *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }

        .reveal-on-scroll {
            opacity: 1;
            transform: none;
        }
    }

</style>

<style>
    .public-site {
        --readable-navy: #071f3a;
        --readable-body: #334e68;
        --readable-muted: #52687d;
    }

    .public-site section[id] {
        scroll-margin-top: calc(var(--header-height, 84px) + 20px);
    }

    .public-site .reveal-on-scroll {
        opacity: 1 !important;
        transform: none !important;
        transition-delay: 0ms !important;
    }

    .public-site .hero-kesiswaan {
        background-image: linear-gradient(90deg, rgba(8,33,59,.86), rgba(8,33,59,.34)), url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1800&q=85') !important;
        background-size: cover !important;
        background-position: center !important;
    }

    .public-site .step-card {
        position: relative;
        min-height: 168px !important;
        padding: 28px !important;
        background: #ffffff !important;
        color: var(--readable-navy) !important;
    }

    .public-site .step-card span {
        position: absolute;
        top: 18px;
        right: 22px;
        color: rgba(201, 150, 44, .34) !important;
        font-size: clamp(42px, 5vw, 60px) !important;
        line-height: 1 !important;
        font-weight: 900 !important;
    }

    .public-site .step-card h3 {
        max-width: calc(100% - 56px);
        margin-top: 58px !important;
        color: var(--readable-navy) !important;
        font-size: 17px !important;
        line-height: 1.35 !important;
        font-weight: 900 !important;
    }

    .public-site .step-card p {
        margin-top: 10px !important;
        color: var(--readable-muted) !important;
        font-size: 13px !important;
        line-height: 1.65 !important;
        font-weight: 700 !important;
    }

    .public-site aside[class*="bg-[#071f3a]"] > h3 {
        color: #ffffff !important;
    }

    .public-site aside[class*="bg-[#071f3a]"] .service-tile,
    .public-site aside[class*="bg-[#071f3a]"] .schedule-row {
        background: #ffffff !important;
        border-color: rgba(217, 229, 239, .96) !important;
        color: var(--readable-navy) !important;
    }

    .public-site aside[class*="bg-[#071f3a]"] .service-tile strong,
    .public-site aside[class*="bg-[#071f3a]"] .schedule-row strong {
        color: var(--readable-navy) !important;
        font-size: 15px !important;
        line-height: 1.35 !important;
        font-weight: 900 !important;
    }

    .public-site aside[class*="bg-[#071f3a]"] .service-tile p {
        color: var(--readable-muted) !important;
        font-size: 13px !important;
        line-height: 1.65 !important;
        font-weight: 700 !important;
    }

    .public-site .schedule-row {
        display: flex !important;
        align-items: center !important;
        gap: 16px !important;
        min-height: 58px !important;
        padding: 0 16px 0 0 !important;
        overflow: hidden;
    }

    .public-site .schedule-row > span {
        min-height: 58px !important;
        height: 100% !important;
        border-radius: 0 !important;
    }

    .public-site .program-card,
    .public-site .info-card,
    .public-site .soft-card,
    .public-site .document-row,
    .public-site .calendar-card,
    .public-site .faq-item,
    .public-site .service-tile,
    .public-site .news-card,
    .public-site .achievement-card,
    .public-site .club-card {
        color: var(--readable-body) !important;
    }

    .public-site .program-card h2,
    .public-site .program-card h3,
    .public-site .info-card h2,
    .public-site .info-card h3,
    .public-site .soft-card h2,
    .public-site .soft-card h3,
    .public-site .document-row strong,
    .public-site .calendar-card h3,
    .public-site .faq-item summary,
    .public-site .news-card h3,
    .public-site .achievement-card h3,
    .public-site .club-card h3 {
        color: var(--readable-navy) !important;
    }

    .public-site .program-card p,
    .public-site .info-card p,
    .public-site .soft-card p,
    .public-site .document-row p,
    .public-site .calendar-card p,
    .public-site .faq-item p,
    .public-site .news-card p,
    .public-site .achievement-card p,
    .public-site .club-card p {
        color: var(--readable-muted) !important;
    }

    .public-site .program-card.dark h3,
    .public-site .program-card.dark strong {
        color: #ffffff !important;
    }

    .public-site .program-card.dark p {
        color: rgba(255, 255, 255, .86) !important;
    }

    .public-site .facility-tile,
    .public-site .gallery-tile,
    .public-site .illustration {
        position: relative;
        isolation: isolate;
        background-color: #27435b !important;
        background-blend-mode: normal, normal, multiply;
    }

    .public-site .facility-mosaic .facility-tile {
        grid-column: auto !important;
        grid-row: auto !important;
    }

    .public-site .facility-tile::before,
    .public-site .gallery-tile::before,
    .public-site .illustration::before {
        position: absolute;
        inset: 0;
        z-index: -1;
        background:
            radial-gradient(circle at 18% 18%, rgba(240, 199, 94, .36), transparent 28%),
            radial-gradient(circle at 82% 24%, rgba(24, 169, 153, .30), transparent 30%),
            linear-gradient(135deg, #103d5f, #071f3a 58%, #0f4c5c);
        content: "";
        opacity: 0;
    }

    .public-site .facility-tile::after,
    .public-site .gallery-tile::after {
        position: absolute;
        inset: 0;
        z-index: -1;
        background: linear-gradient(180deg, rgba(7,31,58,0) 35%, rgba(7,31,58,.78) 100%);
        content: "";
    }

    .public-site .facility-tile.science-lab,
    .public-site .facility-tile.lab-real,
    .public-site .gallery-tile.lab,
    .public-site .illustration.lab {
        background-image:
            linear-gradient(180deg, transparent 35%, rgba(8,33,59,.80)),
            radial-gradient(circle at 28% 46%, rgba(255,255,255,.86) 0 1.6rem, transparent 1.7rem),
            radial-gradient(circle at 69% 48%, rgba(214,166,58,.82) 0 2.2rem, transparent 2.3rem),
            linear-gradient(90deg, transparent 0 30%, #eaf4f7 30% 34%, transparent 34% 52%, #d4e1e8 52% 57%, transparent 57%),
            linear-gradient(180deg, #a9d8df 0 48%, #dfe9ee 48% 64%, #17344f 64% 100%) !important;
    }

    .public-site .facility-tile.lab-real {
        background-image:
            linear-gradient(180deg, transparent 35%, rgba(8,33,59,.80)),
            linear-gradient(90deg, transparent 0 13%, #071f3a 13% 29%, transparent 29% 43%, #071f3a 43% 59%, transparent 59% 73%, #071f3a 73% 89%, transparent 89%),
            linear-gradient(90deg, transparent 0 15%, #19a99a 15% 27%, transparent 27% 45%, #d6a63a 45% 57%, transparent 57% 75%, #19a99a 75% 87%, transparent 87%),
            radial-gradient(circle at 74% 26%, #d6a63a 0 2.5rem, transparent 2.6rem),
            linear-gradient(180deg, #d9e9f2 0 22%, #d7e7fa 22% 52%, #12395f 52% 100%) !important;
    }

    .public-site .facility-tile.library-real,
    .public-site .gallery-tile.library,
    .public-site .illustration.library {
        background-image:
            linear-gradient(180deg, transparent 35%, rgba(8,33,59,.80)),
            repeating-linear-gradient(90deg, #f4efe6 0 1.1rem, #8f3f2b 1.1rem 2rem, #d6a63a 2rem 3rem, #18364d 3rem 4rem, #efe2ca 4rem 5rem),
            linear-gradient(180deg, #7b5638 0 68%, #071f3a 68% 100%) !important;
    }

    .public-site .facility-tile.classroom-real,
    .public-site .gallery-tile.hall {
        background-image:
            linear-gradient(180deg, transparent 35%, rgba(8,33,59,.80)),
            linear-gradient(90deg, transparent 0 13%, #fff8e7 13% 26%, transparent 26% 43%, #fff8e7 43% 56%, transparent 56% 73%, #fff8e7 73% 86%, transparent 86%),
            radial-gradient(circle at 20% 62%, #bd7c5c 0 1.3rem, transparent 1.4rem),
            radial-gradient(circle at 50% 62%, #94684c 0 1.3rem, transparent 1.4rem),
            radial-gradient(circle at 80% 62%, #c98c65 0 1.3rem, transparent 1.4rem),
            linear-gradient(90deg, transparent 0 14%, #1f7a66 14% 58%, transparent 58% 66%, #dbeafe 66% 91%, transparent 91%),
            linear-gradient(180deg, #e8f0f4 0 45%, #d7b889 45% 100%) !important;
    }

    .public-site .facility-tile.court-real,
    .public-site .gallery-tile.court {
        background-image:
            linear-gradient(180deg, transparent 35%, rgba(8,33,59,.80)),
            linear-gradient(90deg, transparent 0 13%, #fff8e7 13% 26%, transparent 26% 43%, #fff8e7 43% 56%, transparent 56% 73%, #fff8e7 73% 86%, transparent 86%),
            radial-gradient(circle at 20% 62%, #bd7c5c 0 1.3rem, transparent 1.4rem),
            radial-gradient(circle at 50% 62%, #94684c 0 1.3rem, transparent 1.4rem),
            radial-gradient(circle at 80% 62%, #c98c65 0 1.3rem, transparent 1.4rem),
            linear-gradient(90deg, transparent 0 14%, #1f7a66 14% 58%, transparent 58% 66%, #dbeafe 66% 91%, transparent 91%),
            linear-gradient(180deg, #e8f0f4 0 45%, #d7b889 45% 100%) !important;
    }

    .public-site .illustration.graduates,
    .public-site .illustration.graduation,
    .public-site .illustration.campus,
    .public-site .illustration.meeting,
    .public-site .illustration.study,
    .public-site .illustration.class,
    .public-site .illustration.assembly {
        background-image:
            linear-gradient(180deg, transparent 38%, rgba(8,33,59,.78)),
            linear-gradient(90deg, transparent 0 13%, #fff8e7 13% 26%, transparent 26% 43%, #fff8e7 43% 56%, transparent 56% 73%, #fff8e7 73% 86%, transparent 86%),
            radial-gradient(circle at 20% 62%, #bd7c5c 0 1.3rem, transparent 1.4rem),
            radial-gradient(circle at 50% 62%, #94684c 0 1.3rem, transparent 1.4rem),
            radial-gradient(circle at 80% 62%, #c98c65 0 1.3rem, transparent 1.4rem),
            linear-gradient(90deg, transparent 0 14%, #1f7a66 14% 58%, transparent 58% 66%, #dbeafe 66% 91%, transparent 91%),
            linear-gradient(180deg, #e8f0f4 0 45%, #d7b889 45% 100%) !important;
    }

    .public-site .illustration.olympiad,
    .public-site .illustration.labroom,
    .public-site .illustration.robot,
    .public-site .illustration.presentation,
    .public-site .illustration.robotics-real {
        background-image:
            linear-gradient(180deg, transparent 38%, rgba(8,33,59,.78)),
            radial-gradient(circle at 28% 46%, rgba(255,255,255,.86) 0 1.6rem, transparent 1.7rem),
            radial-gradient(circle at 69% 48%, rgba(214,166,58,.82) 0 2.2rem, transparent 2.3rem),
            linear-gradient(90deg, transparent 0 30%, #eaf4f7 30% 34%, transparent 34% 52%, #d4e1e8 52% 57%, transparent 57%),
            linear-gradient(180deg, #a9d8df 0 48%, #dfe9ee 48% 64%, #17344f 64% 100%) !important;
    }

    .public-site .illustration.victory,
    .public-site .illustration.trophy,
    .public-site .illustration.medalists,
    .public-site .illustration.speech,
    .public-site .illustration.workshop,
    .public-site .illustration.alumni {
        background-image:
            linear-gradient(180deg, transparent 38%, rgba(8,33,59,.78)),
            linear-gradient(90deg, transparent 0 13%, #071f3a 13% 29%, transparent 29% 43%, #071f3a 43% 59%, transparent 59% 73%, #071f3a 73% 89%, transparent 89%),
            linear-gradient(90deg, transparent 0 15%, #19a99a 15% 27%, transparent 27% 45%, #d6a63a 45% 57%, transparent 57% 75%, #19a99a 75% 87%, transparent 87%),
            radial-gradient(circle at 74% 26%, #d6a63a 0 2.5rem, transparent 2.6rem),
            linear-gradient(180deg, #d9e9f2 0 22%, #d7e7fa 22% 52%, #12395f 52% 100%) !important;
    }

    .public-site .illustration.runner,
    .public-site .illustration.sports,
    .public-site .illustration.dance,
    .public-site .illustration.culture,
    .public-site .illustration.art,
    .public-site .illustration.basketball-real,
    .public-site .illustration.band-real,
    .public-site .illustration.dance-real {
        background-image:
            linear-gradient(180deg, transparent 38%, rgba(8,33,59,.78)),
            repeating-linear-gradient(90deg, #f4efe6 0 1.1rem, #8f3f2b 1.1rem 2rem, #d6a63a 2rem 3rem, #18364d 3rem 4rem, #efe2ca 4rem 5rem),
            linear-gradient(180deg, #7b5638 0 68%, #071f3a 68% 100%) !important;
    }

    .public-site .facility-tile span,
    .public-site .gallery-tile span,
    .public-site .visual-label {
        position: relative;
        z-index: 1;
        background: rgba(6, 26, 49, .82) !important;
        color: #ffffff !important;
        box-shadow: 0 10px 22px rgba(0, 0, 0, .18);
    }

    @media (max-width: 640px) {
        .public-site .step-card {
            min-height: 150px !important;
        }

        .public-site .step-card h3 {
            max-width: none;
            margin-top: 50px !important;
        }
    }
</style>
