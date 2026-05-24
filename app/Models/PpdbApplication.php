<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbApplication extends Model
{
    protected $fillable = [
        'registration_number',
        'full_name',
        'pathway',
        'origin_school',
        'phone',
        'parent_name',
        'address',
        'status',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];
}
