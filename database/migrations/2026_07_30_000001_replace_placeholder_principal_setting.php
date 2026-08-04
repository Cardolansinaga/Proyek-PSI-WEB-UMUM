<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->where('key', 'principal_name')
            ->where(function ($query): void {
                $query
                    ->whereNull('value')
                    ->orWhere('value', '')
                    ->orWhere('value', 'like', '%menunggu%')
                    ->orWhere('value', 'like', '%placeholder%');
            })
            ->update([
                'value' => 'Ani Sefriana Nadapdap, S.Pd., M.Si.',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        // Verified institutional data must not be reverted to a placeholder.
    }
};
