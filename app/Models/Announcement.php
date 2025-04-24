<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'titel',
        'inhoud',
        'published_at',
        'vervaldatum',
        'isVisible'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'vervaldatum' => 'datetime',
        'isVisible' => 'boolean'
    ];
}
