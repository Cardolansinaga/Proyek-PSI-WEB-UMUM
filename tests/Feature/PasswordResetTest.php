<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_registered_admin_receives_a_real_reset_notification(): void
    {
        Notification::fake();
        $admin = $this->admin();

        $this->post(route('password.email'), ['email' => strtoupper($admin->email)])
            ->assertRedirect()
            ->assertSessionHas(
                'status',
                'Jika email admin terdaftar, tautan pemulihan password telah dikirim.'
            );

        Notification::assertSentTo($admin, AdminResetPasswordNotification::class);
    }

    public function test_unknown_email_gets_the_same_non_enumerating_response(): void
    {
        Notification::fake();

        $this->post(route('password.email'), ['email' => 'tidak-ada@example.com'])
            ->assertRedirect()
            ->assertSessionHas(
                'status',
                'Jika email admin terdaftar, tautan pemulihan password telah dikirim.'
            );

        Notification::assertNothingSent();
    }

    public function test_admin_can_reset_password_with_a_valid_token(): void
    {
        $admin = $this->admin();
        $token = Password::createToken($admin);
        $newPassword = 'Password-Pulih!2026';

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $admin->email,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ])
            ->assertRedirect(route('login'))
            ->assertSessionHas('status');

        $admin->refresh();

        $this->assertTrue(Hash::check($newPassword, $admin->password));
        $this->assertFalse($admin->must_change_password);
        $this->assertNotNull($admin->password_changed_at);
    }

    public function test_expired_reset_token_is_rejected(): void
    {
        $admin = $this->admin();
        $token = Password::createToken($admin);

        $this->travel(61)->minutes();

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $admin->email,
            'password' => 'Password-Kedaluwarsa!2026',
            'password_confirmation' => 'Password-Kedaluwarsa!2026',
        ])
            ->assertRedirect()
            ->assertSessionHasErrors('email');
    }

    public function test_login_is_rate_limited_after_repeated_failures(): void
    {
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post(route('login.store'), [
                'email' => 'admin@sman2balige.sch.id',
                'password' => 'selalu-salah',
            ])->assertRedirect();
        }

        $this->post(route('login.store'), [
            'email' => 'admin@sman2balige.sch.id',
            'password' => 'selalu-salah',
        ])->assertTooManyRequests();
    }

    private function admin(): User
    {
        return User::query()->where('is_admin', true)->firstOrFail();
    }
}
