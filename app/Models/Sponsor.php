<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sponsor extends Model
{
    protected $guarded = [];

    public function formattedDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => nl2br(Str::markdown($this->attributes['description'] ?? '')),
        );
    }
}
