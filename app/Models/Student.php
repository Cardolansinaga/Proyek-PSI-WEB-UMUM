<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'email',
        'birth_date',
        'class',
        'address',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
