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
        body { margin: 0; font-family: "Plus Jakarta Sans", "Manrope", system-ui, sans-serif; background: #f4f8fb; color: #102033; letter-spacing: 0; }
        .auth-shell { min-height: 100vh; display: grid; grid-template-columns: minmax(0, .95fr) minmax(420px, .75fr); }
        .auth-visual { position: relative; min-height: 100vh; padding: 42px; display: flex; flex-direction: column; justify-content: space-between; color: white; background: linear-gradient(180deg, rgba(8,33,59,.18), rgba(8,33,59,.78)), url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1400&q=85') center/cover; }
        .brand { display: inline-flex; align-items: center; gap: 12px; color: white; text-decoration: none; }
        .brand-mark { width: 46px; height: 46px; border-radius: 8px; display: grid; place-items: center; background: #c9962c; color: #071f3a; font-weight: 900; }
        .brand strong { display: block; font-size: 18px; line-height: 1; }
        .brand span { display: block; margin-top: 4px; font-size: 11px; font-weight: 800; color: rgba(255,255,255,.74); }
        .visual-copy { max-width: 640px; }
        .visual-copy h1 { margin: 0; font-size: 48px; line-height: 1.05; font-weight: 800; }
        .visual-copy p { max-width: 560px; margin: 18px 0 0; color: rgba(255,255,255,.76); font-weight: 600; line-height: 1.8; }
        .auth-panel { display: grid; place-items: center; padding: 36px; }
        .auth-card { width: 100%; max-width: 440px; background: white; border: 1px solid #d9e3ee; border-radius: 8px; padding: 30px; box-shadow: 0 18px 42px rgba(15,23,42,.08); }
        .auth-card h2 { margin: 0; color: #071f3a; font-size: 28px; line-height: 1.2; font-weight: 800; }
        .auth-card > p { margin: 10px 0 24px; color: #667789; line-height: 1.7; font-size: 14px; font-weight: 600; }
        .notice { border-radius: 8px; padding: 12px 14px; margin-bottom: 14px; font-size: 13px; font-weight: 700; }
        .notice.success { background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; }
        .notice.error { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .field { display: grid; gap: 8px; margin-top: 14px; }
        .field label { color: #334155; font-size: 12px; font-weight: 800; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #8a98a8; }
        .field input { width: 100%; height: 48px; border: 1px solid #d9e3ee; border-radius: 8px; padding: 0 14px 0 42px; font: inherit; color: #071f3a; outline: none; }
        .field input:focus { border-color: #0f9f7a; box-shadow: 0 0 0 4px rgba(15,159,122,.1); }
        .btn-login { width: 100%; min-height: 48px; margin-top: 22px; border: 0; border-radius: 8px; background: #071f3a; color: white; font: inherit; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 9px; }
        .auth-links { display: flex; justify-content: space-between; gap: 16px; margin-top: 20px; font-size: 13px; font-weight: 800; }
        .auth-links a { color: #071f3a; text-decoration: none; }
        .auth-links a.secondary { color: #667789; }
        .helper { margin-top: 22px; border-top: 1px solid #edf2f7; padding-top: 18px; color: #667789; font-size: 12px; line-height: 1.7; }
        @media (max-width: 900px) { .auth-shell { grid-template-columns: 1fr; } .auth-visual { min-height: 320px; padding: 28px; } .visual-copy h1 { font-size: 34px; } .auth-panel { padding: 24px; } }
    </style>
</head>
<body>
    <main class="auth-shell">
        <section class="auth-visual">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">S2</span>
                <span><strong>SMAN 2 Balige</strong><span>Portal Administrasi Sekolah</span></span>
            </a>
            <div class="visual-copy">
                <h1>Kelola informasi sekolah dengan rapi dan terarah.</h1>
                <p>Portal ini digunakan staf berwenang untuk memperbarui berita, prestasi, galeri, PPDB, dan data sekolah sebelum ditampilkan ke publik.</p>
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
                <p class="helper">Akses hanya untuk admin dan staf yang ditunjuk. Hubungi operator sekolah jika mengalami kendala login.</p>
            </div>
        </section>
    </main>
</body>
</html>
