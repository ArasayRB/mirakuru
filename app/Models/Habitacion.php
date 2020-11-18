<?php

namespace App\Models;

use App\Models\Cama;
use App\Models\CategoriaHabitacion;
use App\Models\Hostal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $fillable = [//name,price_high,price_low,active,hostal_id,category_id
        'name',
        'price_high',
        'price_low',
        'active',
        'hostal_id',
        'category_id',
    ];

    public function hostales(){
      return belongsTo(Hostal::class)->withTimestamps();
    }

    public function categoriaHabitaciones(){
      return belongsTo(CategoriaHabitacion::class)->withTimestamps();
    }

    public function camas(){
      return belongsToMany(Cama::class)->withTimestamps();
    }
}
