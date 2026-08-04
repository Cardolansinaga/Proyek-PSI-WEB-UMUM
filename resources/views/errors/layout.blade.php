<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <meta name="theme-color" content="#071f3a">
        <title>@yield('title', 'Terjadi Kendala') - SMAN 2 Balige</title>
        <style>
            :root {
                color-scheme: light;
                --navy: #071f3a;
                --navy-soft: #12395f;
                --gold: #d6a63a;
                --ink: #102a43;
                --muted: #60758a;
                --surface: #ffffff;
                --canvas: #f4f7fa;
            }

            * {
                box-sizing: border-box;
            }

            html,
            body {
                min-height: 100%;
                margin: 0;
            }

            body {
                display: grid;
                min-width: 0;
                place-items: center;
                overflow-x: hidden;
                background:
                    radial-gradient(circle at 12% 18%, rgba(214, 166, 58, .16), transparent 28rem),
                    radial-gradient(circle at 88% 82%, rgba(18, 57, 95, .14), transparent 30rem),
                    var(--canvas);
                color: var(--ink);
                font-family: "Segoe UI", Arial, sans-serif;
                padding: 24px;
            }

            .error-shell {
                position: relative;
                width: min(100%, 980px);
                overflow: hidden;
                border: 1px solid rgba(7, 31, 58, .1);
                border-radius: 28px;
                background: var(--surface);
                box-shadow: 0 28px 70px rgba(7, 31, 58, .14);
            }

            .error-shell::before {
                position: absolute;
                inset: 0 auto 0 0;
                width: 8px;
                background: linear-gradient(180deg, var(--gold), #f1d58a);
                content: "";
            }

            .error-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.15fr) minmax(240px, .85fr);
                min-height: 520px;
            }

            .error-copy {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: clamp(38px, 7vw, 76px);
            }

            .brand {
                display: inline-flex;
                align-items: center;
                align-self: flex-start;
                gap: 12px;
                margin-bottom: 42px;
                color: var(--navy);
                font-size: 15px;
                font-weight: 900;
                text-decoration: none;
            }

            .brand img {
                width: 46px;
                height: 46px;
                border: 1px solid rgba(7, 31, 58, .1);
                border-radius: 12px;
                background: #ffffff;
                object-fit: contain;
                padding: 3px;
            }

            .eyebrow {
                margin: 0 0 14px;
                color: #7b5713;
                font-size: 12px;
                font-weight: 900;
                letter-spacing: .15em;
                text-transform: uppercase;
            }

            h1 {
                max-width: 15ch;
                margin: 0;
                color: var(--navy);
                font-size: clamp(34px, 5vw, 56px);
                line-height: 1.04;
                letter-spacing: -.035em;
            }

            .message {
                max-width: 56ch;
                margin: 24px 0 0;
                color: var(--muted);
                font-size: 16px;
                line-height: 1.75;
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 32px;
            }

            .button {
                display: inline-flex;
                min-height: 46px;
                align-items: center;
                justify-content: center;
                border: 1px solid transparent;
                border-radius: 11px;
                padding: 11px 18px;
                font-size: 14px;
                font-weight: 800;
                text-decoration: none;
                transition: transform .16s ease, box-shadow .16s ease;
            }

            .button:hover {
                transform: translateY(-1px);
            }

            .button:focus-visible {
                outline: 3px solid rgba(214, 166, 58, .45);
                outline-offset: 3px;
            }

            .button-primary {
                background: var(--navy);
                color: #ffffff;
                box-shadow: 0 12px 24px rgba(7, 31, 58, .18);
            }

            .button-secondary {
                border-color: rgba(7, 31, 58, .16);
                background: #ffffff;
                color: var(--navy);
            }

            .error-visual {
                position: relative;
                display: grid;
                min-width: 0;
                place-items: center;
                overflow: hidden;
                background:
                    linear-gradient(145deg, rgba(255, 255, 255, .05), transparent 50%),
                    var(--navy);
                color: #ffffff;
                padding: 36px;
            }

            .error-visual::before,
            .error-visual::after {
                position: absolute;
                border: 1px solid rgba(255, 255, 255, .13);
                border-radius: 50%;
                content: "";
            }

            .error-visual::before {
                width: 360px;
                height: 360px;
            }

            .error-visual::after {
                width: 250px;
                height: 250px;
            }

            .error-code {
                position: relative;
                z-index: 1;
                color: #f1d58a;
                font-size: clamp(74px, 12vw, 132px);
                font-weight: 950;
                letter-spacing: -.08em;
                line-height: 1;
                text-shadow: 0 12px 30px rgba(0, 0, 0, .2);
            }

            .error-status {
                position: absolute;
                right: 28px;
                bottom: 26px;
                z-index: 1;
                color: rgba(255, 255, 255, .72);
                font-size: 11px;
                font-weight: 800;
                letter-spacing: .16em;
                text-transform: uppercase;
            }

            @media (max-width: 767.98px) {
                body {
                    display: block;
                    padding: 0;
                    background: #ffffff;
                }

                .error-shell {
                    min-height: 100vh;
                    border: 0;
                    border-radius: 0;
                    box-shadow: none;
                }

                .error-grid {
                    grid-template-columns: 1fr;
                }

                .error-copy {
                    order: 2;
                    padding: 36px 22px 48px 28px;
                }

                .brand {
                    margin-bottom: 28px;
                }

                .error-visual {
                    min-height: 230px;
                }

                .error-visual::before {
                    width: 290px;
                    height: 290px;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                .button {
                    transition: none;
                }
            }
        </style>
    </head>
    <body>
        <main class="error-shell">
            <div class="error-grid">
                <section class="error-copy" aria-labelledby="error-title">
                    <a class="brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo-sman2-balige-96.webp') }}" alt="Logo SMAN 2 Balige" width="46" height="46">
                        <span>SMAN 2 Balige</span>
                    </a>

                    <p class="eyebrow">@yield('eyebrow', 'Informasi Sistem')</p>
                    <h1 id="error-title">@yield('heading', 'Terjadi kendala')</h1>
                    <p class="message">@yield('message', 'Layanan belum dapat menyelesaikan permintaan Anda. Silakan coba kembali beberapa saat lagi.')</p>

                    <div class="actions">
                        <a class="button button-primary" href="@yield('primary_url', url('/'))">
                            @yield('primary_label', 'Kembali ke Beranda')
                        </a>
                        <a class="button button-secondary" href="{{ url('/berita') }}">Lihat Informasi Sekolah</a>
                    </div>
                </section>

                <aside class="error-visual" aria-hidden="true">
                    <strong class="error-code">@yield('code', 'ERR')</strong>
                    <span class="error-status">@yield('status', 'System response')</span>
                </aside>
            </div>
        </main>
    </body>
</html>
