<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite(['resources/css/auth.css', 'resources/css/auth-login.css'])
</head>
<body>
    <main class="auth-shell">
        <div class="auth-wrap">
            <section class="auth-intro" aria-label="Portal administrasi SMAN 2 Balige">
                <a class="school-identity" href="{{ route('home') }}" aria-label="Kembali ke beranda SMAN 2 Balige">
                    <span class="school-emblem">
                        <img src="{{ asset('images/logo-sman2-balige.jpg') }}" alt="Logo SMAN 2 Balige">
                    </span>
                    <span class="school-name">SMAN 2 Balige</span>
                    <span class="school-portal">Portal Administrasi Sekolah</span>
                </a>

                <div class="intro-content">
                    <span class="intro-label"><i class="bi bi-shield-lock" aria-hidden="true"></i> Akses Internal</span>
                    <h1>Kelola informasi sekolah dengan rapi.</h1>
                    <p>Ruang masuk khusus admin untuk memperbarui informasi resmi SMAN 2 Balige.</p>
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
                                <i class="bi bi-envelope" aria-hidden="true"></i>
                                <input id="email" type="email" name="email" placeholder="admin@sman2balige.sch.id" value="{{ old('email') }}" autocomplete="username" required autofocus>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password">Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock" aria-hidden="true"></i>
                                <input id="password" type="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                            Masuk ke Dashboard
                        </button>
                    </form>

                    <div class="auth-links">
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                        <a href="{{ route('home') }}" class="secondary">Kembali ke situs</a>
                    </div>
                    <div class="security-note">
                        <i class="bi bi-info-circle" aria-hidden="true"></i>
                        <span>Akses hanya untuk admin dan operator yang ditunjuk. Hubungi operator sekolah jika mengalami kendala login.</span>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
