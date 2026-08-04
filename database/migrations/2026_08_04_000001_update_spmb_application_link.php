<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const OLD_URL = 'https://spmbsumutberkah.disdik.sumutprov.go.id';

    private const APPLICATION_URL = 'https://spmbsumutberkah.disdik.sumutprov.go.id/information/download-aplikasi-spmb-2026';

    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->where('key', 'ppdb_app_url')
            ->whereIn('value', [self::OLD_URL, self::OLD_URL.'/'])
            ->update(['value' => self::APPLICATION_URL, 'updated_at' => now()]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->where('key', 'ppdb_app_url')
            ->where('value', self::APPLICATION_URL)
            ->update(['value' => self::OLD_URL, 'updated_at' => now()]);
    }
};
