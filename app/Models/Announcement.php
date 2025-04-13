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
        'publicatiedatum',
        'vervaldatum',
        'isVisible'
    ];

    protected $casts = [
        'publicatiedatum' => 'datetime',
        'vervaldatum' => 'datetime',
        'isVisible' => 'boolean'
    ];
}
