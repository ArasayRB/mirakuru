<?php

namespace App\Models;

use App\Models\Habitacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camas extends Model
{
    use HasFactory;//type_bed,capacity
    protected $fillable = [
        'type_bed',
        'capacity',
    ];

    public function habitaciones(){
      return belongsToMany(Habitacion::class)->withTimestamps();
    }
}
