<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        .login-container { 
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            background: linear-gradient(135deg, #071f3a 0%, #1e293b 100%); 
            padding: 20px;
        }
        .card { 
            background: white; 
            width: 100%; 
            max-width: 450px; 
            border-radius: 24px; 
            padding: 40px; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .custom-input { 
            width: 100%; 
            padding: 14px 15px 14px 15px; 
            background: #f1f5f9; 
            border: none; 
            border-radius: 12px; 
            font-size: 14px;
            margin-top: 8px;
        }
        .btn-login { 
            width: 100%; 
            background: #071f3a; 
            color: white; 
            padding: 14px; 
            border: none; 
            border-radius: 12px; 
            font-weight: 700; 
            cursor: pointer;
            margin-top: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }
        .btn-login:hover { background: #0c2d54; transform: translateY(-1px); }
    </style>
</head>
<body>

<div class="login-container">
    <div style="text-align: center; margin-bottom: 32px;">
        <div style="background: #071f3a; width: 50px; height: 50px; border-radius: 12px; display: inline-grid; place-items: center; margin-bottom: 16px; border: 1px solid rgba(255,255,255,0.1);">
            <span style="color: white; font-weight: 900;">🎓</span>
        </div>
        <h1 style="color: white; font-size: 24px; font-weight: 800; margin: 0;">SMAN 2 Balige</h1>
        <p style="color: #94a3b8; font-size: 12px; font-weight: 600; margin-top: 4px;">Admin Portal</p>
    </div>

    <div class="card">
        <h2 style="font-size: 22px; font-weight: 800; color: #071f3a; margin-bottom: 12px;">Sign in to Admin Portal</h2>
        <p style="color: #64748b; font-size: 14px; line-height: 1.5; margin-bottom: 24px;">Enter your credentials to access the admin dashboard.</p>

        @if(session('status'))
            <div style="background:#ecfccb;border-radius:8px;padding:12px;margin-bottom:12px;color:#365314;font-weight:700;">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div style="background:#fee2e2;border-radius:8px;padding:12px;margin-bottom:12px;color:#991b1b;font-weight:700;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label style="font-size: 11px; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">Email</label>
                <input type="email" name="email" class="custom-input" placeholder="admin@sman2balige.sch.id" required>
            </div>

            <div style="margin-top: 12px;">
                <label style="font-size: 11px; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px;">Password</label>
                <input type="password" name="password" class="custom-input" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Login →</button>
        </form>

        <div style="margin-top: 20px; display:flex; justify-content:space-between; align-items:center; font-size:14px;">
            <a href="{{ route('password.request') ?? '#' }}" style="color: #071f3a; font-weight:700; text-decoration:none;">Forgot password?</a>
            <a href="{{ route('home') }}" style="color: #64748b; font-weight:700; text-decoration:none;">Back to site</a>
        </div>
    </div>
</div>

</body>
</html>
