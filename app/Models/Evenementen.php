<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenementen extends Model
{
    use HasFactory;

    // Explicitly specify the table name
    protected $table = 'evenementen';

    protected $fillable = [
        'naam', 'beschrijving', 'locatie', 'start_datum', 'eind_date', 'ticket_link'
    ];
}

