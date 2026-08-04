<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const DIRECT_MAPS_URL = 'https://www.google.com/maps/search/?api=1&query=SMAN%202%20Balige';

    public function up(): void
    {
        DB::table('site_settings')
            ->where('key', 'maps_url')
            ->whereIn('value', [
                'https://www.google.com/maps?q=2.3243,99.0488',
                'https://maps.google.com/?q=SMAN%202%20Balige',
            ])
            ->update(['value' => self::DIRECT_MAPS_URL]);
    }

    public function down(): void
    {
        DB::table('site_settings')
            ->where('key', 'maps_url')
            ->where('value', self::DIRECT_MAPS_URL)
            ->update(['value' => 'https://www.google.com/maps?q=2.3243,99.0488']);
    }
};
