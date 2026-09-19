<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LogicException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = Str::lower(trim((string) config('admin.email')));

        if (User::query()->where('email', $email)->exists()) {
            return;
        }

        $initialPassword = (string) config('admin.initial_password');

        if ($initialPassword === '') {
            throw new LogicException(
                'ADMIN_INITIAL_PASSWORD wajib diisi saat membuat akun admin pertama kali.'
            );
        }

        User::query()->create([
            'name' => (string) config('admin.name', 'Admin Utama'),
            'email' => $email,
            'password' => $initialPassword,
            'is_admin' => true,
            'must_change_password' => true,
        ]);
    }
}
