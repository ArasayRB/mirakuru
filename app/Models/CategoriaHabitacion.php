<?php

namespace App\Models;

use App\Models\Habitacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaHabitacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_room',
        'description',
    ];

    public function habitaciones(){
      return hasMany(Habitacion::class)->withTimestamps();
    }
}
