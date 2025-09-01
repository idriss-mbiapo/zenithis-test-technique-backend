<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Trajet extends Model
{
     use HasFactory;

    protected $fillable = ['user_id','lieu_depart', 'lieu_arrivee', 'date_trajet'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
