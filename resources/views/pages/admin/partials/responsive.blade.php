<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --admin-navy: #0a2540;
        --admin-navy-2: #10385f;
        --admin-ink: #172033;
        --admin-muted: #667085;
        --admin-line: #d9e1ec;
        --admin-soft: #f4f7fb;
        --admin-card: #ffffff;
        --admin-gold: #c9962c;
        --admin-green: #0f9f7a;
        --admin-blue: #2563eb;
        --admin-red: #dc2626;
        --admin-radius: 8px;
        --admin-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
        --admin-shadow-sm: 0 4px 14px rgba(15, 23, 42, 0.06);
    }

    html {
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }

    body:has(.admin-container) {
        overflow: auto !important;
        font-family: "Plus Jakarta Sans", "Manrope", "Segoe UI", ui-sans-serif, system-ui, sans-serif !important;
        background: var(--admin-soft) !important;
        color: var(--admin-ink) !important;
        letter-spacing: 0 !important;
    }

    .admin-container,
    .admin-container * {
        letter-spacing: 0 !important;
    }

    .admin-container a[href*="/admin/guru"],
    .admin-container a[href*="/admin/pengumuman"],
    .admin-container a[href*="/admin/galeri"] {
        display: none !important;
    }

    .admin-container {
        min-height: 100vh !important;
        width: 100% !important;
        background:
            linear-gradient(180deg, #f8fafc 0%, #eef4f9 100%) !important;
    }

    .admin-container .sidebar {
        width: 272px !important;
        background: linear-gradient(180deg, #08213c 0%, #0a2540 52%, #06182d 100%) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 14px 0 34px rgba(7, 31, 58, 0.18) !important;
    }

    .admin-container .sidebar > div:first-child {
        padding: 24px 18px !important;
    }

    .admin-container .sidebar > div:first-child > div:first-child {
        min-height: 64px !important;
        margin-bottom: 22px !important;
        padding: 10px !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: var(--admin-radius) !important;
        background: rgba(255, 255, 255, 0.045) !important;
    }

    .admin-container .sidebar > div:first-child > div:first-child > div:first-child {
        width: 42px !important;
        height: 42px !important;
        border-radius: var(--admin-radius) !important;
        background: linear-gradient(135deg, var(--admin-gold), #e2b44c) !important;
        color: #06182d !important;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35) !important;
    }

    .admin-container .sidebar nav {
        gap: 6px !important;
    }

    .admin-container .nav-item {
        min-height: 44px !important;
        padding: 11px 12px !important;
        border: 0 !important;
        border-radius: var(--admin-radius) !important;
        color: #b9c5d3 !important;
        display: flex !important;
        align-items: center !important;
        gap: 11px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        line-height: 1.2 !important;
        text-decoration: none !important;
        transition: background .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease !important;
        position: relative !important;
    }

    .admin-container .nav-item::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .nav-item:nth-child(2)::before,
    .admin-container .nav-item:nth-child(5)::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .nav-item:nth-child(3)::before,
    .admin-container .nav-item:nth-child(7)::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .nav-item:nth-child(4)::before,
    .admin-container .nav-item:nth-child(8)::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .nav-item:not(.active-nav):hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, .035) !important;
        transform: translateX(1px) !important;
    }

    .admin-container .nav-item.active-nav {
        color: #ffffff !important;
        background: rgba(255, 255, 255, .14) !important;
        box-shadow: inset 3px 0 0 var(--admin-gold), 0 8px 18px rgba(0, 0, 0, .12) !important;
        font-weight: 800 !important;
    }

    .admin-container .nav-item.active-nav::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .admin-nav-icon {
        width: 30px !important;
        height: 30px !important;
        min-width: 30px !important;
        border-radius: 8px !important;
        display: inline-grid !important;
        place-items: center !important;
        background: rgba(255, 255, 255, .09) !important;
        border: 1px solid rgba(255, 255, 255, .12) !important;
        color: #c8d6e6 !important;
        font-size: 15px !important;
        line-height: 1 !important;
    }

    .admin-container .nav-item.active-nav .admin-nav-icon {
        background: linear-gradient(135deg, var(--admin-gold), #efc766) !important;
        color: #06182d !important;
        border-color: rgba(255, 255, 255, .28) !important;
    }

    .admin-container .sidebar form button {
        width: 100% !important;
        min-height: 42px !important;
        justify-content: center !important;
        border-radius: var(--admin-radius) !important;
        background: rgba(220, 38, 38, .11) !important;
        border: 1px solid rgba(248, 113, 113, .20) !important;
        color: #fecaca !important;
        font-size: 13px !important;
    }

    .admin-container .main-content {
        min-width: 0 !important;
        background: transparent !important;
    }

    .admin-container .header,
    .admin-container .main-content > .header,
    .admin-container .content-padding > .header {
        display: none !important;
        visibility: hidden !important;
        width: 0 !important;
        height: 0 !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        border: 0 !important;
        box-shadow: none !important;
        overflow: hidden !important;
        position: static !important;
        inset: auto !important;
        z-index: -1 !important;
    }

    .admin-container .header input,
    .admin-container input,
    .admin-container select,
    .admin-container textarea,
    .admin-container .custom-input,
    .admin-container .custom-textarea {
        border: 1px solid var(--admin-line) !important;
        border-radius: var(--admin-radius) !important;
        background: #ffffff !important;
        color: var(--admin-ink) !important;
        box-shadow: none !important;
        outline: none !important;
        font-family: inherit !important;
    }

    .admin-container .header input:focus,
    .admin-container input:focus,
    .admin-container select:focus,
    .admin-container textarea:focus,
    .admin-container .custom-input:focus,
    .admin-container .custom-textarea:focus {
        border-color: rgba(15, 159, 122, .65) !important;
        box-shadow: 0 0 0 4px rgba(15, 159, 122, .10) !important;
    }

    .admin-container .content-padding {
        width: 100% !important;
        max-width: 1380px !important;
        margin: 0 auto !important;
        padding: 34px 30px !important;
    }

    .admin-container h1 {
        color: var(--admin-navy) !important;
        font-size: 30px !important;
        line-height: 1.16 !important;
        font-weight: 800 !important;
    }

    .admin-container h2,
    .admin-container h3 {
        color: var(--admin-navy) !important;
        line-height: 1.25 !important;
        font-weight: 800 !important;
    }

    .admin-container p {
        color: var(--admin-muted) !important;
        line-height: 1.65 !important;
    }

    .admin-container .stats-grid,
    .admin-container .quick-access-grid {
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)) !important;
        gap: 16px !important;
    }

    .admin-container .faculty-grid,
    .admin-container .gallery-admin-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
        gap: 18px !important;
    }

    .admin-container .main-grid,
    .admin-container .settings-grid {
        grid-template-columns: minmax(0, 1fr) minmax(280px, 360px) !important;
        gap: 18px !important;
    }

    .admin-container .card,
    .admin-container .table-container,
    .admin-container .faculty-card,
    .admin-container .media-card,
    .admin-container .preview-web-card,
    .admin-container .upload-area,
    .admin-container .editor-box,
    .admin-container .filter-container {
        border: 1px solid rgba(217, 225, 236, .9) !important;
        border-radius: var(--admin-radius) !important;
        background: var(--admin-card) !important;
        box-shadow: var(--admin-shadow-sm) !important;
    }

    .admin-container .card,
    .admin-container .table-container {
        padding: 22px !important;
    }

    .admin-container .card[style*="background: #071f3a"],
    .admin-container .card[style*="background:#071f3a"] {
        background: linear-gradient(135deg, var(--admin-navy), #123e66) !important;
        color: #ffffff !important;
        border-color: rgba(255, 255, 255, .08) !important;
    }

    .admin-container [style*="background: #071f3a"],
    .admin-container [style*="background:#071f3a"] {
        color: #ffffff !important;
    }

    .admin-container [style*="background: #071f3a"] h1,
    .admin-container [style*="background: #071f3a"] h2,
    .admin-container [style*="background: #071f3a"] h3,
    .admin-container [style*="background:#071f3a"] h1,
    .admin-container [style*="background:#071f3a"] h2,
    .admin-container [style*="background:#071f3a"] h3 {
        color: #ffffff !important;
    }

    .admin-container [style*="background: #071f3a"] p,
    .admin-container [style*="background:#071f3a"] p {
        color: rgba(255, 255, 255, .76) !important;
    }

    .admin-container [style*="background: #071f3a"] strong,
    .admin-container [style*="background:#071f3a"] strong {
        color: #ffffff !important;
    }

    .admin-container .stats-grid .card {
        min-height: 126px !important;
        position: relative !important;
        overflow: hidden !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    .admin-container .stats-grid .card::before {
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        background: var(--admin-green);
        content: "";
    }

    .admin-container .stats-grid .card:nth-child(2)::before { background: var(--admin-gold); }
    .admin-container .stats-grid .card:nth-child(3)::before { background: var(--admin-blue); }
    .admin-container .stats-grid .card:nth-child(4)::before { background: var(--admin-red); }

    .admin-container .stats-grid .card:hover,
    .admin-container .quick-access-grid .card:hover,
    .admin-container .faculty-card:hover,
    .admin-container .media-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: var(--admin-shadow) !important;
    }

    .admin-container .quick-access-grid .card {
        min-height: 106px !important;
        padding: 16px !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        justify-content: space-between !important;
        gap: 12px !important;
        color: var(--admin-navy) !important;
        text-align: left !important;
    }

    .admin-container .quick-access-grid .card::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .quick-access-grid .card:nth-child(2)::before,
    .admin-container .quick-access-grid .card:nth-child(5)::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .quick-access-grid .card:nth-child(3)::before,
    .admin-container .quick-access-grid .card:nth-child(6)::before {
        content: none !important;
        display: none !important;
    }

    .admin-container .admin-quick-icon {
        width: 36px !important;
        height: 36px !important;
        border-radius: 8px !important;
        display: inline-grid !important;
        place-items: center !important;
        background: #eef6ff !important;
        border: 1px solid #d8e7ff !important;
        color: var(--admin-blue) !important;
        font-size: 17px !important;
        line-height: 1 !important;
    }

    .admin-container .quick-access-grid .card:nth-child(1) .admin-quick-icon,
    .admin-container .quick-access-grid .card:nth-child(4) .admin-quick-icon {
        background: #ecfdf5 !important;
        border-color: #ccefe3 !important;
        color: var(--admin-green) !important;
    }

    .admin-container .quick-access-grid .card:nth-child(3) .admin-quick-icon,
    .admin-container .quick-access-grid .card:nth-child(6) .admin-quick-icon {
        background: #fff8e7 !important;
        border-color: #f2dfaa !important;
        color: var(--admin-gold) !important;
    }

    .admin-container .quick-access-grid .card > div {
        color: var(--admin-navy) !important;
        font-size: 12px !important;
        line-height: 1.35 !important;
        letter-spacing: 0 !important;
        text-transform: none !important;
    }

    .admin-container .data-table,
    .admin-container .announcement-table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-top: 14px !important;
        white-space: normal !important;
    }

    .admin-container .data-table th,
    .admin-container .announcement-table th {
        padding: 12px 14px !important;
        border-bottom: 1px solid var(--admin-line) !important;
        color: #6b778c !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        background: #f8fafc !important;
    }

    .admin-container .data-table td,
    .admin-container .announcement-table td {
        padding: 14px !important;
        border-bottom: 1px solid #edf2f7 !important;
        color: var(--admin-ink) !important;
        font-size: 13.5px !important;
        vertical-align: middle !important;
    }

    .admin-container .data-table tbody tr:hover,
    .admin-container .announcement-table tbody tr:hover {
        background: #f9fbfd !important;
    }

    .admin-container .status-badge,
    .admin-container .status-pill,
    .admin-container .badge,
    .admin-container .badge-target {
        border-radius: 999px !important;
        padding: 5px 10px !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        line-height: 1 !important;
    }

    .admin-container .filter-container {
        padding: 14px !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .admin-container .filter-tabs {
        gap: 8px !important;
        padding: 4px !important;
        border: 1px solid var(--admin-line) !important;
        border-radius: var(--admin-radius) !important;
        background: #f8fafc !important;
        width: fit-content !important;
        margin-bottom: 18px !important;
    }

    .admin-container .tab {
        border-radius: 6px !important;
        padding: 9px 13px !important;
        color: var(--admin-muted) !important;
        background: transparent !important;
        font-weight: 800 !important;
    }

    .admin-container .tab.active {
        color: #ffffff !important;
        background: var(--admin-navy) !important;
        box-shadow: 0 6px 14px rgba(10, 37, 64, .18) !important;
    }

    .admin-container button,
    .admin-container a,
    .admin-container .btn-primary,
    .admin-container .btn-outline,
    .admin-container .btn-add,
    .admin-container .btn-create,
    .admin-container .btn-save,
    .admin-container .btn-save-top,
    .admin-container .btn-save-bottom,
    .admin-container .btn-publish,
    .admin-container .btn-draft,
    .admin-container .btn-cancel {
        font-family: inherit !important;
        transition: background .18s ease, border-color .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease !important;
    }

    .admin-container button,
    .admin-container .btn-primary,
    .admin-container .btn-add,
    .admin-container .btn-create,
    .admin-container .btn-save,
    .admin-container .btn-save-top,
    .admin-container .btn-save-bottom,
    .admin-container .btn-publish {
        border-radius: var(--admin-radius) !important;
        border: 1px solid transparent !important;
        cursor: pointer !important;
        font-weight: 800 !important;
    }

    .admin-container .btn-primary,
    .admin-container .btn-add,
    .admin-container .btn-create,
    .admin-container .btn-save,
    .admin-container .btn-save-top,
    .admin-container .btn-save-bottom,
    .admin-container .btn-publish,
    .admin-container button[style*="background:#071f3a"],
    .admin-container button[style*="background: #071f3a"],
    .admin-container a[style*="background: #071f3a"] {
        background: var(--admin-navy) !important;
        color: #ffffff !important;
        box-shadow: 0 8px 18px rgba(10, 37, 64, .16) !important;
        text-decoration: none !important;
    }

    .admin-container .btn-primary:hover,
    .admin-container .btn-add:hover,
    .admin-container .btn-create:hover,
    .admin-container .btn-save:hover,
    .admin-container .btn-publish:hover,
    .admin-container button[style*="background:#071f3a"]:hover,
    .admin-container button[style*="background: #071f3a"]:hover,
    .admin-container a[style*="background: #071f3a"]:hover {
        background: var(--admin-navy-2) !important;
        transform: translateY(-1px) !important;
    }

    .admin-container .btn-outline,
    .admin-container .btn-cancel,
    .admin-container .btn-draft,
    .admin-container button[style*="background: white"] {
        border: 1px solid var(--admin-line) !important;
        background: #ffffff !important;
        color: var(--admin-ink) !important;
        border-radius: var(--admin-radius) !important;
        box-shadow: none !important;
    }

    .admin-container .btn-outline:hover,
    .admin-container .btn-cancel:hover,
    .admin-container .btn-draft:hover,
    .admin-container button[style*="background: white"]:hover {
        border-color: #b8c3d1 !important;
        background: #f8fafc !important;
    }

    .admin-container .admin-small-action,
    .admin-container .btn-action {
        min-width: 58px !important;
        height: 32px !important;
        padding: 0 10px !important;
        border-radius: 6px !important;
        border: 1px solid var(--admin-line) !important;
        background: #ffffff !important;
        color: var(--admin-navy) !important;
        font-size: 12px !important;
        font-weight: 800 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
    }

    .admin-container .page-btn,
    .admin-container .arrow-btn {
        border-radius: 6px !important;
        text-decoration: none !important;
        font-size: 13px !important;
        font-weight: 800 !important;
    }

    .admin-container .page-btn.active {
        background: var(--admin-navy) !important;
        border-color: var(--admin-navy) !important;
    }

    .admin-container .floating-add-btn {
        width: 52px !important;
        height: 52px !important;
        border-radius: var(--admin-radius) !important;
        right: 28px !important;
        bottom: 28px !important;
        background: var(--admin-navy) !important;
        box-shadow: 0 12px 24px rgba(10, 37, 64, .22) !important;
    }

    .admin-container .faculty-image {
        height: 210px !important;
        filter: saturate(.95) contrast(1.02) !important;
    }

    .admin-container .media-thumb {
        min-height: 190px !important;
        background:
            linear-gradient(135deg, rgba(10, 37, 64, .92), rgba(15, 159, 122, .74)),
            linear-gradient(90deg, transparent 49%, rgba(255,255,255,.20) 49% 51%, transparent 51%) !important;
    }

    .admin-container .preview-card {
        border-radius: var(--admin-radius) !important;
        min-height: 360px !important;
    }

    .admin-container .setting-row {
        align-items: center !important;
        border-top: 1px solid #edf2f7 !important;
        color: var(--admin-muted) !important;
    }

    .admin-container .upload-grid,
    .admin-container .form-grid {
        gap: 16px !important;
    }

    .admin-container .editor-toolbar {
        border-bottom: 1px solid var(--admin-line) !important;
        background: #f8fafc !important;
    }

    .admin-container .quick-access-grid .card > div:first-child:empty,
    .admin-container .stats-grid .card span:empty,
    .admin-container button:empty {
        display: none !important;
    }

    @media (max-width: 1180px) {
        .admin-container .main-grid,
        .admin-container .settings-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }
    }

    @media (max-width: 900px) {
        .admin-container {
            display: flex !important;
            flex-direction: column !important;
            height: auto !important;
            min-height: 100vh !important;
        }

        .admin-container .sidebar {
            width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            position: static !important;
            box-shadow: none !important;
        }

        .admin-container .sidebar > div:first-child {
            padding: 16px !important;
        }

        .admin-container .sidebar > div:last-child {
            margin-top: 0 !important;
            padding: 0 16px 16px !important;
        }

        .admin-container .sidebar nav {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 8px !important;
        }

        .admin-container .nav-item {
            min-height: 42px !important;
            padding: 9px 10px !important;
            justify-content: flex-start !important;
            font-size: 13px !important;
        }

        .admin-container .nav-item::before {
            content: none !important;
            display: none !important;
        }

        .admin-container .main-content {
            overflow: visible !important;
            height: auto !important;
        }

        .admin-container .header {
            width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            margin: 0 0 20px !important;
            padding: 16px !important;
            align-items: flex-start !important;
            flex-direction: column !important;
            gap: 12px !important;
            position: static !important;
        }

        .admin-container .header > div:last-child,
        .admin-container .content-padding > div:first-child {
            width: 100% !important;
            flex-wrap: wrap !important;
        }

        .admin-container .header input {
            width: 100% !important;
        }

        .admin-container .content-padding {
            padding: 20px 16px !important;
        }

        .admin-container .filter-container,
        .admin-container .pagination-container,
        .admin-container .settings-grid .setting-row {
            align-items: stretch !important;
            flex-direction: column !important;
        }

        .admin-container .filter-select,
        .admin-container .search-box,
        .admin-container .search-box input,
        .admin-container .btn-primary,
        .admin-container .btn-outline,
        .admin-container .btn-add,
        .admin-container .btn-create {
            width: 100% !important;
        }

        .admin-container .data-table,
        .admin-container .announcement-table {
            display: block !important;
            overflow-x: auto !important;
            white-space: nowrap !important;
        }

        .admin-container h1 {
            font-size: 26px !important;
        }
    }

    @media (max-width: 520px) {
        .admin-container .sidebar nav,
        .admin-container .stats-grid,
        .admin-container .quick-access-grid,
        .admin-container .faculty-grid,
        .admin-container .gallery-admin-grid,
        .admin-container .settings-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const escapeHtml = function (value) {
            return value.replace(/[&<>"']/g, function (char) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[char];
            });
        };

        const iconFor = function (label) {
            const text = label.toLowerCase();
            if (text.includes('dashboard')) return 'bi-speedometer2';
            if (text.includes('beranda')) return 'bi-house-door';
            if (text.includes('akademik')) return 'bi-journal-richtext';
            if (text.includes('guru')) return 'bi-people';
            if (text.includes('prestasi')) return 'bi-trophy';
            if (text.includes('pengumuman')) return 'bi-megaphone';
            if (text.includes('kesiswaan')) return 'bi-mortarboard';
            if (text.includes('ppdb')) return 'bi-clipboard-check';
            if (text.includes('galeri')) return 'bi-images';
            if (text.includes('pengaturan')) return 'bi-gear';
            if (text.includes('upload') || text.includes('unggah')) return 'bi-cloud-arrow-up';
            if (text.includes('atur')) return 'bi-sliders';
            if (text.includes('tambah') || text.includes('buat')) return 'bi-plus-circle';
            return 'bi-circle';
        };

        document.querySelectorAll('.admin-container .header').forEach(function (header) {
            header.remove();
        });

        document.querySelectorAll('.admin-container .nav-item').forEach(function (item) {
            const href = item.getAttribute('href') || '';
            let label = item.textContent.replace(/\s+/g, ' ').trim();
            if (href.includes('/admin/prestasi')) label = 'Akademik & Prestasi';
            if (href.includes('/admin/kesiswaan')) label = 'Kesiswaan & Ekstrakurikuler';
            item.innerHTML = '<i class="bi ' + iconFor(label) + ' admin-nav-icon" aria-hidden="true"></i><span>' + escapeHtml(label) + '</span>';
        });

        document.querySelectorAll('.admin-container .sidebar nav').forEach(function (nav) {
            if (!nav.querySelector('a[href*="/admin/beranda"]')) {
                const dashboard = nav.querySelector('a[href$="/admin"], a[href*="/admin"]:not([href*="/admin/"])');
                const link = document.createElement('a');
                link.href = "{{ route('admin.beranda') }}";
                link.className = 'nav-item';
                link.innerHTML = '<i class="bi bi-house-door admin-nav-icon" aria-hidden="true"></i><span>Beranda</span>';
                if (dashboard && dashboard.nextSibling) {
                    nav.insertBefore(link, dashboard.nextSibling);
                } else {
                    nav.insertBefore(link, nav.firstChild);
                }
            }
        });

        document.querySelectorAll('.admin-container .quick-access-grid .card').forEach(function (card) {
            const label = card.textContent.replace(/\s+/g, ' ').trim();
            card.querySelectorAll('div').forEach(function (node) {
                if (!node.textContent.trim() && node.children.length === 0) {
                    node.remove();
                }
            });
            if (!card.querySelector('.admin-quick-icon')) {
                card.insertAdjacentHTML('afterbegin', '<span class="admin-quick-icon" aria-hidden="true"><i class="bi ' + iconFor(label) + '"></i></span>');
            }
        });

        document.querySelectorAll('.admin-container .btn-action').forEach(function (button, index) {
            if (!button.textContent.trim()) {
                button.innerHTML = index % 2 === 0
                    ? '<i class="bi bi-pencil-square" aria-hidden="true"></i><span>Edit</span>'
                    : '<i class="bi bi-archive" aria-hidden="true"></i><span>Arsip</span>';
            }
            button.classList.add('admin-small-action');
            if (!button.getAttribute('type')) {
                button.setAttribute('type', 'button');
            }
        });

        document.querySelectorAll('.admin-container .arrow-btn').forEach(function (button, index) {
            if (!button.textContent.trim()) {
                button.innerHTML = index % 2 === 0
                    ? '<i class="bi bi-chevron-left" aria-hidden="true"></i><span>Prev</span>'
                    : '<i class="bi bi-chevron-right" aria-hidden="true"></i><span>Next</span>';
            }
            button.setAttribute('type', 'button');
        });
    });

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.admin-container button');
        if (!button) return;

        const label = button.textContent.trim().toLowerCase();
        const go = (url) => {
            event.preventDefault();
            window.location.href = url;
        };

        if (button.classList.contains('floating-add-btn')) go("{{ route('dashboard') }}");
        if (label.includes('buat pengumuman') || label.includes('terbitkan')) go("{{ route('admin.beranda') }}");
        if (label.includes('manajemen ppdb') || label.includes('verif ppdb') || label.includes('ekspor data') || label.includes('laporan')) go("{{ route('admin.ppdb') }}");
        if (label.includes('tambah anggota guru') || label.includes('tambah guru')) go("{{ route('dashboard') }}");
        if (label.includes('tambah data')) go("{{ route('kesiswaan.create') }}");
        if (label.includes('upload galeri') || label.includes('unggah media')) go("{{ route('admin.beranda') }}");
        if (label.includes('atur admin')) go("{{ route('admin.pengaturan') }}");
        if (label.includes('export pdf') || label.includes('ekspor daftar')) go("{{ route('prestasi.index') }}");
        if (label.includes('filter') || label.includes('export') || label.includes('arsip') || label.includes('prev') || label.includes('next')) go(window.location.href);
        if (label.includes('edit') && window.location.pathname.includes('/pengumuman')) go("{{ route('admin.beranda') }}");
        if (label.includes('edit') && window.location.pathname.includes('/prestasi')) go("{{ route('prestasi.edit', 1) }}");
        if (label.includes('edit') && window.location.pathname.includes('/galeri')) go("{{ route('admin.beranda') }}");
        if (label.includes('detail') && window.location.pathname.includes('/ppdb')) go("{{ route('admin.ppdb.show', 1) }}");
        if (label.includes('simpan data')) go("{{ route('prestasi.index') }}");
        if (label.includes('simpan profil') || label.includes('hapus data guru')) go("{{ route('dashboard') }}");
    });
</script>
