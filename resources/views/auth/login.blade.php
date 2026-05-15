<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; }
        html, body { min-height: 100%; }
        body { margin: 0; font-family: "Plus Jakarta Sans", "Manrope", system-ui, sans-serif; background: #eef5f8; color: #102033; letter-spacing: 0; }
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
        .brand-mark { width: 48px; height: 48px; border-radius: 8px; display: grid; place-items: center; background: #d6a63a; color: #071f3a; font-weight: 900; box-shadow: 0 14px 26px rgba(0,0,0,.18); }
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
</head>
<body>
    <main class="auth-shell">
        <div class="auth-wrap">
            <section class="auth-intro" aria-label="Portal administrasi SMAN 2 Balige">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark">S2</span>
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
