<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@sman2balige.sch.id');

        $user = User::where('email', $email)->first();
        if (! $user) {
            User::factory()->create([
                'name' => 'Admin Utama',
                'email' => $email,
                'password' => Hash::make('password'),
            ]);
            echo "Created admin user: {$email} with password 'password'\n";
        } else {
            // ensure password is set to known value for initial access
            $user->password = Hash::make('password');
            $user->save();
            echo "Updated admin password for: {$email}\n";
        }
    }
}
