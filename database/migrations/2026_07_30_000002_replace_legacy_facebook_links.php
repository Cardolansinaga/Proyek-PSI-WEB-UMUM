<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const FACEBOOK_URL = 'https://www.facebook.com/sman2baligesoposurung';

    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        $now = now();
        $facebookSetting = DB::table('site_settings')
            ->where('key', 'facebook_url')
            ->first();

        if ($facebookSetting === null) {
            DB::table('site_settings')->insert([
                'key' => 'facebook_url',
                'value' => self::FACEBOOK_URL,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } elseif ($this->isLegacyFacebookUrl($facebookSetting->value)) {
            DB::table('site_settings')
                ->where('key', 'facebook_url')
                ->update([
                    'value' => self::FACEBOOK_URL,
                    'updated_at' => $now,
                ]);
        }

        $researchSetting = DB::table('site_settings')
            ->where('key', 'ppdb_research_cards_json')
            ->first();

        if ($researchSetting === null || ! is_string($researchSetting->value)) {
            return;
        }

        $cards = json_decode($researchSetting->value, true);
        if (! is_array($cards)) {
            return;
        }

        $changed = false;
        foreach ($cards as &$card) {
            if (is_array($card) && $this->isLegacyFacebookUrl($card['url'] ?? null)) {
                $card['url'] = self::FACEBOOK_URL;
                $changed = true;
            }
        }
        unset($card);

        if ($changed) {
            DB::table('site_settings')
                ->where('key', 'ppdb_research_cards_json')
                ->update([
                    'value' => json_encode($cards, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                    'updated_at' => $now,
                ]);
        }
    }

    public function down(): void
    {
        // A verified direct page URL must not be reverted to a broken search URL.
    }

    private function isLegacyFacebookUrl(mixed $value): bool
    {
        if (! is_string($value) || trim($value) === '') {
            return true;
        }

        return str_contains(strtolower($value), 'facebook.com/search');
    }
};
