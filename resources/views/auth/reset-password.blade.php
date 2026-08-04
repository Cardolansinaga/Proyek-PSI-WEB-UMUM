<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Reset Password Admin - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/auth.css')
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Plus Jakarta Sans", system-ui, sans-serif; background: #f4f8fb; color: #102033; }
        .auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 28px; background: linear-gradient(135deg, rgba(8,33,59,.96), rgba(18,57,95,.9)); }
        .auth-card { width: 100%; max-width: 500px; background: #fff; border: 1px solid #d9e3ee; border-radius: 10px; padding: 32px; box-shadow: 0 18px 42px rgba(0,0,0,.22); }
        .brand { display: inline-flex; align-items: center; gap: 12px; color: #071f3a; text-decoration: none; margin-bottom: 24px; }
        .brand-mark { width: 44px; height: 44px; border-radius: 8px; display: grid; place-items: center; background: #fff; padding: 3px; box-shadow: 0 8px 18px rgba(7,31,58,.14); }
        .brand-mark img { width: 100%; height: 100%; object-fit: contain; display: block; }
        h1 { margin: 0; color: #071f3a; font-size: clamp(26px, 5vw, 32px); font-weight: 800; line-height: 1.2; }
        p { color: #667789; line-height: 1.7; font-size: 14px; font-weight: 600; }
        .notice { border-radius: 8px; padding: 12px 14px; margin: 16px 0; font-size: 13px; font-weight: 700; background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .field { display: grid; gap: 8px; margin-top: 18px; }
        .field label { color: #334155; font-size: 12px; font-weight: 800; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #8a98a8; }
        input { width: 100%; min-height: 50px; border: 1px solid #d9e3ee; border-radius: 8px; padding: 12px 14px 12px 42px; font: inherit; color: #071f3a; outline: none; }
        input:focus-visible { border-color: #0f9f7a; box-shadow: 0 0 0 4px rgba(15,159,122,.12); }
        .helper { margin: 10px 0 0; color: #667789; font-size: 12px; line-height: 1.65; }
        .btn-reset { width: 100%; min-height: 50px; margin-top: 24px; border: 0; border-radius: 8px; background: #071f3a; color: #fff; font: inherit; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 9px; }
        .btn-reset:hover { background: #103a61; }
        .btn-reset:focus-visible { outline: 3px solid #d6a63a; outline-offset: 3px; }
        .back-link { display: flex; justify-content: center; min-height: 44px; align-items: center; margin-top: 18px; color: #667789; font-size: 13px; font-weight: 800; text-decoration: none; }
        @media (max-width: 560px) {
            .auth-shell { padding: 16px; }
            .auth-card { padding: 24px 20px; }
        }
    </style>
</head>
<body>
    <main class="auth-shell">
        <section class="auth-card" aria-labelledby="page-title">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">
                    <img src="{{ asset('images/logo-sman2-balige.jpg') }}" alt="Logo SMAN 2 Balige">
                </span>
                <span>
                    <strong>SMAN 2 Balige</strong><br>
                    <span style="font-size: 12px; color: #667789; font-weight: 800;">Pemulihan akses admin</span>
                </span>
            </a>

            <h1 id="page-title">Buat Password Baru</h1>
            <p>Masukkan email yang menerima tautan pemulihan, lalu buat password baru yang kuat.</p>

            @if($errors->any())
                <div class="notice" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">
                    <label for="email">Email Admin</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <input id="email" type="email" name="email" value="{{ old('email', $email) }}" autocomplete="email" required autofocus>
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password Baru</label>
                    <div class="input-wrap">
                        <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        <input id="password" type="password" name="password" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <div class="input-wrap">
                        <i class="bi bi-check-circle" aria-hidden="true"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
                    </div>
                </div>

                <p class="helper">Minimal 12 karakter, menggunakan huruf besar dan kecil, angka, serta simbol.</p>

                <button type="submit" class="btn-reset">
                    <i class="bi bi-shield-check" aria-hidden="true"></i>
                    Reset Password
                </button>
            </form>

            <a class="back-link" href="{{ route('login') }}">Kembali ke halaman login</a>
        </section>
    </main>
</body>
</html>
