<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Lupa Password Admin - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/auth.css')
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Plus Jakarta Sans", system-ui, sans-serif; background: #f4f8fb; color: #102033; }
        .auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 28px; background: linear-gradient(135deg, rgba(8,33,59,.94), rgba(18,57,95,.88)), linear-gradient(135deg, #0c2946, #143f61); }
        .auth-card { width: 100%; max-width: 480px; background: white; border: 1px solid #d9e3ee; border-radius: 8px; padding: 30px; box-shadow: 0 18px 42px rgba(0,0,0,.22); }
        .brand { display: inline-flex; align-items: center; gap: 12px; color: #071f3a; text-decoration: none; margin-bottom: 24px; }
        .brand-mark { width: 44px; height: 44px; border-radius: 8px; display: grid; place-items: center; background: #ffffff; color: #071f3a; font-weight: 900; padding: 3px; box-shadow: 0 8px 18px rgba(7,31,58,.14); }
        .brand-mark img { width: 100%; height: 100%; object-fit: contain; display: block; }
        h1 { margin: 0; color: #071f3a; font-size: 28px; font-weight: 800; line-height: 1.2; }
        p { color: #667789; line-height: 1.7; font-size: 14px; font-weight: 600; }
        .notice { border-radius: 8px; padding: 12px 14px; margin: 16px 0; font-size: 13px; font-weight: 700; background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; }
        .notice.error { background: #fff1f2; color: #be123c; border-color: #fecdd3; }
        .field { display: grid; gap: 8px; margin-top: 20px; }
        .field label { color: #334155; font-size: 12px; font-weight: 800; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #8a98a8; }
        input { width: 100%; height: 48px; border: 1px solid #d9e3ee; border-radius: 8px; padding: 0 14px 0 42px; font: inherit; color: #071f3a; outline: none; }
        input:focus { border-color: #0f9f7a; box-shadow: 0 0 0 4px rgba(15,159,122,.1); }
        .btn-reset { width: 100%; min-height: 48px; margin-top: 22px; border: 0; border-radius: 8px; background: #071f3a; color: white; font: inherit; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 9px; }
        .links { display: flex; justify-content: space-between; gap: 14px; margin-top: 22px; border-top: 1px solid #edf2f7; padding-top: 18px; font-size: 13px; font-weight: 800; }
        .links a { color: #071f3a; text-decoration: none; }
        .links a.secondary { color: #667789; }
        @media (max-width: 560px) { .auth-shell { padding: 18px; } .auth-card { padding: 24px; } .links { flex-direction: column; } }
    </style>
</head>
<body>
    <main class="auth-shell">
        <section class="auth-card">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark"><img src="{{ asset('images/logo-sman2-balige.jpg') }}" alt="Logo SMAN 2 Balige"></span>
                <span>
                    <strong>SMAN 2 Balige</strong><br>
                    <span style="font-size: 12px; color: #667789; font-weight: 800;">Pemulihan akses admin</span>
                </span>
            </a>

            <h1>Lupa Password?</h1>
            <p>Masukkan email admin yang terdaftar. Instruksi pemulihan akses akan dikirim bila email tersebut tersedia di sistem.</p>

            @if(session('status'))
                <div class="notice" role="status">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="notice error" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="field">
                    <label for="email">Email Admin</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input id="email" type="email" name="email" placeholder="Masukkan email admin" value="{{ old('email', config('admin.email')) }}" autocomplete="email" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn-reset">
                    <i class="bi bi-send"></i>
                    Kirim Instruksi Pemulihan
                </button>
            </form>

            <div class="links">
                <a href="{{ route('login') }}">Kembali ke login</a>
                <a href="{{ route('home') }}" class="secondary">Kembali ke situs</a>
            </div>
        </section>
    </main>
</body>
</html>
