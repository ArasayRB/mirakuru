<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [//name,price_high,price_low,active,hostal_id,category_id
        'name_official',
        'name_knowing',
    ];

    public function reservas(){
      return hasMany(Reserva::class)->withTimestamps();
    }

}
