<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inschrijving extends Model
{
    use HasFactory;
    protected $table = 'inschrijvingen'; 

    protected $fillable = ['evenement_id', 'naam', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }}
