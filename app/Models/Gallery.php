<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'type',
        'src',
    ];

    public function evenementen()
{
    return $this->belongsToMany(Evenementen::class, 'evenementen_gallery');
}
}
