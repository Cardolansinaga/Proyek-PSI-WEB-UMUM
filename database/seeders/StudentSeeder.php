<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        // Use upsert to avoid duplicate key errors if seeder runs multiple times
        DB::table('students')->upsert([
            [
                'nis' => 'S2026001',
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@example.com',
                'birth_date' => '2008-04-12',
                'class' => 'XI IPA 1',
                'address' => 'Jl. Merdeka No.1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nis' => 'S2026002',
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@example.com',
                'birth_date' => '2007-09-23',
                'class' => 'XII IPS 2',
                'address' => 'Jl. Sudirman No.5',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ], ['nis'], ['name', 'email', 'birth_date', 'class', 'address', 'updated_at']);
    }
}
