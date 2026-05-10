<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Student Affairs Management - SMAN 2 Balige">
    <title>Student Affairs Management - SMAN 2 Balige</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --site-navy: #071f3a;
            --site-navy-2: #12395f;
            --site-navy-light: #1e3a5f;
            --site-ink: #102033;
            --site-muted: #6b7f91;
            --site-line: #d9e3ee;
            --site-soft: #f6f9fc;
            --site-gold: #d6a63a;
            --site-gold-light: #e5b84a;
            --site-green: #0f9f7a;
            --site-blue: #2563eb;
            --site-card: #ffffff;
            --site-radius: 12px;
            --site-shadow: 0 4px 20px rgba(7, 31, 58, 0.08);
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Plus Jakarta Sans", "Manrope", sans-serif;
            background: var(--site-soft);
            color: var(--site-ink);
            line-height: 1.6;
        }

        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--site-navy);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: var(--site-gold);
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: var(--site-navy);
            font-weight: 900;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .brand-text h1 {
            font-size: 1rem;
            font-weight: 800;
            color: white;
            line-height: 1.3;
            margin-bottom: 0.125rem;
        }

        .brand-text span {
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            color: #94a3b8;
            font-size: 0.9375rem;
            font-weight: 700;
            transition: all 0.2s;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .nav-item.active {
            background: rgba(214, 166, 58, 0.15);
            color: var(--site-gold);
            border-left: 3px solid var(--site-gold);
            padding-left: calc(1rem - 3px);
        }

        .nav-item i {
            font-size: 1.125rem;
            width: 24px;
            display: grid;
            place-items: center;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            width: 100%;
            padding: 0.875rem;
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.2);
            border-radius: 10px;
            color: #f87171;
            font-size: 0.9375rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: rgba(248, 113, 113, 0.2);
            border-color: rgba(248, 113, 113, 0.3);
        }

        /* Main Content */
        .main-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .dashboard-main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .academic-year {
            display: inline-block;
            background: #fff8e7;
            color: #8a6211;
            padding: 0.375rem 0.875rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--site-navy);
            line-height: 1.1;
            margin-bottom: 0.75rem;
        }

        .page-subtitle {
            font-size: 1rem;
            color: var(--site-muted);
            font-weight: 600;
            max-width: 700px;
            line-height: 1.7;
        }

        .btn-add-new {
            background: var(--site-navy);
            color: white;
            padding: 0.875rem 1.5rem;
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            margin-top: 1rem;
        }

        .btn-add-new:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(7, 31, 58, 0.2);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--site-line);
            border-radius: var(--site-radius);
            padding: 1.5rem;
            box-shadow: var(--site-shadow);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
        }

        .stat-icon.blue {
            background: #e8f0fe;
            color: var(--site-blue);
        }

        .stat-icon.gold {
            background: #fff8e7;
            color: #b8941f;
        }

        .stat-icon.green {
            background: #eaf7f2;
            color: var(--site-green);
        }

        .stat-icon.navy {
            background: #e0e8f0;
            color: var(--site-navy-2);
        }

        .stat-trend {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--site-green);
        }

        .stat-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--site-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 900;
            color: var(--site-navy);
            line-height: 1;
        }

        /* Content Card */
        .content-card {
            background: white;
            border: 1px solid var(--site-line);
            border-radius: var(--site-radius);
            box-shadow: var(--site-shadow);
            margin-bottom: 2rem;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid var(--site-line);
            padding: 0 1.5rem;
        }

        .tab {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--site-muted);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab.active {
            color: var(--site-navy);
            border-bottom-color: var(--site-navy);
        }

        .tab:hover {
            color: var(--site-navy);
        }

        .card-toolbar {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--site-line);
            background: white;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #496176;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--site-navy);
            color: white;
            border-color: var(--site-navy);
        }

        .action-btns {
            display: flex;
            gap: 0.75rem;
        }

        .btn-outline {
            padding: 0.625rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--site-line);
            background: white;
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--site-navy);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background: var(--site-soft);
            border-color: var(--site-navy);
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            padding: 0 1.5rem 1.5rem;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 0.875rem 1rem;
            font-size: 0.6875rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--site-muted);
            border-bottom: 1px solid var(--site-line);
        }

        .data-table td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid var(--site-line);
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: #fafbfc;
        }

        .org-info {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }

        .org-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 1.125rem;
        }

        .org-icon.navy {
            background: var(--site-navy);
            color: white;
        }

        .org-icon.gold {
            background: #fde68a;
            color: #92400e;
        }

        .org-icon.blue {
            background: #93c5fd;
            color: #1e3a8a;
        }

        .org-icon.red {
            background: #fecaca;
            color: #991b1b;
        }

        .org-name {
            font-weight: 800;
            color: var(--site-navy);
            font-size: 0.9375rem;
            margin-bottom: 0.125rem;
        }

        .org-desc {
            font-size: 0.75rem;
            color: var(--site-muted);
            font-weight: 600;
        }

        .person-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--site-line);
            display: grid;
            place-items: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--site-navy);
        }

        .person-name {
            font-weight: 700;
            color: var(--site-navy);
            font-size: 0.875rem;
        }

        .schedule-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            background: #fff8e7;
            color: #8a6211;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8125rem;
            font-weight: 700;
        }

        .members-visual {
            display: flex;
            align-items: center;
        }

        .member-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid white;
            margin-left: -8px;
            background: var(--site-line);
            display: grid;
            place-items: center;
            font-size: 0.625rem;
            font-weight: 700;
            color: var(--site-navy);
        }

        .member-avatar:first-child {
            margin-left: 0;
        }

        .member-count {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--site-navy);
            color: white;
            display: grid;
            place-items: center;
            font-size: 0.625rem;
            font-weight: 800;
            margin-left: -8px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.875rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .status-badge.active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.hold {
            background: #f3f4f6;
            color: #374151;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .action-menu {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: grid;
            place-items: center;
            cursor: pointer;
            color: var(--site-muted);
            transition: all 0.2s;
        }

        .action-menu:hover {
            background: var(--site-soft);
            color: var(--site-navy);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--site-line);
        }

        .pagination-info {
            font-size: 0.8125rem;
            color: var(--site-muted);
            font-weight: 600;
        }

        .pagination-controls {
            display: flex;
            gap: 0.25rem;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: grid;
            place-items: center;
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--site-muted);
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn:hover {
            background: var(--site-soft);
        }

        .page-btn.active {
            background: var(--site-navy);
            color: white;
        }

        /* Bottom Section */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 2rem;
        }

        .section-title {
            font-size: 1.375rem;
            font-weight: 800;
            color: var(--site-navy);
            margin-bottom: 1.25rem;
        }

        .view-calendar {
            color: var(--site-gold);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .event-card {
            background: white;
            border: 1px solid var(--site-line);
            border-radius: var(--site-radius);
            padding: 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            gap: 1.25rem;
            transition: all 0.2s;
        }

        .event-card:hover {
            box-shadow: var(--site-shadow);
            transform: translateY(-2px);
        }

        .event-date {
            min-width: 80px;
            text-align: center;
            padding: 0.75rem;
            background: var(--site-soft);
            border-radius: 8px;
            border-left: 4px solid var(--site-gold);
        }

        .event-month {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--site-navy);
            text-transform: uppercase;
        }

        .event-day {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--site-navy);
            line-height: 1;
        }

        .event-details h3 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--site-navy);
            margin-bottom: 0.375rem;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
            margin-top: 0.5rem;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: var(--site-muted);
            font-weight: 600;
        }

        .event-status {
            margin-left: auto;
            padding: 0.375rem 0.875rem;
            border-radius: 6px;
            font-size: 0.6875rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .event-status.confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .event-status.planning {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Insights Panel */
        .insight-card {
            background: var(--site-navy);
            border-radius: var(--site-radius);
            padding: 1.75rem;
            color: white;
            margin-bottom: 1.25rem;
        }

        .insight-label {
            font-size: 0.6875rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--site-gold);
            margin-bottom: 0.75rem;
        }

        .insight-title {
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 0.875rem;
        }

        .insight-desc {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            line-height: 1.7;
            margin-bottom: 1.25rem;
        }

        .read-more {
            color: white;
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding-bottom: 0.25rem;
            border-bottom: 2px solid var(--site-gold);
        }

        .participation-card {
            background: white;
            border: 1px solid var(--site-line);
            border-radius: var(--site-radius);
            padding: 1.5rem;
        }

        .participation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .participation-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--site-navy);
        }

        .participation-item {
            margin-bottom: 1.25rem;
        }

        .participation-item:last-child {
            margin-bottom: 0;
        }

        .participation-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--site-muted);
        }

        .participation-value {
            font-weight: 800;
            color: var(--site-navy);
        }

        .progress-bar {
            height: 8px;
            background: var(--site-line);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s;
        }

        .progress-fill.navy {
            background: var(--site-navy);
        }

        .progress-fill.gold {
            background: var(--site-gold);
        }

        .progress-fill.green {
            background: var(--site-green);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-wrapper {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 1.75rem;
            }
            
            .tabs {
                overflow-x: auto;
            }
            
            .card-toolbar {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group,
            .action-btns {
                justify-content: stretch;
            }
            
            .filter-btn,
            .btn-outline {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <div class="brand-logo">S2</div>
                    <div class="brand-text">
                        <h1>SMAN 2 Balige</h1>
                        <span>Portal Admin</span>
                    </div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <a href="http://127.0.0.1:8000/admin" class="nav-item active">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/guru" class="nav-item">
                    <i class="bi bi-people"></i>
                    <span>Guru & Staf</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/prestasi" class="nav-item">
                    <i class="bi bi-trophy"></i>
                    <span>Prestasi</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/pengumuman" class="nav-item">
                    <i class="bi bi-megaphone"></i>
                    <span>Pengumuman</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/kesiswaan-legacy" class="nav-item">
                    <i class="bi bi-mortarboard"></i>
                    <span>Kesiswaan</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/ppdb" class="nav-item">
                    <i class="bi bi-clipboard-check"></i>
                    <span>PPDB</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/galeri" class="nav-item">
                    <i class="bi bi-images"></i>
                    <span>Galeri</span>
                </a>
                <a href="http://127.0.0.1:8000/admin/pengaturan" class="nav-item">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <form method="POST" action="http://127.0.0.1:8000/logout">
                    <input type="hidden" name="_token" value="pIiCUgUULKzXRTvpeLekJNXzYEG5r7WxQoriQoIk" autocomplete="off">
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-wrapper">
            <div class="dashboard-main">
                <!-- Page Header -->
                <div class="page-header">
                    <span class="academic-year">Academic Year 2023/2024</span>
                    <h1 class="page-title">Student Affairs Management</h1>
                    <p class="page-subtitle">Oversee all student organizations, extracurricular activities, and institutional events with precision and clarity.</p>
                    <button class="btn-add-new">
                        <i class="bi bi-plus-lg"></i>
                        Add New Entry
                    </button>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon blue">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <span class="stat-trend">↑12%</span>
                        </div>
                        <div class="stat-label">Total Organisasi</div>
                        <div class="stat-value">12</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon gold">
                                <i class="bi bi-trophy-fill"></i>
                            </div>
                            <span class="stat-trend">-0%</span>
                        </div>
                        <div class="stat-label">Ekstrakurikuler</div>
                        <div class="stat-value">24</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon green">
                                <i class="bi bi-calendar-event-fill"></i>
                            </div>
                            <span class="stat-trend">↑8%</span>
                        </div>
                        <div class="stat-label">Upcoming Events</div>
                        <div class="stat-value">08</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon navy">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <span class="stat-trend">↑94%</span>
                        </div>
                        <div class="stat-label">Active Participation</div>
                        <div class="stat-value">1.2k</div>
                    </div>
                </div>

                <!-- Content Card with Table -->
                <div class="content-card">
                    <div class="tabs">
                        <div class="tab active">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            Organisasi
                        </div>
                        <div class="tab">
                            <i class="bi bi-trophy"></i>
                            Ekstrakurikuler
                        </div>
                        <div class="tab">
                            <i class="bi bi-calendar-check"></i>
                            Kegiatan
                        </div>
                    </div>

                    <div class="card-toolbar">
                        <div class="filter-group">
                            <button class="filter-btn active">All</button>
                            <button class="filter-btn">Active</button>
                            <button class="filter-btn">On Hold</button>
                            <button class="filter-btn">
                                <i class="bi bi-funnel"></i>
                                Filter by Category
                            </button>
                        </div>
                        <div class="action-btns">
                            <button class="btn-outline">
                                <i class="bi bi-download"></i>
                                Export PDF
                            </button>
                            <button class="btn-outline">
                                <i class="bi bi-printer"></i>
                                Print Report
                            </button>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nama Organisasi</th>
                                    <th>Ketua Umum</th>
                                    <th>Pembina</th>
                                    <th>Jadwal Rapat</th>
                                    <th>Anggota</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="org-info">
                                            <div class="org-icon navy">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <div>
                                                <div class="org-name">OSIS</div>
                                                <div class="org-desc">Organisasi Siswa Intra Sekolah</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="person-info">
                                            <div class="avatar">AW</div>
                                            <span class="person-name">Andi Wijaya</span>
                                        </div>
                                    </td>
                                    <td>Bp. H. Siregar, M.Pd</td>
                                    <td>
                                        <span class="schedule-badge">
                                            <i class="bi bi-clock"></i>
                                            Mon, 15:00
                                        </span>
                                    </td>
                                    <td>
                                        <div class="members-visual">
                                            <div class="member-avatar" style="background: #dbeafe;"></div>
                                            <div class="member-avatar" style="background: #d1fae5;"></div>
                                            <div class="member-avatar" style="background: #fef3c7;"></div>
                                            <div class="member-count">+42</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge active">
                                            <span class="status-dot"></span>
                                            Aktif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-menu">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="org-info">
                                            <div class="org-icon gold">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <div>
                                                <div class="org-name">MPK</div>
                                                <div class="org-desc">Majelis Perwakilan Kelas</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="person-info">
                                            <div class="avatar">SA</div>
                                            <span class="person-name">Siti Aminah</span>
                                        </div>
                                    </td>
                                    <td>Ibu R. Panjaitan</td>
                                    <td>
                                        <span class="schedule-badge">
                                            <i class="bi bi-clock"></i>
                                            Fri, 14:00
                                        </span>
                                    </td>
                                    <td>
                                        <div class="members-visual">
                                            <div class="member-avatar" style="background: #fce7f3;"></div>
                                            <div class="member-avatar" style="background: #e0e7ff;"></div>
                                            <div class="member-count">+15</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge active">
                                            <span class="status-dot"></span>
                                            Aktif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-menu">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="org-info">
                                            <div class="org-icon blue">
                                                <i class="bi bi-flag-fill"></i>
                                            </div>
                                            <div>
                                                <div class="org-name">PRAMUKA</div>
                                                <div class="org-desc">Praja Muda Karana</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="person-info">
                                            <div class="avatar">BS</div>
                                            <span class="person-name">Budi Santoso</span>
                                        </div>
                                    </td>
                                    <td>Bp. M. Tambunan</td>
                                    <td>
                                        <span class="schedule-badge">
                                            <i class="bi bi-clock"></i>
                                            Sat, 09:00
                                        </span>
                                    </td>
                                    <td>
                                        <div class="members-visual">
                                            <div class="member-avatar" style="background: #d1fae5;"></div>
                                            <div class="member-avatar" style="background: #dbeafe;"></div>
                                            <div class="member-avatar" style="background: #fef3c7;"></div>
                                            <div class="member-count">+120</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge active">
                                            <span class="status-dot"></span>
                                            Aktif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-menu">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="org-info">
                                            <div class="org-icon red">
                                                <i class="bi bi-first-aid"></i>
                                            </div>
                                            <div>
                                                <div class="org-name">PMR</div>
                                                <div class="org-desc">Palang Merah Remaja</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="person-info">
                                            <div class="avatar">RM</div>
                                            <span class="person-name">Rina Melati</span>
                                        </div>
                                    </td>
                                    <td>Ibu D. Simanjuntak</td>
                                    <td>
                                        <span class="schedule-badge">
                                            <i class="bi bi-clock"></i>
                                            Wed, 15:30
                                        </span>
                                    </td>
                                    <td>
                                        <div class="members-visual">
                                            <div class="member-avatar" style="background: #fecaca;"></div>
                                            <div class="member-avatar" style="background: #d1fae5;"></div>
                                            <div class="member-count">+28</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge hold">
                                            <span class="status-dot"></span>
                                            On Hold
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-menu">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        <div class="pagination-info">Showing 1 to 4 of 12 entries</div>
                        <div class="pagination-controls">
                            <div class="page-btn"><i class="bi bi-chevron-left"></i></div>
                            <div class="page-btn active">1</div>
                            <div class="page-btn">2</div>
                            <div class="page-btn">3</div>
                            <div class="page-btn"><i class="bi bi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="bottom-grid">
                    <!-- Upcoming Events -->
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                            <h2 class="section-title">Agenda Kegiatan Mendatang</h2>
                            <a href="#" class="view-calendar">
                                View Calendar
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                        <div class="event-card">
                            <div class="event-date">
                                <div class="event-month">OCT</div>
                                <div class="event-day">28</div>
                            </div>
                            <div class="event-details" style="flex: 1;">
                                <h3>Latihan Dasar Kepemimpinan (LDK)</h3>
                                <div class="event-meta">
                                    <div class="event-meta-item">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        Aula Serbaguna SMAN 2 Balige
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="bi bi-people-fill"></i>
                                        45 Participants
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="bi bi-person-badge"></i>
                                        By OSIS Admin
                                    </div>
                                </div>
                            </div>
                            <span class="event-status confirmed">Confirmed</span>
                        </div>

                        <div class="event-card">
                            <div class="event-date" style="border-left-color: var(--site-navy);">
                                <div class="event-month">NOV</div>
                                <div class="event-day" style="color: var(--site-gold);">05</div>
                            </div>
                            <div class="event-details" style="flex: 1;">
                                <h3>Kompetisi Sains Balige (KSB)</h3>
                                <div class="event-meta">
                                    <div class="event-meta-item">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        Laboratorium IPA & Matematika
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="bi bi-people-fill"></i>
                                        120 Participants
                                    </div>
                                    <div class="event-meta-item">
                                        <i class="bi bi-person-badge"></i>
                                        By Kurikulum Team
                                    </div>
                                </div>
                            </div>
                            <span class="event-status planning">Planning</span>
                        </div>
                    </div>

                    <!-- Insights -->
                    <div>
                        <h2 class="section-title">Insight Terbaru</h2>
                        
                        <div class="insight-card">
                            <div class="insight-label">Top Achievement</div>
                            <h3 class="insight-title">Juara 1 Lomba Debat Bahasa Inggris se-Toba</h3>
                            <p class="insight-desc">Tim Debat SMAN 2 Balige berhasil mempertahankan gelar juara tahunan.</p>
                            <a href="#" class="read-more">
                                READ MORE
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                        <div class="participation-card">
                            <div class="participation-header">
                                <h3 class="participation-title">Partisipasi Siswa</h3>
                                <i class="bi bi-bar-chart-fill" style="color: var(--site-muted);"></i>
                            </div>
                            
                            <div class="participation-item">
                                <div class="participation-label">
                                    <span>Olahraga</span>
                                    <span class="participation-value">85%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill navy" style="width: 85%;"></div>
                                </div>
                            </div>

                            <div class="participation-item">
                                <div class="participation-label">
                                    <span>Seni & Budaya</span>
                                    <span class="participation-value">62%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill gold" style="width: 62%;"></div>
                                </div>
                            </div>

                            <div class="participation-item">
                                <div class="participation-label">
                                    <span>Sains & Riset</span>
                                    <span class="participation-value">48%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill green" style="width: 48%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Filter button functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>