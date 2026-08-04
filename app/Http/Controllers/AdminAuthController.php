<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => Str::lower(trim((string) $request->input('email'))),
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Email atau password tidak sesuai.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        if (! Auth::user()->is_admin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors(['email' => 'Akun tidak memiliki akses admin.'])
                ->onlyInput('email');
        }

        $request->session()->put([
            'is_admin' => true,
            'admin_name' => Auth::user()->name ?: 'Admin',
        ]);

        if (Auth::user()->must_change_password) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Berhasil masuk. Segera ganti password awal melalui pengingat di dashboard.');
        }

        return redirect()
            ->intended(route('dashboard'))
            ->with('status', 'Berhasil masuk ke dashboard admin.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function editPassword(): View
    {
        return view('auth.force-change-password');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(12)->mixedCase()->numbers()->symbols(),
                'different:current_password',
            ],
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.different' => 'Password baru harus berbeda dari password saat ini.',
        ]);

        $user = $request->user();
        $user->forceFill([
            'password' => $data['password'],
            'must_change_password' => false,
            'password_changed_at' => now(),
        ])->save();

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Password admin berhasil diperbarui.');
    }

    public function forgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    public function sendPasswordResetLink(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => Str::lower(trim((string) $request->input('email'))),
        ]);

        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = User::query()
            ->where('email', $data['email'])
            ->where('is_admin', true)
            ->first();

        if ($admin) {
            Password::sendResetLink(['email' => $admin->email]);
        }

        return back()->with(
            'status',
            'Jika email admin terdaftar, tautan pemulihan password telah dikirim.'
        );
    }

    public function resetPassword(Request $request, string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => (string) $request->query('email'),
        ]);
    }

    public function updateResetPassword(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => Str::lower(trim((string) $request->input('email'))),
        ]);

        $credentials = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(12)->mixedCase()->numbers()->symbols(),
            ],
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (! User::query()->where('email', $credentials['email'])->where('is_admin', true)->exists()) {
            return back()
                ->withErrors(['email' => 'Tautan pemulihan tidak dapat diproses.'])
                ->withInput($request->only('email'));
        }

        $status = Password::reset(
            $credentials,
            function (User $user, string $password): void {
                if (! $user->is_admin) {
                    return;
                }

                $user->forceFill([
                    'password' => $password,
                    'must_change_password' => false,
                    'password_changed_at' => now(),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()
                ->withErrors(['email' => $this->passwordResetError($status)])
                ->withInput($request->only('email'));
        }

        return redirect()
            ->route('login')
            ->with('status', 'Password berhasil direset. Silakan masuk menggunakan password baru.');
    }

    private function passwordResetError(string $status): string
    {
        return match ($status) {
            Password::INVALID_TOKEN => 'Tautan pemulihan tidak valid atau sudah kedaluwarsa.',
            Password::INVALID_USER => 'Tautan pemulihan tidak dapat diproses.',
            Password::RESET_THROTTLED => 'Permintaan terlalu sering. Silakan tunggu sebelum mencoba kembali.',
            default => 'Password belum dapat direset. Silakan minta tautan pemulihan baru.',
        };
    }
}
