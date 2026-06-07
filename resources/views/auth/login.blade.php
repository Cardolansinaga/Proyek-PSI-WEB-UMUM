<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/auth.css')
    <style>
        * { box-sizing: border-box; }
        html, body { min-height: 100%; }
        body { margin: 0; font-family: "Plus Jakarta Sans", system-ui, sans-serif; background: #eef5f8; color: #102033; letter-spacing: 0; }
        .auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 24px; background:
            linear-gradient(135deg, rgba(238,245,248,.96), rgba(246,250,250,.96)),
            repeating-linear-gradient(135deg, rgba(7,31,58,.045) 0 1px, transparent 1px 18px); }
        .auth-wrap { width: min(100%, 980px); display: grid; grid-template-columns: minmax(0, .9fr) minmax(380px, .72fr); overflow: hidden; border: 1px solid #d7e3ec; border-radius: 8px; background: #ffffff; box-shadow: 0 26px 70px rgba(7,31,58,.12); }
        .auth-intro { position: relative; min-height: 620px; padding: 42px; display: flex; flex-direction: column; justify-content: space-between; background: #071f3a; color: #ffffff; overflow: hidden; }
        .auth-intro::before { content: ""; position: absolute; inset: 0; background:
            linear-gradient(120deg, rgba(214,166,58,.22), transparent 34%),
            linear-gradient(180deg, transparent 0%, rgba(12,70,91,.32) 100%); }
        .auth-intro::after { content: ""; position: absolute; right: -16%; bottom: -18%; width: 64%; aspect-ratio: 1; border: 1px solid rgba(255,255,255,.14); transform: rotate(18deg); }
        .brand { position: relative; z-index: 1; display: inline-flex; align-items: center; gap: 12px; color: inherit; text-decoration: none; }
        .brand-mark { width: 48px; height: 48px; border-radius: 8px; display: grid; place-items: center; background: #ffffff; color: #071f3a; font-weight: 900; box-shadow: 0 14px 26px rgba(0,0,0,.18); padding: 3px; }
        .brand-mark img { width: 100%; height: 100%; object-fit: contain; display: block; }
        .brand strong { display: block; font-size: 18px; line-height: 1; }
        .brand span { display: block; margin-top: 4px; font-size: 11px; font-weight: 800; color: rgba(255,255,255,.72); }
        .intro-content { position: relative; z-index: 1; max-width: 520px; }
        .intro-label { display: inline-flex; align-items: center; gap: 8px; min-height: 34px; border: 1px solid rgba(214,166,58,.46); border-radius: 8px; padding: 0 12px; color: #f4d77a; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: .12em; }
        .intro-content h1 { margin: 22px 0 0; font-size: clamp(34px, 4vw, 52px); line-height: 1.04; font-weight: 900; letter-spacing: 0; }
        .intro-content p { margin: 18px 0 0; max-width: 460px; color: rgba(255,255,255,.76); font-size: 15px; font-weight: 650; line-height: 1.8; }
        .campus-sketch { position: relative; z-index: 1; min-height: 180px; margin-top: 38px; border: 1px solid rgba(255,255,255,.12); border-radius: 8px; background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.03)); overflow: hidden; }
        .campus-sketch span { position: absolute; display: block; }
        .campus-roof { left: 50%; bottom: 118px; width: 48%; height: 48px; background: #d6a63a; clip-path: polygon(50% 0, 100% 100%, 0 100%); transform: translateX(-50%); }
        .campus-main { left: 27%; bottom: 34px; width: 46%; height: 92px; border-radius: 8px 8px 0 0; background: #ffffff; }
        .campus-wing.left { left: 9%; bottom: 34px; width: 23%; height: 66px; border-radius: 8px 0 0 0; background: #dceaf1; }
        .campus-wing.right { right: 9%; bottom: 34px; width: 23%; height: 66px; border-radius: 0 8px 0 0; background: #dceaf1; }
        .campus-door { left: 47%; bottom: 34px; width: 6%; height: 38px; background: #071f3a; border-radius: 6px 6px 0 0; }
        .campus-ground { left: 0; right: 0; bottom: 0; height: 34px; background: linear-gradient(90deg, #d6a63a, #4aa398); }
        .auth-panel { display: grid; align-items: center; padding: clamp(28px, 4vw, 48px); background: #ffffff; }
        .auth-card { width: 100%; max-width: 420px; margin-inline: auto; }
        .auth-card h2 { margin: 0; color: #071f3a; font-size: 32px; line-height: 1.15; font-weight: 900; }
        .auth-card > p { margin: 10px 0 26px; color: #667789; line-height: 1.7; font-size: 14px; font-weight: 650; }
        .notice { border-radius: 8px; padding: 12px 14px; margin-bottom: 14px; font-size: 13px; font-weight: 700; }
        .notice.success { background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; }
        .notice.error { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .field { display: grid; gap: 8px; margin-top: 16px; }
        .field label { color: #243b53; font-size: 12px; font-weight: 900; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #8a98a8; }
        .field input { width: 100%; height: 52px; border: 1px solid #cfdbe6; border-radius: 8px; background: #f8fbfd; padding: 0 14px 0 42px; font: inherit; font-weight: 650; color: #071f3a; outline: none; transition: border-color .18s ease, box-shadow .18s ease, background .18s ease; }
        .field input:focus { border-color: #0f9f7a; background: #ffffff; box-shadow: 0 0 0 4px rgba(15,159,122,.12); }
        .btn-login { width: 100%; min-height: 52px; margin-top: 24px; border: 0; border-radius: 8px; background: #071f3a; color: white; font: inherit; font-weight: 900; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 9px; box-shadow: 0 14px 24px rgba(7,31,58,.18); transition: transform .18s ease, background .18s ease; }
        .btn-login:hover { background: #0d345d; transform: translateY(-1px); }
        .auth-links { display: flex; justify-content: space-between; gap: 16px; margin-top: 20px; font-size: 13px; font-weight: 800; }
        .auth-links a { color: #071f3a; text-decoration: none; }
        .auth-links a.secondary { color: #667789; }
        .helper { margin-top: 22px; border-top: 1px solid #edf2f7; padding-top: 18px; color: #667789; font-size: 12px; line-height: 1.7; }
        .security-note { display: flex; gap: 10px; align-items: flex-start; margin-top: 22px; border: 1px solid #e5edf3; border-radius: 8px; padding: 14px; background: #f8fbfd; color: #496176; font-size: 12px; font-weight: 650; line-height: 1.6; }
        .security-note i { color: #0f9f7a; font-size: 16px; line-height: 1.5; }
        @media (max-width: 860px) {
            .auth-wrap { grid-template-columns: 1fr; max-width: 520px; }
            .auth-intro { min-height: auto; padding: 28px; }
            .intro-content { margin-top: 42px; }
            .intro-content h1 { font-size: 34px; }
            .campus-sketch { display: none; }
        }
        @media (max-width: 560px) {
            .auth-shell { padding: 16px; align-items: start; }
            .auth-wrap { margin-top: 10px; }
            .auth-panel { padding: 24px; }
            .auth-links { flex-direction: column; }
        }
    </style>

    <style>
        body {
            position: relative;
            overflow-x: hidden;
            background:
                linear-gradient(180deg, #f5f8fb 0%, #eef3f7 100%) !important;
            animation: authFade .45s ease-out both;
        }

        .auth-shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding: 20px;
            display: grid;
            place-items: center;
            background: transparent;
        }

        .auth-wrap {
            width: min(100%, 1040px);
            min-height: min(560px, calc(100vh - 40px));
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, .78fr);
            overflow: hidden;
            border: 1px solid rgba(215, 227, 236, .92);
            border-radius: 28px;
            background: rgba(255, 255, 255, .88);
            box-shadow: 0 38px 100px rgba(7, 31, 58, .12);
            backdrop-filter: blur(16px);
        }

        .auth-intro {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 28px;
            min-height: 100%;
            padding: 30px;
            background:
                linear-gradient(160deg, #071f3a 0%, #0b3558 56%, #0d5e63 100%);
            overflow: hidden;
        }

        .auth-intro::before {
            background:
                radial-gradient(circle at 15% 12%, rgba(214, 166, 58, .18), transparent 18%),
                linear-gradient(120deg, rgba(255, 255, 255, .06), transparent 36%),
                repeating-linear-gradient(135deg, rgba(255, 255, 255, .06) 0 1px, transparent 1px 34px);
            animation: authSweep 18s linear infinite;
        }

        .auth-intro::after {
            right: -14%;
            bottom: -18%;
            width: 68%;
            aspect-ratio: 1;
            border: 1px solid rgba(255, 255, 255, .14);
            transform: rotate(18deg);
        }

        .brand {
            align-self: flex-start;
        }

        .brand-mark {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            box-shadow: 0 18px 30px rgba(0, 0, 0, .2);
        }

        .intro-content {
            max-width: 520px;
        }

        .intro-label {
            border-radius: 999px;
            background: rgba(255, 255, 255, .08);
            color: #fff1bc;
            border-color: rgba(214, 166, 58, .44);
            backdrop-filter: blur(10px);
        }

        .intro-content h1 {
            margin-top: 16px;
            font-size: clamp(32px, 3.8vw, 48px);
            line-height: .98;
            letter-spacing: 0;
        }

        .intro-content p {
            margin-top: 14px;
            max-width: 430px;
            color: rgba(255, 255, 255, .78);
            font-size: 14px;
            line-height: 1.75;
        }

        .campus-sketch {
            min-height: 152px;
            margin-top: 24px;
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, .1);
            background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
            overflow: hidden;
        }

        .campus-roof {
            left: 50%;
            bottom: 100px;
            width: 50%;
            height: 40px;
            transform: translateX(-50%);
        }

        .campus-main {
            left: 26%;
            bottom: 28px;
            width: 48%;
            height: 82px;
            border-radius: 10px 10px 0 0;
        }

        .campus-wing.left,
        .campus-wing.right {
            bottom: 28px;
            height: 58px;
        }

        .campus-door {
            bottom: 28px;
            height: 34px;
        }

        .campus-ground {
            height: 28px;
        }

        .auth-panel {
            display: grid;
            align-items: center;
            padding: clamp(24px, 3.6vw, 44px);
            background: linear-gradient(180deg, rgba(255, 255, 255, .98), rgba(250, 252, 255, .98));
        }

        .auth-card {
            width: 100%;
            max-width: 410px;
            margin-inline: auto;
            animation: authRise .66s cubic-bezier(.2, .8, .2, 1) both;
        }

        .auth-card h2 {
            margin: 0;
            color: #071f3a;
            font-size: 28px;
            line-height: 1.12;
            font-weight: 900;
            letter-spacing: 0;
        }

        .auth-card > p {
            margin: 8px 0 20px;
            color: #61768a;
            line-height: 1.68;
            font-size: 14px;
            font-weight: 650;
        }

        .notice {
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 14px;
            font-size: 13px;
            font-weight: 700;
        }

        .field {
            display: grid;
            gap: 8px;
            margin-top: 12px;
        }

        .field label {
            color: #0f2540;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .input-wrap i {
            color: #8ba0b3;
        }

        .field input {
            width: 100%;
            height: 54px;
            border: 1px solid #d7e1ea;
            border-radius: 14px;
            background: #f8fbfd;
            padding: 0 14px 0 42px;
            font: inherit;
            font-weight: 650;
            color: #071f3a;
            outline: none;
            transition: border-color .18s ease, box-shadow .18s ease, background .18s ease, transform .18s ease;
        }

        .field input:focus {
            border-color: #0f9f7a;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(15, 159, 122, .12), 0 18px 30px rgba(7, 31, 58, .06);
            transform: translateY(-1px);
        }

        .btn-login {
            width: 100%;
            min-height: 52px;
            margin-top: 18px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #071f3a, #0c3457);
            color: #ffffff;
            font: inherit;
            font-weight: 900;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            box-shadow: 0 18px 30px rgba(7, 31, 58, .2);
            transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 38px rgba(7, 31, 58, .24);
            filter: brightness(1.05);
        }

        .auth-links {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-top: 14px;
            font-size: 13px;
            font-weight: 800;
        }

        .auth-links a {
            color: #071f3a;
            text-decoration: none;
        }

        .auth-links a.secondary {
            color: #61768a;
        }

        .security-note {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-top: 14px;
            border: 1px solid rgba(15, 159, 122, .14);
            border-radius: 14px;
            padding: 13px 14px;
            background: linear-gradient(135deg, rgba(15, 159, 122, .08), rgba(214, 166, 58, .08));
            color: #496176;
            font-size: 12px;
            font-weight: 650;
            line-height: 1.6;
        }

        .security-note i {
            color: #0f9f7a;
            font-size: 16px;
            line-height: 1.5;
        }

        @keyframes authRise {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes authFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes authFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        @keyframes authSweep {
            0% { background-position: 0 0, 0 0, 0 0; }
            100% { background-position: 240px 0, 0 0, 140px 140px; }
        }

        @media (max-width: 900px) {
            .auth-shell {
                padding: 14px;
            }

            .auth-wrap {
                grid-template-columns: 1fr;
                min-height: auto;
                border-radius: 22px;
            }

            .auth-intro {
                padding: 24px;
                min-height: auto;
            }

            .auth-panel {
                padding: 22px;
            }

            .campus-sketch,
            .auth-intro::after {
                display: none;
            }
        }

        @media (max-width: 560px) {
            .auth-shell {
                padding: 10px;
            }

            .auth-card h2 {
                font-size: 28px;
            }

            .auth-links {
                flex-direction: column;
                gap: 8px;
            }

            .auth-intro {
                padding: 24px;
            }
        }

        @media (max-height: 760px) {
            .auth-shell {
                padding: 8px;
            }

            .auth-wrap {
                min-height: auto;
            }

            .auth-intro {
                gap: 18px;
                padding: 22px;
            }

            .intro-content h1 {
                font-size: clamp(28px, 3vw, 42px);
            }

            .intro-content p {
                margin-top: 10px;
                font-size: 13px;
                line-height: 1.65;
            }

            .campus-sketch {
                display: none;
            }

            .auth-panel {
                padding: 18px 22px;
            }

            .auth-card h2 {
                font-size: 26px;
            }

            .auth-card > p {
                margin-bottom: 16px;
            }

            .field {
                margin-top: 10px;
            }

            .btn-login {
                margin-top: 14px;
            }

            .auth-links,
            .security-note {
                margin-top: 12px;
            }
        }
    </style>
</head>
<body>
    <main class="auth-shell">
        <div class="auth-wrap">
            <section class="auth-intro" aria-label="Portal administrasi SMAN 2 Balige">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark"><img src="{{ asset('images/logo-sman2-balige.jpg') }}" alt="Logo SMAN 2 Balige"></span>
                    <span><strong>SMAN 2 Balige</strong><span>Portal Administrasi Sekolah</span></span>
                </a>
                <div class="intro-content">
                    <span class="intro-label"><i class="bi bi-shield-lock"></i> Akses Internal</span>
                    <h1>Kelola website sekolah dengan tampilan yang lebih rapi.</h1>
                    <p>Ruang masuk khusus admin untuk memperbarui informasi resmi SMAN 2 Balige secara tertib dan terarah.</p>
                    <div class="campus-sketch" aria-hidden="true">
                        <span class="campus-roof"></span>
                        <span class="campus-wing left"></span>
                        <span class="campus-wing right"></span>
                        <span class="campus-main"></span>
                        <span class="campus-door"></span>
                        <span class="campus-ground"></span>
                    </div>
                </div>
            </section>

            <section class="auth-panel">
                <div class="auth-card">
                    <h2>Masuk Admin</h2>
                    <p>Gunakan akun resmi sekolah untuk mengakses dashboard pengelolaan website.</p>

                    @if(session('status'))
                        <div class="notice success">{{ session('status') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="notice error">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field">
                            <label for="email">Email Admin</label>
                            <div class="input-wrap">
                                <i class="bi bi-envelope"></i>
                                <input id="email" type="email" name="email" placeholder="admin@sman2balige.sch.id" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password">Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock"></i>
                                <input id="password" type="password" name="password" placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Masuk ke Dashboard
                        </button>
                    </form>

                    <div class="auth-links">
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                        <a href="{{ route('home') }}" class="secondary">Kembali ke situs</a>
                    </div>
                    <div class="security-note">
                        <i class="bi bi-info-circle"></i>
                        <span>Akses hanya untuk admin dan operator yang ditunjuk. Hubungi operator sekolah jika mengalami kendala login.</span>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
