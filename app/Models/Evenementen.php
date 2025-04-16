<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenementen extends Model
{
    use HasFactory;

    protected $table = 'evenementen';

    protected $guarded = [];
    
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'evenement_id');  // Notice the second parameter for custom foreign key
    }

}
