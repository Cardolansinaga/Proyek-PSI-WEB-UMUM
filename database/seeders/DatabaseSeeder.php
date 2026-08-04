<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        $shouldSeedDemo = app()->environment('testing')
            || (app()->environment('local') && config('app.seed_demo_content', false));

        if ($shouldSeedDemo) {
            $this->call([
                StudentSeeder::class,
                SchoolContentSeeder::class,
            ]);
        }
    }
}
