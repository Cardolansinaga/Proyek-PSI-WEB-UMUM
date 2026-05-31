<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        if (! Schema::hasTable('site_settings')) {
            return $default;
        }

        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    /**
     * @param  array<string, mixed>  $settings
     */
    public static function setMany(array $settings): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        foreach ($settings as $key => $value) {
            static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    /**
     * @param  array<string, string>  $defaults
     * @return array<string, string|null>
     */
    public static function map(array $defaults = []): array
    {
        if (! Schema::hasTable('site_settings')) {
            return $defaults;
        }

        $values = static::query()->pluck('value', 'key')->all();

        return array_replace($defaults, $values);
    }
}
