<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'type',
        'coordinator',
        'mentor',
        'schedule',
        'location',
        'description',
        'status',
        'is_published',
        'image_class',
        'image_path',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->where('status', 'Aktif');
    }
}
