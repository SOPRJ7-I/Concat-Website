<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementenToevoegen extends Model
{
    use HasFactory;

    protected $table = 'evenementen_toevoegen';

    protected $guarded = [];
}
